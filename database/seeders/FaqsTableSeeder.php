<?php

namespace Database\Seeders;

use App\Models\Faq;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question'              => 'What kind of Event is the SIXX Social?',
                'answer'       => 'It is a SIXX Spirits community afternoon and early evening Social Event to socialize and enjoy music with good friends'
            ],
            [
                'question'              => 'How do I pay for the ticket?',
                'answer'       => 'Following the steps on the website, by providing your name and telephone number you will receive a prompt to make payment via MPESA'
            ],
            [
                'question'              => 'What format is the ticket?',
                'answer'       => 'Once you complete ticket purchase you will receive a Digital PDF ticket that will emailed to you on the email address provided'
            ],
            [
                'question'              => 'Can I attend the event if I am below 18 years of Age accompanying an Adult?',
                'answer'       => 'NO.  The event is strictly for Adults over the Age of 18'
            ],
            [
                'question'              => 'Can I resale my event ticket after purchase',
                'answer'       => 'NO, tickets cannot be resold or redeemed for a refund after purchase '
            ],
            [
                'question'              => 'Are pets allowed?',
                'answer'       => 'NO Animals are allowed at the event'
            ]
        ];
        foreach($faqs as $faq)
        {
            $speaker = Faq::create($faq);
        }
    }
}
