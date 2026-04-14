<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Http\Requests\Admin\StoreCarRequest;
use App\Http\Requests\Admin\UpdateCarRequest;

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

    public function store(StoreCarRequest $request)
    {
        //
    }

    public function show(Car $car)
    {
        return redirect()->route('admin.cars.edit', $car);
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    public function destroy(Car $car)
    {
        //
    }
}