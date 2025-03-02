<?php

use App\Models\PurchaseOrderDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->integer('purchase_id')->unsigned(); // Purchase Order ID
            $table->integer('product_id')->unsigned(); // Product Variant ID
            $table->integer('lot_id')->unsigned(); // Lot ID (which contains raw_material_id)
            $table->integer('quantity')->default(0); // Quantity ordered
            $table->decimal('price', 10, 2)->default(0.00); // Total amount for purchase
            $table->decimal('discount', 10, 2)->default(0.00); // Discount applied
            $table->decimal('vat', 10, 2)->default(0.00); // VAT applied
            $table->timestamps(); // Automatically adds created_at and updated_at
        });

        // Optional: Add a sample record for testing (ensure to use a valid model and values)
        PurchaseOrderDetail::create([
            'purchase_id' => 1, // Example Purchase Order ID
            'product_id' => 1, // Example Product Variant ID
            'lot_id' => 1, // Example Lot ID
            'quantity' => 50, // Quantity ordered
            'price' => 1000.00, // Total purchase amount
            'paid_amount' => 500.00, // Paid amount 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_details');
    }
}
