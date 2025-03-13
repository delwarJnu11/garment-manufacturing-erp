<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvoiceStatus; // Import your model

class PurchaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert fake data
        InvoiceStatus::create([
            'name' => 'Pending',
            'description' => 'The order is placed but not yet confirmed by the supplier.',
        ]);
        InvoiceStatus::create([
            'name' => 'Confirmed',
            'description' => 'The order has been confirmed by the supplier.',
        ]);
        InvoiceStatus::create([
            'name' => 'Shipped',
            'description' => 'The order has been shipped by the supplier.',
        ]);
        InvoiceStatus::create([
            'name' => 'Delivered',
            'description' => 'The order has been delivered to the warehouse.',
        ]);
    }
}
