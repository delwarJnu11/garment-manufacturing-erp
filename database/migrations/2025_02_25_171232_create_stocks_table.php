<?php

use App\Models\Stock;
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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id'); // Link to product_variants table
            $table->integer('warehouse_id'); // Link to warehouses table
            $table->integer('transaction_type_id'); // Link to warehouses table
            $table->integer('qty'); // Link to warehouses table
            // $table->integer('quantity')->default(0); // Current stock level
            $table->integer('total_value')->default(0); // Current stock level
            $table->timestamps();
        });
        Stock::create([
            'product_id' => 1, // Red Cotton Fabric
            'warehouse_id' => 1, // Central Warehouse
            'qty' => 50, // Central Warehouse
            'transaction_type_id' => 1, // Central Warehouse
            // 'quantity' => 500,
            'total_value' => 7750.00 // Example: 500 * 15.50
        ]);

        Stock::create([
            'product_id' => 2, // Black T-shirt
            'warehouse_id' => 1,
            'qty' => 10,
            'transaction_type_id' => 2
            ,
            // 'quantity' => 300,
            'total_value' => 7500.00 // Example: 300 * 25.00
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
