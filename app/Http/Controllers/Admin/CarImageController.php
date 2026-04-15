<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarImage;
use Illuminate\Support\Facades\Storage;

class CarImageController extends Controller
{
    public function destroy(int $id)
    {
        $carImage = CarImage::query()->findOrFail($id);
        $car = $carImage->car;

        if ($carImage->image_path) {
            Storage::disk('public')->delete($carImage->image_path);
        }

        $carImage->delete();

        return redirect()
            ->route('admin.cars.edit', $car)
            ->with('success', 'Gallery image deleted successfully.');
    }
}
