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
        Schema::create('hrm_payslips', function (Blueprint $table) {
            $table->id(); // id INT PRIMARY KEY AUTO_INCREMENT
            $table->string('name'); // name VARCHAR(255) NOT NULL
            $table->unsignedBigInteger('employee_id'); // employee_id INT
            $table->string('statuses_id'); // statuses_id VARCHAR(100) NOT NULL
            $table->string('salary_month', 10); // salary_month VARCHAR(10) NOT NULL
            $table->date('start_date'); // start_date DATE NOT NULL
            $table->date('end_date'); // end_date DATE NOT NULL
            $table->decimal('basic_salary', 10, 2); // basic_salary DECIMAL(10,2) NOT NULL
            $table->unsignedBigInteger('payslip_items_id'); // payslip_items_id INT NOT NULL
            $table->tinyInteger('total_working_days')->unsigned()->default(0); // total_working_days TINYINT UNSIGNED DEFAULT 0
            $table->tinyInteger('working_days_attendance')->unsigned()->default(0); // working_days_attendance TINYINT UNSIGNED DEFAULT 0
            $table->tinyInteger('leaves_taken')->unsigned()->default(0); // leaves_taken TINYINT UNSIGNED DEFAULT 0
            $table->tinyInteger('balance_leaves')->unsigned()->default(0); // balance_leaves TINYINT UNSIGNED DEFAULT 0
            $table->decimal('total_earnings', 10, 2)->nullable(); // total_earnings DECIMAL(10,2)
            $table->decimal('total_deductions', 10, 2)->nullable(); // total_deductions DECIMAL(10,2)
            $table->decimal('net_salary', 10, 2)->nullable(); // net_salary DECIMAL(10,2)
            $table->string('payment_method', 50); // payment_method VARCHAR(50) NOT NULL
            $table->timestamp('generated_at')->default(DB::raw('CURRENT_TIMESTAMP')); // generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

            // Foreign key constraint for employee_id referencing hrm_employees table
            $table->foreign('employee_id')->references('id')->on('hrm_employees')
                ->onDelete('cascade'); // Add onDelete to handle employee deletion behavior
            // Foreign key constraint for payslip_items_id referencing hrm_payslip_items table
            $table->foreign('payslip_items_id')->references('id')->on('hrm_payslip_items')
                ->onDelete('cascade'); // Add onDelete to handle payslip item deletion behavior
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_payslips');
    }
};
