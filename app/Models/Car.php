<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'sort_order',
        'featured_image',
        'slug',
    ];

    public function scopeOrderedForDisplay(Builder $query): Builder
    {
        return $query
            ->orderByRaw("CASE WHEN status = 'just_arrived' THEN 1 WHEN status = 'available' THEN 2 WHEN status = 'arriving_soon' THEN 3 WHEN status = 'reserved' THEN 4 WHEN status = 'sold' THEN 5 ELSE 6 END")
            ->orderByRaw('sort_order IS NULL')
            ->orderBy('sort_order')
            ->latest();
    }

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