<?php

return [
    'canonical_url' => env(
        'SEO_CANONICAL_URL',
        env('APP_ENV', 'production') === 'production'
            ? 'https://acpcautos.com'
            : env('APP_URL', '')
    ),

    // Enabled automatically in production and disabled for local development/tests.
    'enforce_canonical_url' => env(
        'SEO_ENFORCE_CANONICAL_URL',
        env('APP_ENV', 'production') === 'production'
    ),
];
