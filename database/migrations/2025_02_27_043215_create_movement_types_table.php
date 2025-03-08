<?php

use App\Models\MovementType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movement_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Default Name');
            
            $table->timestamps();
        });

        // Insert default movement types
        MovementType::create([
            ['name' => 'IN'],
            ['name' => 'OUT'],
            ['name' => 'WASTAGE'],
        ]);
    }
};
