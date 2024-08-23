<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $gallery = Gallery::create([
        //     'name' => 'Event'
        // ]);
        foreach(range(1,8) as $id)
        {
            Gallery::create($id);
        }
    }
}
