<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'name'          => 'Hotel 1',
                'description'   => '0.4 Mile from the Venue',
                'rating'        =>  5,
                'img' => '1.jpg'
            ],
            [
                'name'          => 'Hotel 2',
                'description'   => '0.5 Mile from the Venue',
                'rating'        =>  4,
                'img' => '2.jpg'
            ],
            [
                'name'          => 'Hotel 3',
                'description'   => '0.6 Mile from the Venue',
                'rating'        =>  3,
                'img' => '3.jpg'
            ],
        ];

        foreach ($hotels as $key => $hotel) {
            $hotel = Hotel::create($hotel);
        }
    }
}
