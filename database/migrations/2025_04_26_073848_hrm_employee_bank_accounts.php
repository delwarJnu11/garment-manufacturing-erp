<?php

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
        Schema::create('hrm_employee_bank_accounts', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('employee_id'); // employee_id INT NOT NULL
            $table->string('bank_name', 255); // bank_name VARCHAR(255) NOT NULL
            $table->string('account_number', 50)->unique(); // account_number VARCHAR(50) NOT NULL UNIQUE
            $table->string('bank_identifier_code', 20); // bank_identifier_code VARCHAR(20) NOT NULL
            $table->string('branch_name', 255)->nullable(); // branch_name VARCHAR(255)
            $table->string('branch_location', 200)->nullable(); // branch_location VARCHAR(200)
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

            // Foreign key constraint for employee_id referencing hrm_employees table
            $table->foreign('employee_id')->references('id')->on('hrm_employees')
                ->onDelete('cascade'); // Add onDelete to handle employee deletion behavior
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_employee_bank_accounts');
    }
};
