<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}