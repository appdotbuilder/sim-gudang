<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncomingGoodsRequest;
use App\Models\IncomingGoods;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class IncomingGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomingGoods = IncomingGoods::with(['product.category', 'user'])
            ->latest()
            ->paginate(10);
        
        return Inertia::render('incoming-goods/index', [
            'incoming_goods' => $incomingGoods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->get();
        
        return Inertia::render('incoming-goods/create', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomingGoodsRequest $request)
    {
        $data = $request->validated();
        $data['reference_number'] = $this->generateReferenceNumber();
        $data['user_id'] = auth()->id();
        
        DB::transaction(function () use ($data) {
            // Create incoming goods record
            IncomingGoods::create($data);
            
            // Update product stock
            $product = Product::find($data['product_id']);
            $product->increment('stock_quantity', $data['quantity']);
        });

        return redirect()->route('incoming-goods.index')
            ->with('success', 'Incoming goods recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingGoods $incomingGoods)
    {
        $incomingGoods->load(['product.category', 'user']);
        
        return Inertia::render('incoming-goods/show', [
            'incoming_goods' => $incomingGoods
        ]);
    }

    /**
     * Generate unique reference number.
     */
    protected function generateReferenceNumber(): string
    {
        $date = now()->format('Ymd');
        $lastRecord = IncomingGoods::whereDate('created_at', today())
            ->latest()
            ->first();
        
        $sequence = $lastRecord ? (int) substr($lastRecord->reference_number, -4) + 1 : 1;
        
        return 'IN-' . $date . '-' . str_pad((string) $sequence, 4, '0', STR_PAD_LEFT);
    }
}