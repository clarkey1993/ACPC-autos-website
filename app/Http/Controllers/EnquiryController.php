<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryReceivedMail;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $enquiry = $car->enquiries()->create($validated);

        $enquiry->load('car');

        $recipient = env('MAIL_ENQUIRY_TO', 'admin@example.com');

        Mail::to($recipient)->send(new EnquiryReceivedMail($enquiry));

        return redirect()
            ->back()
            ->with('success', 'Thank you. Your enquiry has been sent.');
    }
}
