@extends('layouts.public')

@section('title', 'Home - ACPC Autos')

@section('content')
    <div class="brand-card rounded-4 p-4 p-md-5 mb-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Premium Dealership</p>
                <h1 class="display-5 fw-semibold mb-3">Find Your Next Luxury Drive</h1>
                <p class="lead brand-muted mb-4">Modern, premium quality vehicles selected for comfort, style, and confidence on every journey.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('cars.index') }}" class="btn btn-brand-primary btn-lg">Browse Cars</a>
                    <a href="{{ route('cars.index') }}" class="btn btn-brand-outline btn-lg">View Latest Stock</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="brand-card rounded-3 p-3">
                    <p class="small text-brand-gold mb-2">Why ACPC Autos</p>
                    <ul class="mb-0 ps-3 brand-muted">
                        <li class="mb-2">Carefully selected premium vehicles</li>
                        <li class="mb-2">Transparent car details and history</li>
                        <li>Professional and friendly service</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0">Latest Available Cars</h2>
        <a href="{{ route('cars.index') }}" class="btn btn-brand-outline btn-sm">View All</a>
    </div>

    <div class="row g-4">
        @forelse ($latestCars as $car)
            <div class="col-md-4">
                @php
                    $imagePaths = collect();
                    if ($car->featured_image) {
                        $imagePaths->push($car->featured_image);
                    }
                    foreach ($car->images as $image) {
                        $imagePaths->push($image->image_path);
                    }
                    $carouselId = 'homeCarCarousel' . $car->id;
                @endphp
                <div class="card brand-card h-100 shadow-sm rounded-4 overflow-hidden">
                    @if ($imagePaths->isNotEmpty())
                        <div id="{{ $carouselId }}" class="carousel slide">
                            <div class="carousel-inner">
                                @foreach ($imagePaths as $imagePath)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                            class="d-block w-100"
                                            alt="{{ $car->title }}"
                                            style="height: 220px; object-fit: cover;"
                                        >
                                    </div>
                                @endforeach
                            </div>

                            @if ($imagePaths->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center brand-muted" style="height: 220px;">
                            No image
                        </div>
                    @endif
                    <div class="card-body">
                        <h3 class="h5 card-title mb-1">{{ $car->title }}</h3>
                        <p class="mb-2 brand-muted">{{ $car->make }} {{ $car->model }} ({{ $car->year }})</p>
                        <p class="fw-semibold text-brand-gold mb-3">€{{ number_format($car->price) }}</p>
                        <a href="{{ route('cars.show', $car->slug) }}" class="btn btn-brand-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert mb-0 brand-card border-0">No cars available right now. Please check back soon.</div>
            </div>
        @endforelse
    </div>
@endsection
