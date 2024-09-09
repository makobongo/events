<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key'   => 'title',
                'value' => 'The <span>'.env('APP_NAME').'</span>'
            ],
            [
                'key'   => 'subtitle',
                'value' => 'Coopers Ring ASK Show Ground'
            ],
            [
                'key'   => 'youtube_link',
                'value' => '#'
            ],
            [
                'key'   => 'about_description',
                'value' => '<strong style="color: yellow;">'.env('APP_NAME').'</strong> a place to meet up and enjoy the company of good friends'
            ],
            [
                'key'   => 'about_where',
                'value' => 'Coopers Ring ASK Show Ground'
            ],
            [
                'key'   => 'about_when',
                'value' => '14th September 2024'
            ],
            [
                'key'   => 'contact_address',
                'value' => env('CONTACT_ADDRESS')
            ],
            [
                'key'   => 'contact_phone',
                'value' => env('CONTACT_NUMBER')
            ],
            [
                'key'   => 'contact_email',
                'value' => env('CONTACT_EMAIL')
            ],
            [
                'key'   => 'footer_description',
                'value' => '<strong style="color: yellow;">'.env('APP_NAME').'</strong> a place to meet up and enjoy the company of good friends.'
            ],
            [
                'key'   => 'footer_address',
                'value' => env('CONTACT_ADDRESS')
            ],
            [
                'key'   => 'footer_twitter',
                'value' => 'https://x.com/sixx6spirits'
            ],
            [
                'key'   => 'footer_facebook',
                'value' => 'https://www.facebook.com/profile.php?id=61553678562291'
            ],
            [
                'key'   => 'footer_instagram',
                'value' => '#'
            ],
            [
                'key'   => 'footer_googleplus',
                'value' => '#'
            ],
            [
                'key'   => 'footer_linkedin',
                'value' => '#'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
