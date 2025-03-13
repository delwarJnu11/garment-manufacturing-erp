<?php

use App\Models\PurchaseOrder;
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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('lot_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->date('purchase_date')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->decimal('discount', 10, 2)->default(0.00); // ✅ FIXED: Column name corrected
            $table->decimal('vat', 10, 2)->default(0.00);
            $table->date('delivery_date')->nullable();
            $table->string('shipping_address', 255)->nullable();
            $table->string('payment_method', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps(0);
        });

        PurchaseOrder::create([
            'supplier_id' => 1,
            'lot_id' => 10,
            'status_id' => 2,
            'total_amount' => 0.00,
            'paid_amount' => 0.00,
            'discount' => 0.00, // ✅ FIXED: Column name corrected
            'vat' => 0.00,
            'delivery_date' => '2025-03-10',
            'shipping_address' => '123 Main Street, City',
            'payment_method' => 'Cash',
            'description' => 'Order for 500 meters of cotton fabric',
        ]);
    }
};
