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
        Schema::create('hrm_leave_types', function (Blueprint $table) {
            $table->id(); // id INT PRIMARY KEY AUTO_INCREMENT
            $table->string('name', 100); // name VARCHAR(100) NOT NULL
            $table->string('code', 50)->unique(); // code VARCHAR(50) NOT NULL UNIQUE
            $table->text('description')->nullable(); // description TEXT NULL
            $table->integer('max_days')->default(0); // max_days INT NOT NULL DEFAULT 0
            $table->boolean('is_paid')->default(true); // is_paid BOOLEAN NOT NULL DEFAULT 1
            $table->boolean('requires_approval')->default(true); // requires_approval BOOLEAN NOT NULL DEFAULT 1
            $table->boolean('carry_forward')->default(false); // carry_forward BOOLEAN NOT NULL DEFAULT 0
            $table->unsignedBigInteger('statuses_id'); // statuses_id BIGINT UNSIGNED NOT NULL
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

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
        Schema::dropIfExists('hrm_leave_types');
    }
};
