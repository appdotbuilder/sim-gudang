<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\IncomingGoods;
use App\Models\OutgoingGoods;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock_quantity');
        $lowStockCount = Product::lowStock()->count();
        $outOfStockCount = Product::outOfStock()->count();
        
        $recentIncoming = IncomingGoods::with(['product', 'user'])
            ->latest()
            ->take(5)
            ->get();
            
        $recentOutgoing = OutgoingGoods::with(['product', 'user'])
            ->latest()
            ->take(5)
            ->get();
        
        return Inertia::render('dashboard', [
            'stats' => [
                'total_products' => $totalProducts,
                'total_stock' => $totalStock,
                'low_stock_count' => $lowStockCount,
                'out_of_stock_count' => $outOfStockCount,
            ],
            'recent_incoming' => $recentIncoming,
            'recent_outgoing' => $recentOutgoing,
        ]);
    }
}