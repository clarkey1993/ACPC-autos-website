<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Enquiry;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalCars' => Car::count(),
            'availableCars' => Car::where('status', 'available')->count(),
            'reservedCars' => Car::where('status', 'reserved')->count(),
            'soldCars' => Car::where('status', 'sold')->count(),
            'totalEnquiries' => Enquiry::count(),
            'unreadEnquiries' => Enquiry::where('is_read', false)->count(),
            'recentEnquiries' => Enquiry::query()
                ->with('car')
                ->latest()
                ->take(5)
                ->get(),
            'recentCars' => Car::query()
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
