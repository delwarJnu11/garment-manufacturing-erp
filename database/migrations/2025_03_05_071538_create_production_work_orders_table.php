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
            $table->unsignedBigInteger('production_plan_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('work_order_status_id');
            $table->unsignedBigInteger('assigned_to');
            $table->integer('total_pieces');
            $table->enum('cutting_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->enum('sewing_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->enum('finishing_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->enum('packaging_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->decimal('wastage', 10, 2)->default(0);
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
