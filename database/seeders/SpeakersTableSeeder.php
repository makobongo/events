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
                'name'              => 'DJ BADMAN KIM',
                'description'       => '@djbadmankim',
                'twitter'           => '#',
                'facebook'          => '#',
                'linkedin'          => '#',
                'full_description'  => $faker->paragraph
            ],
            [
                'name'              => 'DJ KYLE',
                'description'       => '@djkyle',
                'twitter'           => '#',
                'facebook'          => '#',
                'linkedin'          => '#',
                'full_description'  => $faker->paragraph
            ],
            [
                'name'              => 'DJ MOBY',
                'description'       => '@djmoby',
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
