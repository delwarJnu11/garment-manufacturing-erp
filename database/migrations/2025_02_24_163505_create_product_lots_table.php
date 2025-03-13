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
            $table->id();
            $table->integer('product_id');
            $table->integer('qty');
            $table->double('cost_price')->nullable();
            $table->double('sales_price')->nullable();
            $table->integer('transaction_type_id')->nullable();
            $table->integer('warehouse_id');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        ProductLot::create([
            'product_id' => 1,
            'qty' => 500,
            'cost_price' => 120.75,
            'sales_price' => 119.75,
            'warehouse_id' => 3,
            'transaction_type_id' => 3,
            'description' => 'Batch of high-quality cotton fabric',
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
