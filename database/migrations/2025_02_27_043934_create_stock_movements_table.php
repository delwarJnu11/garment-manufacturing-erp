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


    //  no need to use 
    public function up()
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('movement_type');
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
