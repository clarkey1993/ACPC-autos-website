<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CarListingController extends Controller
{
    public function home(): View
    {
        $cars = Car::query()
            ->with('images')
            ->orderedForDisplay()
            ->get();

        return view('public.home', compact('cars'));
    }

    public function index(): View|RedirectResponse
    {
        $settings = SiteSetting::query()->first();
        if (! $settings || ! $settings->enable_dedicated_cars_page) {
            return redirect()->route('home');
        }

        $cars = Car::query()
            ->with('images')
            ->orderedForDisplay()
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
