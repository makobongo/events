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
                'amenities' => [1, 2, 3, 4, 5]
            ],
            [
                'id' => 2,
                'amenities' => [1, 2, 3, 4, 5]
            ],
            [
                'id' => 3,
                'amenities' => [1, 2, 3, 4, 5, 6]
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
