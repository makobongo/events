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
                'value' => '6IXX Quarry, Nairobi'
            ],
            [
                'key'   => 'youtube_link',
                'value' => '#'
            ],
            [
                'key'   => 'about_description',
                'value' => env('APP_NAME').' event'
            ],
            [
                'key'   => 'about_where',
                'value' => '6IXX Quarry'
            ],
            [
                'key'   => 'about_when',
                'value' => 'Monday to Wednesday<br> December'
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
                'value' => 'In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.'
            ],
            [
                'key'   => 'footer_address',
                'value' => env('CONTACT_ADDRESS')
            ],
            [
                'key'   => 'footer_twitter',
                'value' => '#'
            ],
            [
                'key'   => 'footer_facebook',
                'value' => '#'
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
