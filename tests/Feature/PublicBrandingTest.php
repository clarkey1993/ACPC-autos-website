<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicBrandingTest extends TestCase
{
    public function test_public_header_and_footer_use_shield_branding(): void
    {
        config(['seo.enforce_canonical_url' => false]);

        $response = $this->get('/cookie-policy');

        $response->assertOk();
        $this->assertSame(1, substr_count(
            $response->getContent(),
            'src="'.asset('images/acpc-header-shield-gold-v1.webp').'"'
        ));
        $this->assertSame(1, substr_count(
            $response->getContent(),
            'src="'.asset('images/acpc-header-shield-gold-v2.webp').'"'
        ));
        $response->assertSee('footer-shield-frame', false);
        $response->assertDontSee('navbar-brand-name', false);
        $this->assertFileExists(public_path('images/acpc-header-shield-gold-v1.webp'));
        $this->assertFileExists(public_path('images/acpc-header-shield-gold-v2.webp'));
    }
}
