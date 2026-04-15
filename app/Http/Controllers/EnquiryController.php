<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $car->enquiries()->create($validated);

        return redirect()
            ->back()
            ->with('success', 'Thank you. Your enquiry has been sent.');
    }
}
