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
            $table->string('cutting_status');
            $table->integer('total_quantity');
            $table->decimal('total_fabric_used', 10, 2);
            $table->integer('target_quantity');
            $table->integer('actual_quantity')->default(0);
            $table->date('cutting_start_date');
            $table->date('cutting_end_date');
            $table->decimal('wastage', 10, 2);
            $table->text('remarks')->nullable();
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
