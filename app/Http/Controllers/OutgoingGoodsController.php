<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutgoingGoodsRequest;
use App\Models\OutgoingGoods;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OutgoingGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outgoingGoods = OutgoingGoods::with(['product.category', 'user'])
            ->latest()
            ->paginate(10);
        
        return Inertia::render('outgoing-goods/index', [
            'outgoing_goods' => $outgoingGoods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with('category')
            ->where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();
        
        return Inertia::render('outgoing-goods/create', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOutgoingGoodsRequest $request)
    {
        $data = $request->validated();
        $data['reference_number'] = $this->generateReferenceNumber();
        $data['user_id'] = auth()->id();
        
        DB::transaction(function () use ($data) {
            // Check stock availability
            $product = Product::find($data['product_id']);
            if ($product->stock_quantity < $data['quantity']) {
                throw new \Exception('Insufficient stock. Available: ' . $product->stock_quantity);
            }
            
            // Create outgoing goods record
            OutgoingGoods::create($data);
            
            // Update product stock
            $product->decrement('stock_quantity', $data['quantity']);
        });

        return redirect()->route('outgoing-goods.index')
            ->with('success', 'Outgoing goods recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OutgoingGoods $outgoingGoods)
    {
        $outgoingGoods->load(['product.category', 'user']);
        
        return Inertia::render('outgoing-goods/show', [
            'outgoing_goods' => $outgoingGoods
        ]);
    }

    /**
     * Generate unique reference number.
     */
    protected function generateReferenceNumber(): string
    {
        $date = now()->format('Ymd');
        $lastRecord = OutgoingGoods::whereDate('created_at', today())
            ->latest()
            ->first();
        
        $sequence = $lastRecord ? (int) substr($lastRecord->reference_number, -4) + 1 : 1;
        
        return 'OUT-' . $date . '-' . str_pad((string) $sequence, 4, '0', STR_PAD_LEFT);
    }
}