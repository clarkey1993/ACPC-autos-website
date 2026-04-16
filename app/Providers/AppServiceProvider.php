<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->sharePublicContactSettings();
    }

    /**
     * Share footer / contact values used on the public site (single site_settings row).
     */
    private function sharePublicContactSettings(): void
    {
        $fallback = [
            'siteSettings' => null,
            'publicPhoneDisplay' => config('dealer.phone_display'),
            'publicPhoneTel' => config('dealer.phone_tel'),
            'publicEmailDisplay' => config('dealer.email_display'),
            'publicEmailMailto' => config('dealer.email_mailto'),
            'publicWhatsAppNumber' => config('dealer.whatsapp_number'),
            'publicAppointmentsText' => 'Viewings by appointment only',
        ];

        try {
            if (! Schema::hasTable('site_settings')) {
                View::share($fallback);

                return;
            }

            $settings = SiteSetting::query()->first();
            if (! $settings) {
                View::share($fallback);

                return;
            }

            $appointments = trim((string) ($settings->opening_hours_text ?? ''));
            if ($appointments === '') {
                $appointments = $fallback['publicAppointmentsText'];
            }

            View::share([
                'siteSettings' => $settings,
                'publicPhoneDisplay' => filled($settings->business_phone)
                    ? $settings->business_phone
                    : $fallback['publicPhoneDisplay'],
                'publicPhoneTel' => filled($settings->business_phone)
                    ? $settings->business_phone
                    : $fallback['publicPhoneTel'],
                'publicEmailDisplay' => filled($settings->business_email)
                    ? $settings->business_email
                    : $fallback['publicEmailDisplay'],
                'publicEmailMailto' => filled($settings->business_email)
                    ? 'mailto:'.$settings->business_email
                    : $fallback['publicEmailMailto'],
                'publicWhatsAppNumber' => filled($settings->whatsapp_number)
                    ? $settings->whatsapp_number
                    : $fallback['publicWhatsAppNumber'],
                'publicAppointmentsText' => $appointments,
            ]);
        } catch (\Throwable $e) {
            View::share($fallback);
        }
    }
}
