<?php

use App\Models\PurchaseOrder;
// use App\Models\PurchaseOrders;
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
            $table->integer('product_variant_id');
            $table->integer('lot_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
// VAT
            $table->date('delivery_date')->nullable(); // Delivery date
            $table->string('shipping_address', 255)->nullable(); // Shipping address
            $table->text('description')->nullable(); // Description
            $table->integer('quantity')->default(0); // Total quantity of raw materials
            $table->timestamps(0); // Created at and updated at with default timestamp precision
        });
        PurchaseOrder::create([
            'supplier_id' => 1,           // Supplier ID (Assuming this supplier exists in your suppliers table)
            'product_variant_id' => 1,           // Supplier ID (Assuming this supplier exists in your suppliers table)
            'lot_id' => 10,               // Lot ID (Assuming this lot exists in your lots table)
            'status_id' => 2,             // Status ID (Assuming '2' corresponds to 'Confirmed' in the status table)
            'order_total' => 5000.00,     // Total order amount
            'paid_amount' => 1500.00,     // Paid amount
            'discount' => 500.00,         // Discount applied to the order
            'vat' => 250.00,              // VAT applied to the order
            'delivery_date' => '2025-03-10', // Estimated delivery date
            'shipping_address' => '123 Main Street, City', // Shipping address
            'description' => 'Order for 500 meters of cotton fabric', // Description of the purchase order
            'quantity' => 500,            // Total quantity of raw materials (e.g., 500 meters of fabric)
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
