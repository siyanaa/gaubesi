<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favicon;

class FaviconsTableSeeder extends Seeder
{
    public function run()
    {
        Favicon::create([
            'favicon_thirtytwo' => 'favicon-32x32.png',
            'favicon_sixteen' => 'favicon-16x16.png',
            'favicon_ico' => 'favicon.ico',
            'appletouch_icon' => 'apple-touch-icon.png',
            'site_manifest' => 'site.webmanifest',
        ]);
    }
}