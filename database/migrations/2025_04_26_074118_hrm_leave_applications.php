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
        Schema::create('hrm_leave_applications', function (Blueprint $table) {
            $table->id(); // id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('employee_id'); // employee_id BIGINT UNSIGNED NOT NULL
            $table->string('leave_type_id'); // leave_type_id VARCHAR(255) NOT NULL
            $table->unsignedBigInteger('attendance_id'); // attendance_id BIGINT UNSIGNED NOT NULL
            $table->date('date'); // date DATE NOT NULL
            $table->date('start_date'); // start_date DATE NOT NULL
            $table->date('end_date'); // end_date DATE NOT NULL
            $table->decimal('number_of_days', 5, 2); // number_of_days DECIMAL(5,2) NOT NULL
            $table->text('reason'); // reason TEXT NOT NULL
            $table->string('duration'); // duration VARCHAR(255) NOT NULL
            $table->unsignedBigInteger('statuses_id'); // statuses_id BIGINT UNSIGNED NOT NULL
            $table->unsignedBigInteger('approver_id')->nullable(); // approver_id BIGINT UNSIGNED DEFAULT NULL
            $table->string('photo'); // photo VARCHAR(255) NOT NULL
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

            // Foreign key constraints
            $table->foreign('employee_id')->references('id')->on('hrm_employees')
                ->onDelete('cascade'); // Add onDelete to handle employee deletion behavior
            $table->foreign('attendance_id')->references('id')->on('hrm_attendance')
                ->onDelete('cascade'); // Add onDelete to handle attendance deletion behavior
            $table->foreign('statuses_id')->references('id')->on('hrm_statuses')
                ->onDelete('cascade'); // Add onDelete to handle status deletion behavior
            $table->foreign('approver_id')->references('id')->on('hrm_employees')
                ->onDelete('set null'); // Add onDelete to set approver_id to null if deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_leave_applications');
    }
};
