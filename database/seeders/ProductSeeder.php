<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('products')->insert([
            'name' => $faker->word, // e.g. 'T-Shirt'
            'sku' => 'TSH-' . strtoupper($faker->lexify('???')) . $faker->randomNumber(3, true), // e.g. TSH-ABC123
            'description' => $faker->sentence, // e.g. 'Cotton T-shirt with logo'
            'unit_price' => $faker->randomFloat(2, 10, 100), // Random price between 10 and 100
            'offer_price' => $faker->randomFloat(2, 5, 50), // Random price between 5 and 50
            'weight' => $faker->numberBetween(100, 1000), // Random weight between 100 and 1000 grams
            'size_id' => 1, // Example: Size S
            // 'is_raw_material' => $faker->boolean, // Random true/false for raw material
            'barcode' => $faker->ean13, // Random barcode
            'rfid' => 'RFID' . $faker->randomNumber(6, true), // Random RFID number
            'category_attributes_id' => 1, // Example category ID
            'uom_id' => 1, // Example UOM ID (e.g. Pieces)
            'valuation_method_id' => 1, // Example valuation method ID (e.g. FIFO)
            'photo' => 'product_image.jpg', // Example image file
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
