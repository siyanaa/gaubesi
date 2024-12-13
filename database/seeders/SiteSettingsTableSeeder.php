<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;


class SiteSettingsTableSeeder extends Seeder
{
    public function run()
    {
    
        SiteSetting::create([
           'office_title' => 'Sample Office',
                    'office_address' => json_encode(['Street' => '123 Sample St', 'City' => 'Sample City', 'Country' => 'Sample Country']),
                    'office_contact' => json_encode(['Phone' => '+123456789', 'Fax' => '+987654321']),
                    'office_email' => json_encode(['info@example.com', 'support@example.com']),
                    'office_description' => 'This is a sample office description.',
                    'established_year' => '2000',
                    'slogan' => 'Sample Slogan',
                    'main_logo' => 'logo.png',
                    'side_logo' => 'side_logo.png',
                    'status' => true,
                    'social_links_id' => 1,
        ]);
    }
            }
       
