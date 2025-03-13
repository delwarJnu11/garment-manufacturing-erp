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
            $table->integer('product_id');
            $table->integer('lot_id');
            // $table->integer('warehouse_id'); // come from lot  table
            $table->integer('transaction_type_id');
            $table->integer('qty'); // come from lot  table
            $table->decimal('total_value');

            $table->timestamps();
        });
        Stock::create([
            'product_id' => 1,
            'lot_id' => 1,
            // 'warehouse_id' => 1,
            'qty' => 50,
            'transaction_type_id' => 1,
            'total_value' => 7750.00
        ]);

        Stock::create([
            'product_id' => 2,
            'lot_id' => 2,
            // 'warehouse_id' => 1,
            'qty' => 10,
            'transaction_type_id' => 2,
            'total_value' => 7500.00
        ]);
    }