<?php

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
        Schema::create('wastages', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('wastage_type_id');
            $table->integer('work_order_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('reported_by')->nullable();
            $table->string('section')->nullable();
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->boolean('is_sellable')->default(false);
            $table->text('remarks')->nullable();
            $table->date('wastage_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wastages');
    }
};
