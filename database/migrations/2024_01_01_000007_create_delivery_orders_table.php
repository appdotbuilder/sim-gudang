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
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->comment('Delivery order number');
            $table->foreignId('outgoing_goods_id')->constrained()->onDelete('cascade');
            $table->string('customer_name')->comment('Customer name');
            $table->text('customer_address')->nullable()->comment('Customer address');
            $table->string('customer_phone')->nullable()->comment('Customer phone');
            $table->enum('status', ['pending', 'in_transit', 'delivered'])->default('pending')->comment('Delivery status');
            $table->date('delivery_date')->nullable()->comment('Expected delivery date');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('order_number');
            $table->index('outgoing_goods_id');
            $table->index('status');
            $table->index('delivery_date');
            $table->index(['status', 'delivery_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};