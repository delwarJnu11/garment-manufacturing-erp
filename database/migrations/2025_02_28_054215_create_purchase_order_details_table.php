<?php

use App\Models\PurchaseOrderDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetailsTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id')->unsigned();
            $table->integer('product_id')->unsigned();
<<<<<<< HEAD
            // $table->integer('lot_id')->unsigned();
=======
            $table->integer('lot_id')->unsigned();
>>>>>>> 5974f2b7ccea101babc15445f301e85a12c4dcb9
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('%_of_discount')->default(0.00);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->decimal('vat', 10, 2)->default(0.00);
            $table->integer('%_of_vat')->default(0.00);
            $table->timestamps();
        });

<<<<<<< HEAD
        PurchaseOrderDetail::create([
            'purchase_id'   => 1,
            'product_id'    => 1,
            // 'lot_id'        => 1,
            'quantity'      => 50,
            'price'         => 1000.00,
            '%_of_discount' => 4,
            'discount'      => 2000,
            '%_of_vat'      => 10,
            'vat'           => 5000,
            'created_at'    => now(),
            'updated_at'    => now(),
=======

        PurchaseOrderDetail::create([
            'purchase_id' => 1,
            'product_id' => 1,
            'lot_id' => 1,
            'quantity' => 50,
            'price' => 1000.00,
            '%_of_discount' => 4,
            'discount' => 2000,
            '%_of_vat' => 10,
            'vat' => 5000,
            'created_at' => now(),
            'updated_at' => now(),
>>>>>>> 5974f2b7ccea101babc15445f301e85a12c4dcb9
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('purchase_order_details');
    }
}