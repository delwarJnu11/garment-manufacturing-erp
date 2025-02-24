<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // ✅ Import DB
use Carbon\Carbon; // ✅ Import Carbon for timestamps

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('material_name', 200);
            $table->text('description')->nullable();
            $table->decimal('quantity', 10, 2);
            $table->unsignedBigInteger('uom_id');
            $table->decimal('cost_per_unit', 10, 2); 
            $table->unsignedBigInteger('supplier_id'); 
            $table->timestamps();
        });

        // ✅ Insert data after table creation
        DB::table('raw_materials')->insert([
            [
                'material_name' => 'Cotton Fabric',
                'description' => 'Soft and breathable fabric used for t-shirts and dresses.',
                'quantity' => 500.00,
                'uom_id' => 1, 
                'cost_per_unit' => 10.50,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Polyester Fabric',
                'description' => 'Durable synthetic fabric used for sportswear.',
                'quantity' => 300.00,
                'uom_id' => 1, 
                'cost_per_unit' => 8.75,
                'supplier_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Denim Fabric',
                'description' => 'Heavy cotton fabric used for jeans.',
                'quantity' => 200.00,
                'uom_id' => 1, 
                'cost_per_unit' => 15.00,
                'supplier_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Metal Zippers',
                'description' => 'High-quality metal zippers for jackets.',
                'quantity' => 1000.00,
                'uom_id' => 2,
                'cost_per_unit' => 0.50,
                'supplier_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Elastic Bands',
                'description' => 'Used for waistbands in trousers and skirts.',
                'quantity' => 600.00,
                'uom_id' => 1, 
                'cost_per_unit' => 2.00,
                'supplier_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
