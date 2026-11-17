<?php
namespace Tests\Feature;
use Tests\TestCase;
class PublicLogoPerformanceTest extends TestCase
{
    public function test_responsive_logo_files_keep_ratio_and_reduce_bytes(): void
    {
        foreach (['green-v3', 'gold-v1'] as $color) {
            $original = public_path("images/acpc-header-shield-{$color}.webp");
            foreach ([600, 1200, 1800] as $width) {
                $path = public_path("images/acpc-header-shield-{$color}-{$width}w.webp");
                $size = getimagesize($path);
                $this->assertSame($width, $size[0]);
                $this->assertSame(intdiv($width, 3), $size[1]);
                $this->assertLessThan(filesize($original) * 0.3, filesize($path));
            }
        }
    }
    public function test_public_layout_declares_responsive_sources_without_lazy_header(): void
    {
        config(['seo.enforce_canonical_url' => false]);
        $response = $this->get('/cookie-policy')->assertOk();
        $doc = new \DOMDocument;
        @$doc->loadHTML($response->getContent());
        $count = 0;
        foreach ($doc->getElementsByTagName('img') as $img) {
            if (!str_contains($img->getAttribute('src'), 'acpc-header-shield-')) continue;
            ++$count;
            foreach ([600, 1200, 1800] as $width) $this->assertStringContainsString("{$width}w.webp", $img->getAttribute('srcset'));
            $this->assertNotEmpty($img->getAttribute('sizes'));
            $this->assertSame('2172', $img->getAttribute('width'));
            $this->assertSame('724', $img->getAttribute('height'));
            if (str_contains($img->getAttribute('class'), 'navbar')) {
                $this->assertSame('high', $img->getAttribute('fetchpriority'));
                $this->assertNotSame('lazy', $img->getAttribute('loading'));
            }
            if (str_contains($img->getAttribute('class'), 'footer')) $this->assertSame('lazy', $img->getAttribute('loading'));
        }
        $this->assertSame(3, $count);
    }
}
