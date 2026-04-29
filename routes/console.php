<?php

use App\Models\Car;
use App\Models\CarImage;
use App\Services\CarImageVariantService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('cars:generate-image-variants {--force : Regenerate variants that already exist}', function (CarImageVariantService $imageVariants) {
    $force = (bool) $this->option('force');
    $processed = 0;
    $generated = 0;
    $skipped = 0;
    $missing = 0;
    $errors = 0;
    $output = $this;

    $processPath = function (?string $path, string $label) use ($imageVariants, $force, $output, &$processed, &$generated, &$skipped, &$missing, &$errors): void {
        if (! $path) {
            return;
        }

        if (! $imageVariants->originalExists($path)) {
            $missing++;
            $output->warn("Missing original for {$label}: {$path}");

            return;
        }

        try {
            $result = $imageVariants->generate($path, $force);
            $processed++;
            $generated += count($result['generated'] ?? []);
            $skipped += count($result['skipped'] ?? []);
            $output->line("Processed {$label}: {$path}");
        } catch (\Throwable $exception) {
            $errors++;
            report($exception);
            $output->error("Failed {$label}: {$path} ({$exception->getMessage()})");
        }
    };

    Car::query()
        ->whereNotNull('featured_image')
        ->orderBy('id')
        ->chunkById(100, function ($cars) use ($processPath): void {
            foreach ($cars as $car) {
                $processPath($car->featured_image, "featured image for car #{$car->id}");
            }
        });

    CarImage::query()
        ->orderBy('id')
        ->chunkById(100, function ($images) use ($processPath): void {
            foreach ($images as $image) {
                $processPath($image->image_path, "gallery image #{$image->id}");
            }
        });

    $this->info("Done. Originals processed: {$processed}. Variants generated: {$generated}. Existing variants skipped: {$skipped}. Missing originals: {$missing}. Errors: {$errors}.");
})->purpose('Generate medium and thumbnail variants for car images');
