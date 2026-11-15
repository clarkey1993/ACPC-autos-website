<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicAccessibilityTest extends TestCase
{
    public function test_cards_use_native_named_links_and_sequential_headings(): void
    {
        Storage::fake('public');
        $car = new Car(['title' => 'Citroen Berlingo', 'slug' => 'citroen-berlingo', 'year' => 2020, 'price' => 10000, 'mileage' => 20000, 'featured_image' => 'cars/example.jpg']);
        $car->id = 1;
        $car->setRelation('images', collect());

        $html = view('public.cars.partials.car-card', ['car' => $car, 'priorityImage' => true])->render();
        $document = new \DOMDocument;
        @$document->loadHTML($html);
        $article = $document->getElementsByTagName('article')->item(0);
        $this->assertFalse($article->hasAttribute('role'));
        $this->assertFalse($article->hasAttribute('tabindex'));
        $this->assertSame(1, $document->getElementsByTagName('h2')->length);
        $link = $document->getElementsByTagName('a')->item(0);
        $this->assertStringContainsString('Citroen Berlingo', $link->getAttribute('aria-label'));
        $this->assertSame(route('cars.show', $car->slug), $link->getAttribute('href'));
        $image = $document->getElementsByTagName('img')->item(0);
        $this->assertSame('eager', $image->getAttribute('loading'));
        $this->assertSame('high', $image->getAttribute('fetchpriority'));

        $html = view('public.cars.partials.car-card', ['car' => $car])->render();
        $this->assertStringContainsString('loading="lazy"', $html);
        $this->assertStringNotContainsString('fetchpriority="high"', $html);
    }
}
