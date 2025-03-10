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
        Schema::create('cuttings', function (Blueprint $table) {
            $table->id();
            $table->integer('work_order_id');
            $table->integer('cutting_status_id');
            $table->integer('total_fabric_quantity');
            $table->integer('total_fabric_used');
            $table->integer('target_quantity');
            $table->integer('actual_quantity');
            $table->integer('cutting_start_date');
            $table->integer('cutting_end_date');
            $table->integer('wastage');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuttings');
    }
};
