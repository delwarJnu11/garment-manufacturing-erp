<?php

use App\Models\Size;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->timestamps();
        });

<<<<<<< HEAD
        // Insert dummy data
        DB::table('sizes')->insert([
            ['name' => 'Small', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Medium', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Large', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Extra Large', 'created_at' => now(), 'updated_at' => now()],
        ]);
=======
        // insert Demo Data
        Size::create(['name' => 'Small']);
        Size::create(['name' => 'Medium']);
>>>>>>> development
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
