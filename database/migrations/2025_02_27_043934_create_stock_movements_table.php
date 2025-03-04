<?php

use App\Models\StockMovement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('stock_movements', function (Blueprint $table) {
    //         $table->id();
    //         $table->integer('product_variant_id'); 
    //         $table->integer('movement_type_id'); // Reference to Movement Type (In, Out, Wastage)
    //         $table->integer('quantity');
    //         $table->decimal('unit_price', 10, 2);
    //         $table->string('source'); // e.g., 'purchase', 'production', 'return'
    //         $table->string('destination'); // e.g., 'warehouse', 'store'
    //         $table->timestamp('date')->default(now());
    //         $table->string('reference')->nullable(); // e.g., 'PO-123456'
    //         $table->text('remarks')->nullable(); // Additional notes
    //         $table->integer('user_id');
    //         $table->timestamps();
    //     });
        
    //     StockMovement::create([
    //         'product_variant_id' => 1,  
    //         'movement_type' => 'in', 
    //         'quantity' => 100,
    //         'source' => 'purchase', 
    //         'destination' => 'warehouse', 
    //         'date' => now(), // Movement date
    //         'reference' => 'PO-123456', // Reference number (e.g., purchase order)
    //         'remarks' => 'Stock received from supplier', 
    //         'user_id' => 1, // Who performed the movement
    //     ]);
        
    // }

    public function up()
{
    Schema::create('stock_movements', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id');
        $table->string('movement_type'); // This is the column you're missing
        $table->integer('quantity');
        $table->string('source');
        $table->string('destination');
        $table->timestamp('date');
        $table->string('reference');
        $table->text('remarks')->nullable();
        $table->unsignedBigInteger('user_id');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
