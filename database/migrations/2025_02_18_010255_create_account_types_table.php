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
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('account_types')->insert([
            ['name'=>"Asset"],
            ['name'=>"Equity"],
            ['name'=>"Liability"],
            ['name'=>"Income"],
            ['name'=>"Expense"]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_types');
    }
};

// Migration command
// php artisan migrate --path=database/migrations/2025_02_18_010255_create_account_types_table.php