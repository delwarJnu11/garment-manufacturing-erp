<?php

use App\Models\Product;
use App\Models\ProductCatelogue;
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
        Schema::create('product_catelogues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku', 100)->unique();
            $table->text('description')->nullable();
            $table->string('barcode')->nullable()->unique();
            $table->integer('category_id');
            $table->integer('uom_id');
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        ProductCatelogue::create([
            'name' => 'T-Shirt',
            'sku' => 'TSH-001',
            'barcode' => '0123456789123',
            'category_id' => 1,
            'uom_id' => 1,
            'photo' => 'tshirt.jpg',
            'description' => 'Cotton T-shirt with logo'
        ]);

        ProductCatelogue::create([
            'name' => 'Jeans',
            'sku' => 'JNS-002',
            'barcode' => '0123456789124',
            'category_id' => 1,
            'uom_id' => 1,
            'photo' => 'jeans.jpg',
            'description' => 'Classic blue jeans'
        ]);

        ProductCatelogue::create([
            'name' => 'Jacket',
            'sku' => 'JKT-003',
            'barcode' => '0123456789125',
            'category_id' => 2,
            'uom_id' => 1,
            'photo' => 'jacket.jpg',
            'description' => 'Warm winter jacket'
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
