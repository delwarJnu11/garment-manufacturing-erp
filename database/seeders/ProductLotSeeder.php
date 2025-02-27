<?php

namespace Database\Seeders;

use App\Models\Product_lot;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductLotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate fake data and insert it into the database
        foreach (range(1, 5) as $index) { // Adjust range(1, 10) for the number of fake records
            Product_lot::create([
                'raw_material_id' => $faker->numberBetween(1, 10),  // Random raw material ID (ensure these IDs exist in raw_materials table)
                'quantity' => $faker->numberBetween(100, 1000),      // Random quantity
                'cost_price' => $faker->randomFloat(2, 50, 150),     // Random cost price between 50 and 150
                'warehouse_id' => $faker->numberBetween(1, 5),       // Random warehouse ID (ensure these IDs exist in warehouses table)
                'description' => $faker->sentence,                    // Random description
            ]);
        }
    }
}
