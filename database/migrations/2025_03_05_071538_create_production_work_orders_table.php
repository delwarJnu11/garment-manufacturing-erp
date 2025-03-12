<?php

use App\Models\ProductionWorkOrder;
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
            $table->integer('production_plan_id');
            $table->integer('order_id');
            $table->integer('work_order_status_id')->default(1); 
            $table->integer('assigned_to');
            $table->integer('total_pieces')->default(0);
            $table->enum('cutting_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->enum('sewing_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->enum('finishing_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->enum('packaging_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->integer('wastage')->default(0);
            $table->timestamps();
        });
        

        ProductionWorkOrder::create([
            'production_plan_id' => 1,
            'order_id' => 101,
            'work_order_status_id' => 1,
            'assigned_to' => 5,
            'total_pieces' => 500,
            'cutting_status' => 'Completed',
            'sewing_status' => 'In Progress',
            'finishing_status' => 'Pending',
            'packaging_status' => 'Pending',
            'wastage' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_work_orders');
    }
};
