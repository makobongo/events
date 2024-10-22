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
            'first_name' => 'sixx',
            'second_name' => 'spirits',
            'email' => 'autoassured@gmail.com',
            'phone' => 254716667121,
            'sha_phone'=>'f0bcffce5abc76e7f0ca68e332d7365ba9d34b6a7b519d87f61e8c75ed4a5f3d',
            'number_of_ticket' => 1,
            'name_of_ticket' => 'Advance Early Bird Ticket',
            'ticket_cost' => 1500,
            'is_valid' => $faker->randomElement([false, true])
        ]);
    }
}
