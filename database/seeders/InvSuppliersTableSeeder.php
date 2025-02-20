<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InvSuppliersTableSeeder extends Seeder
{
    /**
     * 
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();



        foreach (range(1, 10) as $index) {
            DB::table('inv_suppliers')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->unique()->phoneNumber,
                'address' => $faker->address,
                'photo' => $faker->imageUrl(640, 480, 'business', true, 'Faker'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
