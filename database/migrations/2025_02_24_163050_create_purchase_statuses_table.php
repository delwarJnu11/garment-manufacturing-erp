<?php

use App\Models\Purchase_status;
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
        Schema::create('purchase_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Status name
            $table->string('description')->nullable(); // Corrected the description column type
            $table->timestamps();
        });

        // Insert default statuses
        Purchase_status::create([
            'name' => 'Pending',
            'description' => 'The order is placed but not yet confirmed by the supplier.',
        ]);
        Purchase_status::create([
            'name' => 'Confirmed',
            'description' => 'The order has been confirmed by the supplier.',
        ]);
        Purchase_status::create([
            'name' => 'Shipped',
            'description' => 'The order has been shipped by the supplier.',
        ]);
        Purchase_status::create([
            'name' => 'Delivered',
            'description' => 'The order has been delivered to the warehouse.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_statuses');
    }
};
