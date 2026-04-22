<?php

namespace App\Http\Controllers;

use App\Models\Car;

class CarListingController extends Controller
{
    public function home()
    {
        $latestCars = Car::query()
            ->with('images')
            ->orderByRaw("CASE WHEN status = 'available' THEN 1 WHEN status = 'reserved' THEN 2 WHEN status = 'sold' THEN 3 ELSE 4 END")
            ->latest()
            ->take(3)
            ->get();

        return view('public.home', compact('latestCars'));
    }

    public function index()
    {
        $cars = Car::query()
            ->with('images')
            ->orderByRaw("CASE WHEN status = 'available' THEN 1 WHEN status = 'reserved' THEN 2 WHEN status = 'sold' THEN 3 ELSE 4 END")
            ->latest()
            ->paginate(12);

        return view('public.cars.index', compact('cars'));
    }

    public function show(string $slug)
    {
        $car = Car::query()
            ->with('images')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.cars.show', compact('car'));
    }
}
