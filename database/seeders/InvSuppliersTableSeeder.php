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
    //     INSERT INTO inv_suppliers (first_name, last_name, email, phone, address, photo, created_at, updated_at) VALUES
    // ('Rahim', 'Uddin', 'rahim.uddin@example.com', '01710000001', 'Dhaka, Bangladesh', 'default.png', NOW(), NOW()),
    // ('Karim', 'Ahmed', 'karim.ahmed@example.com', '01710000002', 'Chattogram, Bangladesh', 'default.png', NOW(), NOW()),
    // ('Ayesha', 'Sultana', 'ayesha.sultana@example.com', '01710000003', 'Sylhet, Bangladesh', 'default.png', NOW(), NOW()),
    // ('Farhana', 'Jahan', 'farhana.jahan@example.com', '01710000004', 'Khulna, Bangladesh', 'default.png', NOW(), NOW());

}
