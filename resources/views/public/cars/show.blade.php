@extends('layouts.public')

@section('title', $car->title . ' - ACPC Autos')

@section('content')
    <div class="mb-3">
        <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary btn-sm">Back to Cars</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h1 class="h3 mb-3">{{ $car->title }}</h1>

            @if ($car->featured_image)
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($car->featured_image) }}"
                    alt="{{ $car->title }}"
                    class="img-fluid rounded border mb-3"
                    style="width: 100%; max-height: 480px; object-fit: cover;"
                >
            @else
                <div class="bg-secondary-subtle d-flex align-items-center justify-content-center rounded border mb-3" style="height: 320px;">
                    <span class="text-muted">No featured image</span>
                </div>
            @endif

            @if ($car->images->isNotEmpty())
                <h2 class="h5 mb-3">Gallery</h2>
                <div class="row g-2 mb-4">
                    @foreach ($car->images as $image)
                        <div class="col-6 col-md-3">
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}"
                                alt="{{ $car->title }} gallery image"
                                class="img-thumbnail w-100"
                                style="height: 120px; object-fit: cover;"
                            >
                        </div>
                    @endforeach
                </div>
            @endif

            <h2 class="h5 mb-3">Car Details</h2>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Make:</strong> {{ $car->make }}</p>
                    <p><strong>Model:</strong> {{ $car->model }}</p>
                    <p><strong>Year:</strong> {{ $car->year }}</p>
                    <p><strong>Price:</strong> €{{ number_format($car->price) }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Mileage:</strong> {{ $car->mileage ? number_format($car->mileage) . ' km' : 'N/A' }}</p>
                    <p><strong>Fuel Type:</strong> {{ $car->fuel_type ?: 'N/A' }}</p>
                    <p><strong>Transmission:</strong> {{ $car->transmission ?: 'N/A' }}</p>
                    <p><strong>Colour:</strong> {{ $car->colour ?: 'N/A' }}</p>
                    <p><strong>Status:</strong> <span class="badge text-bg-success">{{ ucfirst($car->status) }}</span></p>
                </div>
            </div>

            <h2 class="h5 mb-2">Description</h2>
            <p class="mb-0">{{ $car->description ?: 'No description provided.' }}</p>
        </div>
    </div>
@endsection
