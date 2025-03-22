<?php

use App\Models\SalesInvoiceDetail;
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
        Schema::create('sales_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_invoice_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('qty'); // Sold quantity
            $table->decimal('unit_price', 10, 2);
            $table->decimal('percent_of_discount', 5, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('percent_of_vat', 5, 2)->default(0);
            $table->decimal('vat', 10, 2)->default(0);
            $table->timestamps();
        });


        SalesInvoiceDetail::create([
            'sales_invoice_id' => 1,
            'order_id' => 1,
            'qty' => 5,
            'unit_price' => 1000.00,
            'percent_of_discount' => 0.00,
            'discount' => 200.00,
            'percent_of_vat' => 0.00,
            'vat' => 250.00,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_invoice_details');
    }
};
