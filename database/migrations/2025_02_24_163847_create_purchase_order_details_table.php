<?php

// use App\Models\purchase_order_detail;
use App\Models\PurchaseOrderDetail;
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
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->integer('purchase_id')->unsigned(); // Purchase Order ID (without foreign key)
            $table->integer('lot_id')->unsigned(); // Lot ID (which contains raw_material_id)
            $table->integer('quantity')->default(0); // Quantity ordered
            $table->decimal('purchase_total', 10, 2)->default(0.00); // Order total
            $table->decimal('paid_amount', 10, 2)->default(0.00); // Paid amount
            $table->decimal('discount', 10, 2)->default(0.00); // Discount
            $table->decimal('vat', 10, 2)->default(0.00);
            $table->timestamps(); // Automatically adds created_at and updated_at
        });



        // Add a sample record with fake data for testing
        PurchaseOrderDetail::create([

            'purchase_id' => 1, // Example Purchase Order ID
            'lot_id' => 1, // Example Lot ID (related to raw material)
            'quantity' => 50, // Quantity ordered
            'purchase_total' => 1000.00, // Total purchase amount
            'paid_amount' => 500.00, // Paid amount
            'discount' => 50.00, // Discount applied
            'vat' => 100.00, // VAT applied
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
};
