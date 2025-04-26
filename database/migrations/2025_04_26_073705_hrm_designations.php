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
        Schema::create('hrm_designations', function (Blueprint $table) {
            $table->id(); // id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('title'); // title VARCHAR(255) NOT NULL
            $table->unsignedBigInteger('department_id'); // department_id INT UNSIGNED NOT NULL
            $table->text('description')->nullable(); // description TEXT NULL
            $table->unsignedBigInteger('statuses_id'); // statuses_id BIGINT UNSIGNED NOT NULL
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

            // Foreign key constraint for department_id referencing hrm_departments table
            $table->foreign('department_id')->references('id')->on('hrm_departments')
                ->onDelete('cascade'); // Add onDelete to handle department deletion behavior

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
        Schema::dropIfExists('hrm_designations');
    }
};
