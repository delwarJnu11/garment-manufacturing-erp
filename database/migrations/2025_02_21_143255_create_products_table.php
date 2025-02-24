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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku', 100)->unique(); // 'TSH-001', 'JNS-002', 'JKT-003'
            $table->text('description')->nullable(); // 'Cotton T-shirt with logo'
            $table->decimal('unit_price', 10, 2)->default(0.00); // 10.99, 25.50, 40.00
            $table->decimal('offer_price', 10, 2)->default(0.00); // 9.99, 22.00, 38.00
            $table->integer('weight')->nullable(); // 200 (grams), 500, 1000
            $table->integer('size_id'); // 1 (S), 2 (M), 3 (L)
            $table->boolean('is_raw_material')->default(0); // 1 (Yes - Fabric), 0 (No - Finished Goods)
            $table->string('barcode')->nullable()->unique(); // '0123456789123'
            $table->string('rfid')->nullable()->unique(); // 'RFID123456'
            $table->integer('category_attributes_id'); // 1 (Men's Wear), 2 (Women's Wear)
            $table->integer('uom_id'); // 1 (Pieces), 2 (Kilograms)
            $table->integer('valuation_method_id'); // 1 (FIFO), 2 (LIFO)
            $table->string('photo')->nullable(); // 'tshirt.jpg', 'jeans.jpg'
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
