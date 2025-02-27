<?php

use App\Models\Order;
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
            $table->string('order_number', 50)->unique();
            $table->integer('buyer_id');
            $table->integer('supervisor_id');
            $table->integer('status_id');
            $table->string('fabric_type_id', 100);
            $table->string('gsm', 30);
            $table->date('delivery_date')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Insert Demo Data
        Order::create([
            'order_number'   => 'ORD123456',
            'buyer_id'       => 1,
            'supervisor_id'  => 2,
            'status_id'      => 1,
            'fabric_type_id' => 2,
            'gsm'            => '180',
            'delivery_date'  => now()->addDays(15),
            'description' => 'Sample order for testing',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
