<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(range(1,8) as $id)
        {
            Payment::create([
                "TransactionType" => Str::random(10, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),
                "TransID" => "",
                "TransTime" => "",
                "BusinessShortCode" => "",
                "BillRefNumber" => "",
                "InvoiceNumber" => "",
                "ThirdPartyTransID" => "",
                "MSISDN" => "",
                "FirstName" => "",
                "MiddleName" => "",
                "LastName" => "",
                "TransAmount", 8, 2 => "",
                "OrgAccountBalance", 8, 2 => "",
                'ticket_is_valid' => "",
            ]);
        }
    }
}
