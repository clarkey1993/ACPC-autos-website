<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarImage;
use App\Services\CarImageVariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarImageController extends Controller
{
    public function destroy(int $id, CarImageVariantService $imageVariants)
    {
        $carImage = CarImage::query()->findOrFail($id);
        $car = $carImage->car;

        if ($carImage->image_path) {
            $imageVariants->deleteVariants($carImage->image_path);
            Storage::disk('public')->delete($carImage->image_path);
        }

        $carImage->delete();

        return redirect()
            ->route('admin.cars.edit', $car)
            ->with('success', 'Gallery image deleted successfully.');
    }

    public function reorder(Request $request, Car $car)
    {
        $data = $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:car_images,id',
        ]);

        $order = $data['order'];

        DB::transaction(function () use ($order, $car) {
            foreach ($order as $index => $imageId) {
                CarImage::query()
                    ->where('id', $imageId)
                    ->where('car_id', $car->id)
                    ->update(['sort_order' => $index]);
            }
        });

        return redirect()
            ->route('admin.cars.edit', $car)
            ->with('success', 'Gallery order updated.');
    }
}
