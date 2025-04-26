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
        Schema::create('hrm_payslip_items', function (Blueprint $table) {
            $table->id(); // id INT PRIMARY KEY AUTO_INCREMENT
            $table->string('name'); // name VARCHAR(255) NOT NULL
            $table->unsignedBigInteger('employee_id')->nullable(); // employee_id INT
            $table->integer('factor'); // factor INT NOT NULL
            $table->decimal('amount', 10, 2); // amount DECIMAL(10,2) NOT NULL
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

            // Foreign key constraint for employee_id referencing hrm_employees table
            $table->foreign('employee_id')->references('id')->on('hrm_employees')
                ->onDelete('set null'); // Add onDelete to set employee_id to null if deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_payslip_items');
    }
};
