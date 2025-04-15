<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_raw_material');
            // $table->string('description');
            $table->timestamps();
        });

        Category::create([
            'name' => 'Main Raw Materials (Fabric)',
            'is_raw_material' => '0'
        ]);
        Category::create([
            'name' => ' Auxiliary Raw Materials'
        ]);
        Category::create([
            'name' => 'Trims & Accessories'
        ]);
        Category::create([
            'name' => 'Packaging Materials'
        ]);
        Category::create([
            'name' => ' Chemicals & Dyes'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_categories');
    }
};
