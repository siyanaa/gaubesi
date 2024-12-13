<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialLink;

class SocialLinksTableSeeder extends Seeder
{
    public function run()
    {
        SocialLink::create([
            'google_map' => 'https://maps.google.com/sample-link',
            'facebook_link' => 'https://facebook.com/sample-page',
            'instagram_link' => 'https://instagram.com/sample-profile',
            'linkedin_link' => 'https://linkedin.com/sample-profile',
            'tiktok_link' => 'https://tiktok.com/@sample-profile',
            'reddit_link' => 'https://reddit.com/user/sample-profile',
            'embed_fbpage' => '<iframe src="https://www.facebook.com/plugins/page.php?href=https://facebook.com/sample-page"></iframe>',
        ]);
    }
}