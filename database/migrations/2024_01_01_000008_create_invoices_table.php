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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique()->comment('Invoice number');
            $table->foreignId('outgoing_goods_id')->constrained()->onDelete('cascade');
            $table->string('customer_name')->comment('Customer name');
            $table->string('customer_email')->nullable()->comment('Customer email');
            $table->text('customer_address')->nullable()->comment('Customer address');
            $table->string('customer_phone')->nullable()->comment('Customer phone');
            $table->decimal('subtotal', 12, 2)->comment('Subtotal amount');
            $table->decimal('tax_amount', 12, 2)->default(0)->comment('Tax amount');
            $table->decimal('total_amount', 12, 2)->comment('Total amount');
            $table->enum('status', ['draft', 'sent', 'paid', 'overdue'])->default('draft')->comment('Invoice status');
            $table->date('invoice_date')->comment('Invoice date');
            $table->date('due_date')->nullable()->comment('Payment due date');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('invoice_number');
            $table->index('outgoing_goods_id');
            $table->index('status');
            $table->index('invoice_date');
            $table->index('due_date');
            $table->index(['status', 'due_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};