<?php

use App\Models\Warehouse;
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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('phone', 20);
            $table->string('location', 200);
            $table->string('address', 200);
            $table->timestamps();
        });


        Warehouse::create([
            'name' => 'Central Warehouse',
            'phone' => '123-456-7890',
            'location' => '40.7128° N, 74.0060° W', // Example GPS coordinates (New York City)
            'address' => '123 New Road, Pool Market'
        ]);

        Warehouse::create([
            'name' => 'West Coast Distribution',
            'phone' => '987-654-3210',
            'location' => '34.0522° N, 118.2437° W', // Los Angeles
            'address' => '456 Sunset Blvd, New Road'
        ]);

        Warehouse::create([
            'name' => 'Midwest Storage',
            'phone' => '555-123-4567',
            'location' => '41.8781° N, 87.6298° W', // Chicago
            'address' => '789 Lakeshore Drive, Chicago'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
