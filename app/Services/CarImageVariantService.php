<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Throwable;

class CarImageVariantService
{
    private const DISK = 'public';

    private const VARIANTS = [
        'medium' => 1200,
        'thumb' => 480,
    ];

    private const SUPPORTED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];

    public function generate(string $originalPath, bool $force = false): array
    {
        $disk = $this->disk();

        if (! $disk->exists($originalPath)) {
            return ['missing' => true, 'generated' => [], 'skipped' => []];
        }

        $extension = strtolower(pathinfo($originalPath, PATHINFO_EXTENSION));
        if (! in_array($extension, self::SUPPORTED_EXTENSIONS, true)) {
            return ['unsupported' => true, 'generated' => [], 'skipped' => []];
        }

        $originalContents = $disk->get($originalPath);
        $manager = ImageManager::gd();
        $generated = [];
        $skipped = [];

        foreach (self::VARIANTS as $variant => $maxWidth) {
            $variantPath = $this->variantPath($originalPath, $variant);

            if (! $force && $disk->exists($variantPath)) {
                $skipped[] = $variantPath;
                continue;
            }

            $encoded = $manager
                ->read($originalContents)
                ->scaleDown(width: $maxWidth)
                ->encodeByExtension($extension);

            $disk->put($variantPath, (string) $encoded, ['visibility' => 'public']);
            $generated[] = $variantPath;
        }

        return ['generated' => $generated, 'skipped' => $skipped];
    }

    public function generateQuietly(string $originalPath, bool $force = false): void
    {
        try {
            $this->generate($originalPath, $force);
        } catch (Throwable $exception) {
            Log::warning('Failed to generate car image variants.', [
                'path' => $originalPath,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function url(string $originalPath, string $variant): string
    {
        return Storage::url($this->pathForDisplay($originalPath, $variant));
    }

    public function pathForDisplay(string $originalPath, string $variant): string
    {
        $variantPath = $this->variantPath($originalPath, $variant);

        return $this->disk()->exists($variantPath) ? $variantPath : $originalPath;
    }

    public function variantPath(string $originalPath, string $variant): string
    {
        $directory = pathinfo($originalPath, PATHINFO_DIRNAME);
        $filename = pathinfo($originalPath, PATHINFO_BASENAME);

        return trim($directory, './') . '/' . $variant . '/' . $filename;
    }

    public function deleteVariants(string $originalPath): void
    {
        foreach (array_keys(self::VARIANTS) as $variant) {
            $this->disk()->delete($this->variantPath($originalPath, $variant));
        }
    }

    public function originalExists(string $originalPath): bool
    {
        return $this->disk()->exists($originalPath);
    }

    private function disk(): Filesystem
    {
        return Storage::disk(self::DISK);
    }
}
