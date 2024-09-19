<?php

namespace Database\Seeders;

use App\Models\Client;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        Client::create([
            'first_name' => 'Steve',
            'second_name' => 'Obongo',
            'email' => 'autoassured@gmail.com',
            'phone' => 254715096287,
            'sha_phone'=>'988caf8d9f287296ce58e6b62c0c56a511a5d65a450cee4c0e95765da8da1df6',
            'number_of_ticket' => 1,
            'name_of_ticket' => 'Advance Early Bird Ticket',
            'ticket_cost' => 1500,
            'is_valid' => $faker->randomElement([false, true])
        ]);
    }
}
