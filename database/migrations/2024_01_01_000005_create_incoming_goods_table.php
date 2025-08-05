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
        Schema::create('incoming_goods', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique()->comment('Incoming goods reference number');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->comment('Incoming quantity');
            $table->string('supplier')->nullable()->comment('Supplier name');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->date('received_date')->comment('Date goods were received');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('reference_number');
            $table->index('product_id');
            $table->index('received_date');
            $table->index('user_id');
            $table->index(['received_date', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_goods');
    }
};