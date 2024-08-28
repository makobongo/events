<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PricesTableSeeder::class,
            VenuesTableSeeder::class,
            SpeakersTableSeeder::class,
            AmenitiesTableSeeder::class,
            AmenityPriceTableSeeder::class,
            GallariesTableSeeder::class,
            SponsorsTableSeeder::class,
            PaymentsTableSeeder::class,
        ]);
    }
}
