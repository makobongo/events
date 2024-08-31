<?php

namespace Database\Seeders;

use App\Models\Speaker;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpeakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $speakers = [
            [
                'name'              => 'Dj nas',
                'description'       => 'Quas alias incidunt',
                'twitter'           => '#',
                'facebook'          => '#',
                'linkedin'          => '#',
                'full_description'  => $faker->paragraph
            ],
            [
                'name'              => 'Dj b',
                'description'       => 'Consequuntur odio aut',
                'twitter'           => '#',
                'facebook'          => '#',
                'linkedin'          => '#',
                'full_description'  => $faker->paragraph
            ],
            [
                'name'              => 'Dj william',
                'description'       => 'Fugiat laborum et',
                'twitter'           => '#',
                'facebook'          => '#',
                'linkedin'          => '#',
                'full_description'  => $faker->paragraph
            ]
        ];
        foreach($speakers as $speaker)
        {
            $speaker = Speaker::create($speaker);
        }
    }
}
