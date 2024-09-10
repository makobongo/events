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
                'name'  => 'Advance Early Bird Ticket<br/><button style="background-color: red;font-size: 14px;border-radius: 13px;"><strong>Sold Out</strong></button>',
                'price' => 1366
            ],
            [
                'name'  => 'Advance Regular Ticket',
                'price' => 1766
            ],
            [
                'name'  => 'Advance Group Ticket',
                'price' => 6866
            ],
        ];

        foreach($prices as $price)
        {
            Price::create($price);
        }
    }
}
