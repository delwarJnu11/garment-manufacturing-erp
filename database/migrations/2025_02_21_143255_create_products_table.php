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
            $table->string('name'); // 'T-Shirt', 'Jeans', 'Jacket'
            $table->string('sku', 100)->unique(); // 'TSH-001', 'JNS-002', 'JKT-003'
            $table->text('description')->nullable(); // 'Cotton T-shirt with logo'
            $table->string('barcode')->nullable()->unique(); // '0123456789123'
            $table->integer('category_id'); // 1 (Men's Wear), 2 (Women's Wear)
            $table->integer('uom_id'); // 1 (Pieces), 2 (Kilograms)
           
            $table->string('photo')->nullable(); // 'tshirt.jpg', 'jeans.jpg'
            $table->timestamps(); // created_at, updated_at
        });

        Product::create([
            'name' => 'T-Shirt',
            'sku' => 'TSH-001',
            'barcode' => '0123456789123',
            'category_id' => 1,
            'uom_id' => 1,
            'photo' => 'tshirt.jpg',
            'description' => 'Cotton T-shirt with logo'
        ]);
    
        Product::create([
            'name' => 'Jeans',
            'sku' => 'JNS-002',
            'barcode' => '0123456789124',
            'category_id' => 1,
            'uom_id' => 1,
            'photo' => 'jeans.jpg',
            'description' => 'Classic blue jeans'
        ]);
    
        Product::create([
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
