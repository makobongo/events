<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $venue = Venue::create([
            'name'          => 'SIXX QUARRY',
            'address'       => '00100 Nairobi',
            'latitude'      => '-1.3155358296492337',
            'longitude'     => '36.918241038449764',
            'description'   =>  'Iste nobis eum sapiente labore.'
        ]);
    }
}
