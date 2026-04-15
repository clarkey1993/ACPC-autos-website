@extends('layouts.public')

@section('title', $car->title . ' - ACPC Autos')

@section('content')
    <div class="mb-4">
        <a href="{{ route('cars.index') }}" class="btn btn-brand-outline btn-sm">Back to Cars</a>
    </div>

    <div class="card brand-card shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body">
            <h1 class="h2 mb-3">{{ $car->title }}</h1>

            @if ($car->featured_image)
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($car->featured_image) }}"
                    alt="{{ $car->title }}"
                    class="img-fluid rounded border mb-3"
                    style="width: 100%; max-height: 520px; object-fit: cover; border-color: rgba(201, 164, 92, 0.35) !important;"
                >
            @else
                <div class="d-flex align-items-center justify-content-center rounded border mb-3 brand-muted" style="height: 340px; border-color: rgba(201, 164, 92, 0.35) !important;">
                    <span>No featured image</span>
                </div>
            @endif

            @if ($car->images->isNotEmpty())
                <h2 class="h5 mb-3">Gallery</h2>
                <div class="row g-3 mb-4">
                    @foreach ($car->images as $image)
                        <div class="col-6 col-md-3">
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}"
                                alt="{{ $car->title }} gallery image"
                                class="img-thumbnail w-100"
                                style="height: 130px; object-fit: cover; background-color: #141b1f; border-color: rgba(201, 164, 92, 0.35);"
                            >
                        </div>
                    @endforeach
                </div>
            @endif

            <h2 class="h5 mb-3">Car Details</h2>
            <div class="row">
                <div class="col-md-6">
                    <p class="brand-muted"><strong class="text-light">Make:</strong> {{ $car->make }}</p>
                    <p class="brand-muted"><strong class="text-light">Model:</strong> {{ $car->model }}</p>
                    <p class="brand-muted"><strong class="text-light">Year:</strong> {{ $car->year }}</p>
                    <p class="text-brand-gold fw-semibold"><strong class="text-brand-gold">Price:</strong> €{{ number_format($car->price) }}</p>
                </div>
                <div class="col-md-6">
                    <p class="brand-muted"><strong class="text-light">Mileage:</strong> {{ $car->mileage ? number_format($car->mileage) . ' km' : 'N/A' }}</p>
                    <p class="brand-muted"><strong class="text-light">Fuel Type:</strong> {{ $car->fuel_type ?: 'N/A' }}</p>
                    <p class="brand-muted"><strong class="text-light">Transmission:</strong> {{ $car->transmission ?: 'N/A' }}</p>
                    <p class="brand-muted"><strong class="text-light">Colour:</strong> {{ $car->colour ?: 'N/A' }}</p>
                    <p class="brand-muted"><strong class="text-light">Status:</strong> <span class="badge badge-brand">{{ ucfirst($car->status) }}</span></p>
                </div>
            </div>

            <h2 class="h5 mb-2">Description</h2>
            <p class="mb-0 brand-muted">{{ $car->description ?: 'No description provided.' }}</p>
        </div>
    </div>
@endsection
