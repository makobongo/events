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
            'name'          => 'Downtown Conference Center, Nairobi',
            'address'       => '00100 Nairobi Off Mombasa road',
            'latitude'      => '-1.3155358296492337',
            'longitude'     => '36.918241038449764',
            'description'   =>  'Iste nobis eum sapiente sunt enim dolores labore accusantium autem. Cumque beatae ipsam. Est quae sit qui voluptatem corporis velit. Qui maxime accusamus possimus. Consequatur sequi et ea suscipit enim nesciunt quia velit.'
        ]);
    }
}
