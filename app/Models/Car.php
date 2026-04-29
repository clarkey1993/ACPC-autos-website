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
        'location',
        'fuel_type',
        'transmission',
        'colour',
        'description',
        'status',
        'featured_image',
        'slug',
    ];

    public function cardStatusLabel(): string
    {
        return match ($this->status) {
            'available' => 'Available',
            'reserved' => 'Reserved',
            'sold' => 'Sold',
            'arriving_soon' => 'Arriving Soon',
            'just_arrived' => 'Just Arrived',
            default => 'Available',
        };
    }

    public function cardStatusBadgeClass(): string
    {
        return match ($this->status) {
            'available' => 'text-bg-success',
            'reserved' => 'text-bg-warning',
            'sold' => 'text-bg-secondary',
            'arriving_soon' => 'text-bg-info',
            'just_arrived' => 'text-bg-primary',
            default => 'text-bg-success',
        };
    }

    public function cardMileageText(): string
    {
        return $this->mileage !== null
            ? number_format((int) $this->mileage) . ' km'
            : 'Mileage on request';
    }

    public function cardLocationText(): string
    {
        $value = $this->location;

        return ($value !== null && $value !== '') ? $value : 'Málaga';
    }

    public function cardFuelText(): ?string
    {
        $value = $this->fuel_type;

        if ($value === null || $value === '') {
            return null;
        }

        return ucwords(strtolower((string) $value));
    }

    public function cardTransmissionText(): ?string
    {
        $value = $this->transmission;

        if ($value === null || $value === '') {
            return null;
        }

        return ucwords(strtolower((string) $value));
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }

    public function enquiries(): HasMany
    {
        return $this->hasMany(Enquiry::class);
    }
}