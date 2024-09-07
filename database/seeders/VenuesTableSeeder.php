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
            'name'          => 'Coopers Ring ASK Show Ground',
            'address'       => '00100 Nairobi',
            'latitude'      => '-1.308495',
            'longitude'     => '36.766970',
            'description'   =>  '.'
        ]);
    }
}
