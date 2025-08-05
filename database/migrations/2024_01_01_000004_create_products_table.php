<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Auto-generated product code');
            $table->string('name')->comment('Product name');
            $table->text('description')->nullable()->comment('Product description');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('stock_quantity')->default(0)->comment('Current stock quantity');
            $table->integer('minimum_stock')->default(10)->comment('Minimum stock level for alerts');
            $table->string('unit')->comment('Unit of measurement (pcs, kg, etc.)');
            $table->decimal('unit_price', 12, 2)->default(0)->comment('Unit price for sales');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('code');
            $table->index('name');
            $table->index('category_id');
            $table->index('stock_quantity');
            $table->index(['stock_quantity', 'minimum_stock']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};