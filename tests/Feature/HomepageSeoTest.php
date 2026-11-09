<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageSeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_has_one_visible_primary_heading_in_both_languages(): void
    {
        config(['seo.enforce_canonical_url' => false]);

        foreach (['en', 'es'] as $locale) {
            $response = $this->withSession(['locale' => $locale])->get('/');
            $response->assertOk();

            $document = new \DOMDocument;
            @$document->loadHTML($response->getContent());
            $headings = $document->getElementsByTagName('h1');

            $this->assertSame(1, $headings->length);
            $this->assertSame(__('public.home.current_stock', [], $locale), trim($headings->item(0)->textContent));
            $this->assertStringContainsString('home-featured-heading', $headings->item(0)->getAttribute('class'));
        }
    }
}
