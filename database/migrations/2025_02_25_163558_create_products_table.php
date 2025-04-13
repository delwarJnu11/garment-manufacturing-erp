<?php

use App\Models\Product;

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
            $table->string('image', 255)->nullable();
            $table->integer('product_type_id'); // Integer column for product_type_id 1=Raw material, 2= Finished Goods
            $table->integer('size_id')->nullable(); //For Finished goods only
            $table->string('sku')->unique();
            $table->integer('qty')->default(1);
            $table->integer('uom_id')->nullable();
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->timestamps();
        });
        Product::create([
            'name' => 'Red Cotton Fabric',
            'image' => "",
            'product_type_id' => 1, // Example: 1 for Raw Material

            'sku' => 'RCF-001',
            'qty' => 50,
            'uom_id' => 1,
            'unit_price' => 15.50
        ]);
        Product::create([
            'name' => 'Black T-shirt ',
            'image' => "",
            'product_type_id' => 2, // Example: 2 for Finished Goods
            'size_id' => 3,
            'sku' => 'BTS-M-003',
            'qty' => 100,
            'uom_id' => 1,
            'unit_price' => 25.00
        ]);

        Product::create([
            'name' => 'White Shirt ',
            'image' => "",
            'product_type_id' => 2, // Example: 2 for Finished Goods
            'size_id' => 3,
            'sku' => 'WSH-L-004',
            'qty' => 62,
            'uom_id' => 1,
            'unit_price' => 30.00
        ]);
        Product::create([
            'name' => 'Denim fabric ',
            'image' => "",
            'product_type_id' => 1,

            'sku' => 'WSH-L-005',
            'qty' => 62,
            'uom_id' => 1,
            'unit_price' => 30.00
        ]);
        Product::create([
            'name' => 'Dyes & Pigments ',
            'image' => "",
            'product_type_id' => 1,
            'sku' => 'D-L-004',
            'qty' => 22,
            'uom_id' => 1,
            'unit_price' => 30.00
        ]);
        Product::create([
            'name' => 'Labels & Tags ',
            'image' => "",
            'product_type_id' => 1,

            'sku' => 'DL-004',
            'qty' => 20,
            'uom_id' => 1,
            'unit_price' => 30.00
        ]);
        Product::create([
            'name' => 'Carton boxes ',
            'image' => "",
            'product_type_id' => 1,
            'sku' => 'CL-004',
            'qty' => 20,
            'uom_id' => 1,
            'unit_price' => 30.00
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
