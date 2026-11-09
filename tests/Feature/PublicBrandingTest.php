<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicBrandingTest extends TestCase
{
    public function test_header_logo_keeps_its_centering_on_hover_and_keyboard_focus(): void
    {
        config(['seo.enforce_canonical_url' => false]);

        $response = $this->get('/cookie-policy');

        $response->assertOk();
        $response->assertSee('.navbar-public .brand-logo-link:hover .brand-logo--navbar,', false);
        $response->assertSee('.navbar-public .brand-logo-link:focus-visible .brand-logo--navbar {', false);
        $this->assertMatchesRegularExpression(
            '/\.navbar-public \.brand-logo-link:hover \.brand-logo--navbar,\s*'
            .'\.navbar-public \.brand-logo-link:focus-visible \.brand-logo--navbar\s*\{\s*'
            .'transform: translateY\(-50%\) scaleY\(1\.2\);\s*\}/',
            $response->getContent()
        );
    }

    public function test_public_header_and_footer_use_shield_branding(): void
    {
        config(['seo.enforce_canonical_url' => false]);

        $response = $this->get('/cookie-policy');

        $response->assertOk();
        $this->assertSame(2, substr_count(
            $response->getContent(),
            'src="'.asset('images/acpc-header-shield-gold-v1.webp').'"'
        ));
        $this->assertSame(1, substr_count(
            $response->getContent(),
            'src="'.asset('images/acpc-header-shield-green-v3.webp').'"'
        ));
        $response->assertSee('footer-shield-frame', false);
        $response->assertSee('header-shield-frame', false);
        $response->assertDontSee('navbar-brand-name', false);
        $this->assertFileExists(public_path('images/acpc-header-shield-gold-v1.webp'));
        $this->assertFileExists(public_path('images/acpc-header-shield-green-v3.webp'));
    }
}
