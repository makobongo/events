<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'name' => 'Strider',
                'link' => '#',
                'img' => 1
            ],
            [
                'name' => 'Runtastic',
                'link' => '#',
                'img' => 2
            ],
            [
                'name' => 'EditShare',
                'link' => '#',
                'img' => 3
            ],
            [
                'name' => 'InFocus',
                'link' => '#',
                'img' => 4
            ],
            [
                'name' => 'gategroup',
                'link' => '#',
                'img' => 5
            ],
            [
                'name' => 'Cadent',
                'link' => '#',
                'img' => 6
            ],
            [
                'name' => 'Ceph',
                'link' => '#',
                'img' => 7
            ],
            [
                'name' => 'Alitalia',
                'link' => '#',
                'img' => 8
            ],
        ];

        foreach($sponsors as $key => $sponsor)
        {
            $sponsor = Sponsor::create($sponsor);
        }
    }
}
