<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentAmount = $this->faker->randomElement([1500,2500,3500]);
        $accountBalance = $this->faker->randomElement([0,50,100]);
        $transId = $this->faker->randomElement(['PJJFK14R56','PKJFB14R86']);
        return [
            "TransactionType" => 'Pay bill',
            "TransID" => $transId,
            "TransTime" => now()->format('YmdHis'),
            "BusinessShortCode" => 174379,
            "BillRefNumber" => "SIXX SPIRITS EVENT",
            "MSISDN" => $this->faker->numerify('2547########'),
            "FirstName" => $this->faker->firstName(),
            "MiddleName" => $this->faker->firstNameMale(),
            "LastName" => $this->faker->lastName(),
            "TransAmount" => $paymentAmount,
            "OrgAccountBalance"=> $accountBalance,
            "ticket_number" => 'SIXX-'.$transId,
            'ticket_is_valid' => true,
        ];
    }
}
