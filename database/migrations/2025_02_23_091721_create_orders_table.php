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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer_id');
            $table->integer('status_id');
            $table->string('order_number', 50)->unique();
            $table->string('style_name', 100)->nullable();
            $table->string('fabric_type', 100);
            $table->string('gsm', 30);
            $table->string('color', 50);
            $table->text('trims')->nullable();
            $table->integer('order_quantity');
            $table->date('delivery_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
