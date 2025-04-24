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
        Schema::create('quality_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('work_order_id');
            $table->integer('total_quantity');
            $table->integer('checked_quantity');
            $table->integer('passed_quantity')->nullable();
            $table->integer('rejected_quantity')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->integer('checked_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_checks');
    }
};
