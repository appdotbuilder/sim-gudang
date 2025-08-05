<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes for warehouse management
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('incoming-goods', App\Http\Controllers\IncomingGoodsController::class)
        ->only(['index', 'create', 'store', 'show']);
    Route::resource('outgoing-goods', App\Http\Controllers\OutgoingGoodsController::class)
        ->only(['index', 'create', 'store', 'show']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
