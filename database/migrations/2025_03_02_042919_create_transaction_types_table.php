<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->unsignedBigInteger('movement_type_id');
            $table->timestamps();
        });

        // Insert default data after table creation
        DB::table('transaction_types')->insert([
            ['id' => 1, 'name' => 'Sales Order', 'movement_type_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Sales Return', 'movement_type_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Purchase Order', 'movement_type_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Purchase Return', 'movement_type_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Wastage products', 'movement_type_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_types'); // Fix table name
    }
};
