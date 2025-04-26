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
        Schema::create('hrm_employees', function (Blueprint $table) {
            $table->id(); // id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('name', 100); // name VARCHAR(100) NOT NULL
            $table->string('employee_id_number', 100); // employee_id_number VARCHAR(100) NOT NULL
            $table->string('email', 150)->unique(); // email VARCHAR(150) UNIQUE NOT NULL
            $table->string('phone', 20)->nullable()->unique(); // phone VARCHAR(20) UNIQUE NULL
            $table->string('gender', 20)->nullable()->unique(); // gender VARCHAR(20) UNIQUE NULL
            $table->date('date_of_birth')->nullable(); // date_of_birth DATE NULL
            $table->date('joining_date'); // joining_date DATE NOT NULL
            $table->unsignedBigInteger('bank_account_id'); // bank_account_id INT NOT NULL
            $table->unsignedBigInteger('department_id'); // department_id BIGINT UNSIGNED NOT NULL
            $table->decimal('salary', 10, 2); // salary DECIMAL(10,2) NOT NULL
            $table->unsignedBigInteger('designations_id'); // designations_id BIGINT UNSIGNED NOT NULL
            $table->unsignedBigInteger('statuses_id'); // statuses_id BIGINT UNSIGNED NOT NULL
            $table->string('branch', 100); // branch VARCHAR(100) NOT NULL
            $table->string('certificate', 100); // certificate VARCHAR(100) NOT NULL
            $table->string('photo', 100); // photo VARCHAR(100) NOT NULL
            $table->text('address')->nullable(); // address TEXT NULL
            $table->text('resume')->nullable(); // resume TEXT NULL
            $table->string('city', 100)->nullable(); // city VARCHAR(100) NULL
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

            // Foreign key constraints
            $table->foreign('bank_account_id')->references('id')->on('hrm_employee_bank_accounts')
                ->onDelete('cascade'); // Add onDelete to handle bank account deletion behavior
            $table->foreign('department_id')->references('id')->on('hrm_departments')
                ->onDelete('cascade'); // Add onDelete to handle department deletion behavior
            $table->foreign('designations_id')->references('id')->on('hrm_designations')
                ->onDelete('cascade'); // Add onDelete to handle designation deletion behavior
            $table->foreign('statuses_id')->references('id')->on('hrm_statuses')
                ->onDelete('cascade'); // Add onDelete to handle status deletion behavior
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_employees');
    }
};
