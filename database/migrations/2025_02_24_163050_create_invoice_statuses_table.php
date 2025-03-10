<?php

use App\Models\InvoiceStatus;
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
        Schema::create('invoice_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Status name
            $table->string('description')->nullable(); // Corrected the description column type
            $table->timestamps();
        });

        // Insert default statuses
        InvoiceStatus::create([
            'name' => 'Pending',
            'description' => 'The order is placed but not yet confirmed by the supplier.',
        ]);
        InvoiceStatus::create([
            'name' => 'Confirmed',
            'description' => 'The order has been confirmed by the supplier.',
        ]);
        InvoiceStatus::create([
            'name' => 'Shipped',
            'description' => 'The order has been shipped by the supplier.',
        ]);
        InvoiceStatus::create([
            'name' => 'Delivered',
            'description' => 'The order has been delivered to the warehouse.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('InvoiceStatuses');
    }
};
