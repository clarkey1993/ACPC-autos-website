<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalCars' => Car::count(),
            'availableCars' => Car::where('status', 'available')->count(),
            'soldCars' => Car::where('status', 'sold')->count(),
        ]);
    }
}
