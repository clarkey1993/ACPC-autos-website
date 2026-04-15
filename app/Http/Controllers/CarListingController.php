<?php

namespace App\Http\Controllers;

use App\Models\Car;

class CarListingController extends Controller
{
    public function home()
    {
        $latestCars = Car::query()
            ->where('status', 'available')
            ->latest()
            ->take(3)
            ->get();

        return view('public.home', compact('latestCars'));
    }

    public function index()
    {
        $cars = Car::query()
            ->where('status', 'available')
            ->latest()
            ->paginate(12);

        return view('public.cars.index', compact('cars'));
    }

    public function show(string $slug)
    {
        $car = Car::query()
            ->with('images')
            ->where('status', 'available')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.cars.show', compact('car'));
    }
}
