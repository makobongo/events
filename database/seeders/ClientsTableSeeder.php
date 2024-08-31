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
                'first_name' => $faker->firstName(),
                'second_name' => $faker->lastName(),
                'email' => $faker->safeEmail(),
                'phone_number' => $faker->numerify('2547######'),
                'is_valid' => $faker->randomElement([false, true])
            ]);
    }
}
