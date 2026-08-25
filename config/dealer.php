<?php

return [
    'admin_emails' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('DEALER_ADMIN_EMAILS', ''))
    ))),

    /*
    | Google Analytics 4 measurement ID (e.g. G-XXXXXXXXXX). Leave empty to disable.
    | Loaded only after the visitor accepts non-essential cookies (see cookie banner).
    */
    'analytics_measurement_id' => env('DEALER_ANALYTICS_MEASUREMENT_ID'),

    'phone_display' => env('DEALER_PHONE_DISPLAY', '+353 87 000 0000'),
    'phone_tel' => env('DEALER_PHONE_TEL', '+353870000000'),
    'whatsapp_number' => env('DEALER_WHATSAPP_NUMBER', '353870000000'),
    'whatsapp_message' => env('DEALER_WHATSAPP_MESSAGE', "Hi, I'm interested in one of your cars"),
    'email_display' => env('DEALER_EMAIL_DISPLAY', 'sales@example.com'),
    'email_mailto' => env('DEALER_EMAIL_MAILTO', 'mailto:sales@example.com'),
];
