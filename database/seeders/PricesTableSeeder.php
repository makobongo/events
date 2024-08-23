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
                'name'  => 'Standard Access',
                'price' => 1500
            ],
            [
                'name'  => 'Pro Access',
                'price' => 2500
            ],
            [
                'name'  => 'Premium Access',
                'price' => 3500
            ],
        ];

        foreach($prices as $price)
        {
            Price::create($price);
        }
    }
}
