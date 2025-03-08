<?php


use App\Models\AdjustmentType;
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
        Schema::create('adjustment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        AdjustmentType::create([
            'name' => 'Damage',
        ]);
        AdjustmentType::create([
            'name' => 'Restock',
        ]);
        AdjustmentType::create([
            'name' => 'Sales',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjusment_types');
    }
};
