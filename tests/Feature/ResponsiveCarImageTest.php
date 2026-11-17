<?php
namespace Tests\Feature;
use App\Services\CarImageVariantService;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
class ResponsiveCarImageTest extends TestCase
{
    private function image(string $path, int $width): void
    {
        $im = imagecreatetruecolor($width, 200);
        ob_start(); imagejpeg($im); $bytes = ob_get_clean(); imagedestroy($im);
        Storage::disk('public')->put($path, $bytes);
    }
    public function test_uses_actual_variant_widths_without_generating_missing_files(): void
    {
        Storage::fake('public');
        $service = app(CarImageVariantService::class);
        $this->image('cars/thumb/test.jpg', 480);
        $this->image('cars/medium/test.jpg', 1200);
        $srcset = $service->srcset('cars/test.jpg');
        $this->assertStringContainsString('cars/thumb/test.jpg 480w', $srcset);
        $this->assertStringContainsString('cars/medium/test.jpg 1200w', $srcset);
        $this->assertSame('', $service->srcset('cars/missing.jpg'));
        $this->assertCount(2, Storage::disk('public')->allFiles());
    }
    public function test_small_duplicate_widths_and_invalid_variants_do_not_lie_to_browser(): void
    {
        Storage::fake('public');
        $service = app(CarImageVariantService::class);
        $this->image('cars/thumb/small.jpg', 200);
        $this->image('cars/medium/small.jpg', 200);
        $this->assertSame(Storage::url('cars/medium/small.jpg').' 200w', $service->srcset('cars/small.jpg'));
        Storage::disk('public')->put('cars/medium/corrupt.jpg', 'not an image');
        $this->assertSame('', $service->srcset('cars/corrupt.jpg'));
        config(['filesystems.disks.public.driver' => 's3']);
        $this->assertSame('', $service->srcset('cars/small.jpg'));
    }
    public function test_additive_generation_preserves_original_and_existing_variants(): void
    {
        Storage::fake('public');
        $service = app(CarImageVariantService::class);
        $this->image('cars/source.jpg', 1600);
        $this->image('cars/medium/source.jpg', 1200);
        $before = Storage::disk('public')->get('cars/medium/source.jpg');
        $original = Storage::disk('public')->get('cars/source.jpg');
        $service->generate('cars/source.jpg');
        $this->assertSame($before, Storage::disk('public')->get('cars/medium/source.jpg'));
        $this->assertSame($original, Storage::disk('public')->get('cars/source.jpg'));
        foreach (['card' => 800, 'strip' => 240, 'thumb' => 480] as $variant => $width) {
            $this->assertSame($width, getimagesize(Storage::disk('public')->path("cars/{$variant}/source.jpg"))[0]);
        }
        $this->assertStringContainsString('800w', $service->srcset('cars/source.jpg'));
        $this->assertStringContainsString('240w', $service->srcset('cars/source.jpg', ['strip', 'thumb']));
    }
    public function test_detail_template_keeps_priority_and_has_targeted_light_contrast(): void
    {
        Storage::fake('public');
        $this->image('cars/medium/test.jpg', 1200);
        $this->image('cars/strip/test.jpg', 240);
        $car = new \App\Models\Car(['title' => 'Synthetic QA car', 'slug' => 'synthetic-qa', 'year' => 2020, 'price' => 10000, 'mileage' => 20000, 'featured_image' => 'cars/test.jpg']);
        $car->id = 1;
        $car->setRelation('images', collect([new \App\Models\CarImage(['image_path' => 'cars/other.jpg'])]));
        $html = view('public.cars.show', ['car' => $car, 'errors' => new \Illuminate\Support\ViewErrorBag])->render();
        $this->assertStringContainsString('1200w', $html);
        $this->assertStringContainsString('240w', $html);
        $this->assertStringContainsString('fetchpriority="high"', $html);
        $this->assertStringContainsString('color: #876a2c;', $html);
        $this->assertStringContainsString('.show-back .btn-brand-outline:hover,', $html);
    }
    public function test_srcset_urls_use_the_public_disk_not_the_default_disk(): void
    {
        Storage::fake('public', ['url' => 'https://images.example.test/public']);
        $this->image('cars/thumb/custom.jpg', 480);
        $this->assertSame('https://images.example.test/public/cars/thumb/custom.jpg 480w', app(CarImageVariantService::class)->srcset('cars/custom.jpg'));
    }
}
