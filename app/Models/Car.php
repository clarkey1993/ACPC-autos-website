<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'title',
        'make',
        'model',
        'year',
        'price',
        'mileage',
        'fuel_type',
        'transmission',
        'colour',
        'description',
        'status',
        'featured_image',
        'slug',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }
}