<?php

use App\Models\Product_lot;
use App\Models\ProductLot;
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
        Schema::create('product_lots', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for the lot
            $table->integer('product_variant'); // Reference to raw_materials table (without foreign key constraint)
            $table->integer('quantity'); // Quantity of raw material received
            $table->double('cost_price')->nullable(); // Cost price of the raw material
            $table->integer('warehouse_id'); // Reference to warehouse (without foreign key constraint)
            $table->text('description')->nullable(); // Optional description for the lot
            $table->timestamps(); // Created at and updated at timestamps
        });

        ProductLot::create([
            'product_variant' => 1,  // Raw Material ID (Ensure this ID exists in raw_materials table)
            'quantity' => 500,       // Quantity received
            'cost_price' => 120.75,  // Cost price per unit
            'warehouse_id' => 3,     // Warehouse ID (Ensure this ID exists in warehouses table)
            'description' => 'Batch of high-quality cotton fabric', // Optional description
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
