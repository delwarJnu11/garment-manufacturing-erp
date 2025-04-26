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
        Schema::create('hrm_attendances_lists', function (Blueprint $table) {
            $table->id(); // id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('employee_id'); // employee_id BIGINT UNSIGNED NOT NULL
            $table->date('date'); // date DATE NOT NULL
            $table->unsignedBigInteger('statuses_id'); // statuses_id BIGINT UNSIGNED NOT NULL
            $table->time('clock_in')->default('00:00:00'); // clock_in TIME DEFAULT '00:00:00'
            $table->time('clock_out')->default('00:00:00'); // clock_out TIME DEFAULT '00:00:00'
            $table->tinyInteger('late_days')->unsigned()->default(0); // late_days TINYINT UNSIGNED DEFAULT 0
            $table->tinyInteger('leave_days')->unsigned()->default(0); // leave_days TINYINT UNSIGNED DEFAULT 0
            $table->time('late_times')->default('00:00:00'); // late_times TIME DEFAULT '00:00:00'
            $table->time('leave_times')->default('00:00:00'); // leave_times TIME DEFAULT '00:00:00'
            $table->decimal('total_work_hours', 5, 2)->default(0.00); // total_work_hours DECIMAL(5,2) DEFAULT '0.00'
            $table->time('overtime_hours')->default('00:00:00'); // overtime_hours TIME DEFAULT '00:00:00'
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

            // Foreign key constraint for employee_id referencing hrm_employees table
            $table->foreign('employee_id')->references('id')->on('hrm_employees')
                ->onDelete('cascade'); // Add onDelete to handle employee deletion behavior
            // Foreign key constraint for statuses_id referencing hrm_statuses table
            $table->foreign('statuses_id')->references('id')->on('hrm_statuses')
                ->onDelete('cascade'); // Add onDelete to handle status deletion behavior
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_attendances_lists');
    }
};
