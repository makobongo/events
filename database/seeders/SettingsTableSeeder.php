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
                'value' => 'The SIXX SPIRITS <br><span>EVENTS</span> Conference'
            ],
            [
                'key'   => 'subtitle',
                'value' => 'December, Downtown Conference Center, Nairobi'
            ],
            [
                'key'   => 'youtube_link',
                'value' => 'https://www.youtube.com/watch?v=vdwI2iKqV-U&pp=ygUVYWZyaWNhbiBhbGNvaG9sIHBhcnR5'
            ],
            [
                'key'   => 'about_description',
                'value' => 'Sed nam ut dolor qui repellendus iusto odit. Possimus inventore eveniet accusamus error amet eius aut accusantium et. Non odit consequatur repudiandae sequi ea odio molestiae. Enim possimus sunt inventore in est ut optio sequi unde.'
            ],
            [
                'key'   => 'about_where',
                'value' => 'Downtown Conference Center, Nairobi'
            ],
            [
                'key'   => 'about_when',
                'value' => 'Monday to Wednesday<br> December'
            ],
            [
                'key'   => 'contact_address',
                'value' => '00100 Off Mombasa Road, Nairobi Kenya, Kenya'
            ],
            [
                'key'   => 'contact_phone',
                'value' => '+2547 1666 7121'
            ],
            [
                'key'   => 'contact_email',
                'value' => 'sixxsocial@sixx-spirits.com'
            ],
            [
                'key'   => 'footer_description',
                'value' => 'In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.'
            ],
            [
                'key'   => 'footer_address',
                'value' => '00100 Off Mombasa Road <br> Nairobi, 00100<br> Kenya '
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
