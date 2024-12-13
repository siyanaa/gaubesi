<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TermsandConditions extends Model
{
  
    use HasFactory;

    protected $table = 'termsandconditions';

    protected $fillable = [
        'policy_type',
        'description',
    ];

    // Accessor to return description as an array
    public function getDescriptionAttribute($value)
    {
        return json_decode($value, true);
    }

    // Mutator to save description as JSON
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = json_encode($value);
    }
}


