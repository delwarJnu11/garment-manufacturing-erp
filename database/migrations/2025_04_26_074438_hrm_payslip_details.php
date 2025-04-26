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
        Schema::create('hrm_payslip_details', function (Blueprint $table) {
            $table->id(); // id INT PRIMARY KEY AUTO_INCREMENT
            $table->unsignedBigInteger('payslip_id'); // payslip_id INT NOT NULL
            $table->unsignedBigInteger('payslip_items_id'); // payslip_items_id INT NOT NULL
            $table->integer('factor'); // factor INT NOT NULL
            $table->decimal('allowance_amount', 10, 2)->nullable(); // allowance_amount DECIMAL(10,2)
            $table->decimal('deduction_amount', 10, 2)->nullable(); // deduction_amount DECIMAL(10,2)
            $table->decimal('total_amount', 10, 2); // total_amount DECIMAL(10,2)
            $table->timestamps(0); // created_at and updated_at with CURRENT_TIMESTAMP

            // Foreign key constraint for payslip_id referencing hrm_payslips table
            $table->foreign('payslip_id')->references('id')->on('hrm_payslips')
                ->onDelete('cascade'); // Add onDelete to handle payslip deletion behavior
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
        Schema::dropIfExists('hrm_payslip_details');
    }
};
