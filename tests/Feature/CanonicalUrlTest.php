<?php

namespace Tests\Feature;

use Tests\TestCase;

class CanonicalUrlTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'seo.canonical_url' => 'https://acpcautos.com',
            'seo.enforce_canonical_url' => true,
        ]);
    }

    public function test_secondary_domain_redirects_to_canonical_domain(): void
    {
        $response = $this->get('https://acpc.autos/cookie-policy?source=test');

        $response->assertStatus(301);
        $response->assertRedirect('https://acpcautos.com/cookie-policy?source=test');
    }

    public function test_www_primary_domain_redirects_to_canonical_domain(): void
    {
        $response = $this->get('https://www.acpcautos.com/about-us');

        $response->assertStatus(301);
        $response->assertRedirect('https://acpcautos.com/about-us');
    }

    public function test_http_redirects_to_https(): void
    {
        $response = $this->get('http://acpcautos.com/faq');

        $response->assertStatus(301);
        $response->assertRedirect('https://acpcautos.com/faq');
    }

    public function test_canonical_request_is_not_redirected(): void
    {
        $this->get('https://acpcautos.com/cookie-policy')
            ->assertOk();
    }

    public function test_non_get_requests_preserve_the_http_method(): void
    {
        $response = $this->post('https://acpc.autos/contact-us', [
            'name' => 'Local test',
        ]);

        $response->assertStatus(308);
        $response->assertRedirect('https://acpcautos.com/contact-us');
    }
}
