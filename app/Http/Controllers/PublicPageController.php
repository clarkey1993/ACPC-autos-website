<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PublicPageController extends Controller
{
    public function about(): View
    {
        return view('public.about');
    }

    public function contact(): View
    {
        $publicWhatsAppNumber = (string) config('dealer.whatsapp_number');
        $publicWhatsAppMessage = (string) config('dealer.whatsapp_message');
        $whatsAppUrl = 'https://wa.me/' . $publicWhatsAppNumber . '?text=' . rawurlencode($publicWhatsAppMessage);

        return view('public.contact', compact('whatsAppUrl'));
    }

    public function warranty(): View
    {
        return view('public.warranty');
    }

    public function privacyPolicy(): View
    {
        return view('public.privacy-policy');
    }

    public function termsAndConditions(): View
    {
        return view('public.terms-and-conditions');
    }

    public function cookiePolicy(): View
    {
        return view('public.cookie-policy');
    }

    public function faq(): View
    {
        return view('public.faq');
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $recipient = config('mail.enquiry_to');

        Mail::raw(
            "New website contact request\n\n"
            . "Name: {$validated['name']}\n"
            . "Email: {$validated['email']}\n"
            . "Phone: " . ($validated['phone'] ?: __('public.fallback.not_provided')) . "\n\n"
            . "Message:\n{$validated['message']}\n",
            function ($message) use ($recipient, $validated): void {
                $message->to($recipient)
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject('New contact request: ' . $validated['name']);
            }
        );

        return redirect()
            ->back()
            ->with('success', __('public.contact.success'));
    }
}
