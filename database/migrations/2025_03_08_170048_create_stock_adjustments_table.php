<?php

use App\Models\StockAdjustment;
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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_id')->constrained('stocks');
            $table->integer('adjustment_type_id')->nullable();
            $table->integer('adjusted_qty')->nullable();
            $table->integer('remaining_qty')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
        });
        StockAdjustment::create([
            'stock_id' => 1,
            'adjustment_type_id' => 1,
            'adjusted_qty' => 10,
            'remaining_qty' => 20,
            'reason' => 'somthing wrong',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');
    }
};
