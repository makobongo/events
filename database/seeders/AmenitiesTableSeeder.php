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
                'name' => 'Regular Seating'
            ],
            [
                'name' => 'Coffee Break'
            ],
            [
                'name' => 'Custom Badge'
            ],
            [
                'name' => 'Community Access'
            ],
            [
                'name' => 'Workshop Access'
            ],
            [
                'name' => 'After Party'
            ],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
