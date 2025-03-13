<?php

use App\Models\Sale;
use App\Models\SalesInvoice;
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
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id'); 
            $table->dateTime('sale_date')->default(now()); 
            $table->decimal('total_amount', 10, 2)->default(0); 
            $table->decimal('paid_amount', 10, 2)->default(0); 
            $table->decimal('discount', 10, 2)->default(0); 
            $table->decimal('vat', 10, 2)->default(0); 
            $table->unsignedBigInteger('invoice_status_id')->default(1);
            $table->text('remark')->nullable(); // Optional remark
            $table->timestamps();
        });
        SalesInvoice::create([
            'buyer_id' => 1,
            'sale_date' => now(),
            'total_amount' => 5000.00,
            'paid_amount' => 3000.00,
            'discount' => 200.00,
            'vat' => 250.00,
            'invoice_status_id' => 1,
            'remark' => 'First test sale',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
