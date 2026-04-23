<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'business_phone',
        'business_email',
        'whatsapp_number',
        'opening_hours_text',
        'enable_dedicated_cars_page',
    ];

    protected $casts = [
        'enable_dedicated_cars_page' => 'boolean',
    ];
}
