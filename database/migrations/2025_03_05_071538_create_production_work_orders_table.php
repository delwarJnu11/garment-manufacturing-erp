<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('production_work_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('production_plan_id');
            $table->integer('order_id');
            $table->integer('work_order_status_id');
            $table->integer('assigned_to');
            $table->integer('total_pieces');
            $table->enum('cutting_status', ['Pending', 'Completed'])->default('Pending');
            $table->enum('sewing_status', ['Pending', 'Completed'])->default('Pending');
            $table->enum('finishing_status', ['Pending', 'Completed'])->default('Pending');
            $table->enum('packaging_status', ['Pending', 'Completed'])->default('Pending');
            $table->integer('wastage')->default(0);
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
