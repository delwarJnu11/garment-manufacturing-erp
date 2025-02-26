<?php

use App\Models\ProductVariant;
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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('product_type_id'); // Integer column for product_type_id
            $table->integer('size_id')->nullable(); // Integer column for product_type_id
            $table->string('sku')->unique();
            $table->integer('qty')->default(1);
            $table->integer('uom_id')->nullable();
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->timestamps();
        });
        ProductVariant::create([
            'name' => 'Red Cotton Fabric',
            'product_type_id' => 1, // Example: 1 for Raw Material
            'size_id' => 1,
            'sku' => 'RCF-001',
            'qty' => 50,
            'uom_id' => 1,
            'unit_price' => 15.50
        ]);
        ProductVariant::create([
            'name' => 'Black T-shirt ',
            'product_type_id' => 2, // Example: 2 for Finished Goods
            'size_id' => 3,
            'sku' => 'BTS-M-003',
            'qty' => 100,
            'uom_id' => 1,
            'unit_price' => 25.00
        ]);

        ProductVariant::create([
            'name' => 'White Shirt ',
            'product_type_id' => 2, // Example: 2 for Finished Goods
            'size_id' => 3,
            'sku' => 'WSH-L-004',
            'qty' => 62,
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
