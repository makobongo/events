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
                'name' => '22.65% discount off Regular Ticket'
            ],
            [
                'name' => 'Regular Entry for Over 18 years'
            ],
            [
                'name' => '3 Free Shots from 3- SIXX pm, while the stocks last.'
            ],
            [
                'name' => 'Music and Entertainment'
            ],
            [
                'name' => 'Terms and Conditions Apply'
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