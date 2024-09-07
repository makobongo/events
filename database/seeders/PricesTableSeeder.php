<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $prices = [
            [
                'name'  => 'Early Bird Ticket',
                'price' => 1366
            ],
            [
                'name'  => 'Regular Ticket',
                'price' => 1500
            ],
            [
                'name'  => 'Group Ticket',
                'price' => 6866
            ],
        ];

        foreach($prices as $price)
        {
            Price::create($price);
        }
    }
}
