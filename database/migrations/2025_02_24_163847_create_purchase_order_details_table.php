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
            $table->decimal('price', 10, 2)->default(0.00); // Price per unit
            $table->decimal('discount_price', 10, 2)->default(0.00); // Discounted price
            $table->timestamps(); // Automatically adds created_at and updated_at
        });

        // Add a sample record with fake data for testing
        PurchaseOrderDetail::create([
            'purchase_id' => 1,    // Purchase Order ID (Ensure this ID exists in purchase_orders table)
            'lot_id' => 10,        // Lot ID (Ensure this ID exists in lots table)
            'quantity' => 50,      // Ordered quantity
            'price' => 100.50,     // Price per unit
            'discount_price' => 5.00,  // Discount per unit
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
