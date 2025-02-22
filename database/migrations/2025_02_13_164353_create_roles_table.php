<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'Super Admin'],
            ['name' => 'HR Manager'],
            ['name' => 'Finance Manager'],
            ['name' => 'Sales Manager'],
            ['name' => 'Inventory Manager'],
            ['name' => 'Procurement Manager'],
            ['name' => 'Marketing Manager'],
            ['name' => 'Project Manager'],
            ['name' => 'Quality Assurance Manager'],
            ['name' => 'Salesperson'],
            ['name' => 'Customer Service Representative'],
            ['name' => 'Logistics Coordinator'],
            ['name' => 'IT Support'],
            ['name' => 'Employee'],
            ['name' => 'Consultants']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}
