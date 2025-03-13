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
        Schema::create('sweings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cutting_id');
            $table->unsignedBigInteger('work_order_id');
            $table->string('sewing_status')->default('Pending');
            $table->integer('total_quantity')->default(0);
            $table->integer('target_quantity');
            $table->integer('actual_quantity')->default(0);
            $table->integer('swen_complete')->default(0);
            $table->integer('wastage')->default(0);
            $table->decimal('efficiency', 5, 2)->nullable();
            $table->date('sewing_start_date')->nullable();
            $table->date('sewing_end_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sweings');
    }
};
