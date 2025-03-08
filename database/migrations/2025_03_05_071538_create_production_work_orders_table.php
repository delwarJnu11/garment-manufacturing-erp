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
        Schema::create('production_work_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('production_plan_id');
            $table->integer('production_work_section_id');
            $table->integer('production_work_status_id');
            $table->integer('assign_to');
            $table->integer('target_quantity');
            $table->integer('actual_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_work_orders');
    }
};
