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
        Schema::create('outgoing_goods', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique()->comment('Outgoing goods reference number');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->comment('Outgoing quantity');
            $table->string('customer')->nullable()->comment('Customer name');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->date('shipped_date')->comment('Date goods were shipped');
            $table->enum('status', ['pending', 'shipped', 'delivered'])->default('pending')->comment('Shipping status');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('reference_number');
            $table->index('product_id');
            $table->index('shipped_date');
            $table->index('status');
            $table->index('user_id');
            $table->index(['shipped_date', 'product_id']);
            $table->index(['status', 'shipped_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_goods');
    }
};