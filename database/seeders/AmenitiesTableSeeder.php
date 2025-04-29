<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            [
                'name' => 'Regular Entry for Over 18 years'
            ],
            [
                'name' => 'Music and Entertainment'
            ],
            [
                'name' => 'Terms and Conditions Apply'
            ],
            [
                'name' => '22.65% discount off Regular Ticket'
            ],
            [
                'name' => '3 Free Shots from 3- SIXX pm, while the stocks last.'
            ],
            [
                'name' => 'Covers 4 people.'
            ],
            [
                'name' => 'Price for online tickets only. Gate price is KSH 2166 per person'
            ],
            [
                'name' => '1 Bottle of <span style="color:#FFC300;">'.env('APP_NAME').'</span> Alcoholic Spirit, while the stocks last.'
            ],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}