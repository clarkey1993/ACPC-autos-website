<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        $settings = SiteSetting::query()->firstOrFail();

        return view('admin.site-settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = SiteSetting::query()->firstOrFail();

        $wa = $request->input('whatsapp_number');
        if (is_string($wa) && $wa !== '') {
            $digits = preg_replace('/\D+/', '', $wa);
            $request->merge(['whatsapp_number' => $digits !== '' ? $digits : null]);
        } else {
            $request->merge(['whatsapp_number' => null]);
        }

        $validated = $request->validate([
            'business_phone' => ['nullable', 'string', 'max:80'],
            'business_email' => ['nullable', 'string', 'max:120', 'email'],
            'whatsapp_number' => ['nullable', 'string', 'max:32', 'regex:/^[0-9]+$/'],
            'opening_hours_text' => ['nullable', 'string', 'max:2000'],
        ], [
            'whatsapp_number.regex' => 'WhatsApp number must be digits only (country code + number, no spaces or +).',
        ]);

        foreach (['business_phone', 'business_email', 'opening_hours_text'] as $key) {
            if (array_key_exists($key, $validated) && is_string($validated[$key]) && trim($validated[$key]) === '') {
                $validated[$key] = null;
            }
        }

        $settings->update($validated);

        return redirect()
            ->route('admin.site-settings.edit')
            ->with('success', 'Site settings saved.');
    }
}
