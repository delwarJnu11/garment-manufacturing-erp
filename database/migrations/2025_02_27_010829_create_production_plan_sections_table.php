<?php

use App\Models\ProductionPlanSection;
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
        Schema::create('production_plan_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        ProductionPlanSection::create(['name' => 'cutting']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_plan_sections');
    }
};
