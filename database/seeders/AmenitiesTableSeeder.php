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
                'name' => '16.6% discount off Regular Ticket'
            ],
            [
                'name' => 'Regular Entry for Over 18 years'
            ],
            [
                'name' => 'Welcome Cocktail 3-SIXXpm'
            ],
            [
                'name' => 'Music and Entertainment'
            ],
            [
                'name' => 'Terms and Conditions Apply'
            ],
            [
                'name' => '1 Bottle of SIXX SOCIAL Alcoholic Spirit'
            ],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}