<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'google_map',
        'facebook_link',
        'instagram_link',
        'linkedin_link',
        'tiktok_link',
        'reddit_link',
        'embed_fbpage'
    ];

    // Relationships
    public function siteSettings()
    {
        return $this->hasMany(SiteSetting::class);
    }
}