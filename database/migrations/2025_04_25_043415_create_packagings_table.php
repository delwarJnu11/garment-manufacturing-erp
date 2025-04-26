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
        Schema::create('packagings', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('work_order_id');
            $table->integer('product_id');
            $table->integer('total_quantity');
            $table->integer('packaged_quantity')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->integer('packaged_by')->nullable();
            $table->timestamp('packaging_start')->nullable();
            $table->timestamp('packaging_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packagings');
    }
};
