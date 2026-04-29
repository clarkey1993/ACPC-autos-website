<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCarRequest;
use App\Http\Requests\Admin\UpdateCarRequest;
use App\Models\Car;
use App\Services\CarImageVariantService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(15);

        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(StoreCarRequest $request, CarImageVariantService $imageVariants)
    {
        $data = $request->validated();
        $featuredImageFile = $request->file('featured_image');
        $galleryImageFiles = $request->file('gallery_images', []);

        unset($data['featured_image'], $data['gallery_images']);
        $data['slug'] = $this->generateUniqueSlug($data['title']);
        $data['featured_image'] = $featuredImageFile
            ? $featuredImageFile->store('cars/featured', 'public')
            : null;
        if ($data['featured_image']) {
            $imageVariants->generateQuietly($data['featured_image']);
        }

        $car = Car::create($data);

        foreach ($galleryImageFiles as $galleryImageFile) {
            $galleryImagePath = $galleryImageFile->store('cars/gallery', 'public');
            $imageVariants->generateQuietly($galleryImagePath);

            $car->images()->create([
                'image_path' => $galleryImagePath,
            ]);
        }

        return redirect()
            ->route('admin.cars.index')
            ->with('success', 'Car created successfully.');
    }

    public function show(Car $car)
    {
        return redirect()->route('admin.cars.edit', $car);
    }

    public function edit(Car $car)
    {
        $car->load('images');

        return view('admin.cars.edit', compact('car'));
    }

    public function update(UpdateCarRequest $request, Car $car, CarImageVariantService $imageVariants)
    {
        $data = $request->validated();
        $featuredImageFile = $request->file('featured_image');
        $galleryImageFiles = $request->file('gallery_images', []);

        unset($data['featured_image'], $data['gallery_images']);

        if ($car->title !== $data['title']) {
            $data['slug'] = $this->generateUniqueSlug($data['title'], $car->id);
        }

        if ($featuredImageFile) {
            if ($car->featured_image) {
                $imageVariants->deleteVariants($car->featured_image);
                Storage::disk('public')->delete($car->featured_image);
            }

            $data['featured_image'] = $featuredImageFile->store('cars/featured', 'public');
            $imageVariants->generateQuietly($data['featured_image']);
        }

        $car->update($data);

        foreach ($galleryImageFiles as $galleryImageFile) {
            $galleryImagePath = $galleryImageFile->store('cars/gallery', 'public');
            $imageVariants->generateQuietly($galleryImagePath);

            $car->images()->create([
                'image_path' => $galleryImagePath,
            ]);
        }

        return redirect()
            ->route('admin.cars.index')
            ->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car, CarImageVariantService $imageVariants)
    {
        if ($car->featured_image) {
            $imageVariants->deleteVariants($car->featured_image);
            Storage::disk('public')->delete($car->featured_image);
        }

        foreach ($car->images as $image) {
            $imageVariants->deleteVariants($image->image_path);
            Storage::disk('public')->delete($image->image_path);
        }

        $car->delete();

        return redirect()
            ->route('admin.cars.index')
            ->with('success', 'Car deleted successfully.');
    }

    private function generateUniqueSlug(string $title, ?int $ignoreCarId = null): string
    {
        $baseSlug = Str::slug($title);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'car';
        $slug = $baseSlug;
        $counter = 1;

        while (
            Car::query()
                ->when($ignoreCarId, fn ($query) => $query->where('id', '!=', $ignoreCarId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}