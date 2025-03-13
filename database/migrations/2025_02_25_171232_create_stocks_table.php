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
<<<<<<< HEAD
            $table->integer('product_id'); 
            $table->integer('warehouse_id')->nullable(); 
            $table->integer('transaction_type_id'); 
            $table->integer('qty');
            $table->integer('lot_id');
            $table->integer('total_value')->default(0); 
            $table->timestamps();
        });
        Stock::create([
            'product_id' => 1, 
            'warehouse_id' => 1, 
            'qty' => 50, 
            'transaction_type_id' => 1,
            'lot_id' => 1, 
=======
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
>>>>>>> 5974f2b7ccea101babc15445f301e85a12c4dcb9
            'total_value' => 7750.00
        ]);

        Stock::create([
<<<<<<< HEAD
            'product_id' => 2, 
            'warehouse_id' => 1,
            'qty' => 10,
            'transaction_type_id' => 2,
            'lot_id' => 1,
=======
            'product_id' => 2,
            'lot_id' => 2,
            // 'warehouse_id' => 1,
            'qty' => 10,
            'transaction_type_id' => 2,
>>>>>>> 5974f2b7ccea101babc15445f301e85a12c4dcb9
            'total_value' => 7500.00
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
