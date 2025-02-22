<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValuationMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('valuation_methods')->insert([
            'method_name' => 'FIFO', // Insert single data
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
