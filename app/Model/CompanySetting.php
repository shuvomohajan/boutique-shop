<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'name',
        'mobile1',
        'mobile2',
        'email',
        'about',
        'about_footer',
        'facebook',
        'twitter',
        'instagram',
        'whatsapp',
        'location',
        'logo',
        'footer_logo',
    ];
}
