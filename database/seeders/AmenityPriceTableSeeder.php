<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenityPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $prices = [
            [
                'id' => 1,
                'amenities' => [3, 4, 5, 6, 7]
            ],
            [
                'id' => 2,
                'amenities' => [2, 4, 5, 6, 7]
            ],
            [
                'id' => 3,
                'amenities' => [1, 4, 6, 7, 8]
            ],
        ];

        foreach($prices as $price)
        {
            Price::find($price['id'])
                ->amenities()
                ->sync($price['amenities']);
        }
    }
}
