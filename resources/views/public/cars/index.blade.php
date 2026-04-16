@extends('layouts.public')

@section('title', 'Cars - ACPC Autos')

@section('content')
    <style>
        .page-cars-index .index-hero {
            background: linear-gradient(128deg, #ffffff 0%, #fbf8f1 60%, #f3ebdc 100%);
            border: 1px solid rgba(47, 94, 58, 0.17);
            box-shadow: 0 10px 26px rgba(19, 31, 24, 0.09);
        }

        .page-cars-index .empty-state-card {
            background: linear-gradient(145deg, #ffffff 0%, #f6f2e8 100%);
            border: 1px solid rgba(185, 145, 70, 0.25);
        }

        @media (prefers-color-scheme: dark) {
            .page-cars-index .index-hero {
                background: linear-gradient(128deg, rgba(36, 46, 52, 0.96) 0%, rgba(26, 33, 39, 0.98) 100%);
                border-color: rgba(201, 164, 92, 0.24);
                box-shadow: 0 10px 26px rgba(0, 0, 0, 0.24);
            }

            .page-cars-index .empty-state-card {
                background: linear-gradient(145deg, rgba(34, 42, 48, 0.98) 0%, rgba(26, 32, 37, 0.98) 100%);
                border-color: rgba(201, 164, 92, 0.24);
            }
        }
    </style>

    <div class="page-cars-index">
    <section class="mb-4">
        <div class="brand-card index-hero rounded-4 p-4 p-md-5">
            <h1 class="h2 mb-2">Current Stock</h1>
            <p class="brand-muted mb-0">A small premium collection of available vehicles. No clutter, just the best cars in stock right now.</p>
        </div>
    </section>

    <section>
        <div class="row g-4">
            @forelse ($cars as $car)
                <div class="col-md-6 col-lg-4">
                    @php
                        $imagePaths = collect();
                        if ($car->featured_image) {
                            $imagePaths->push($car->featured_image);
                        }
                        foreach ($car->images as $image) {
                            $imagePaths->push($image->image_path);
                        }
                        $carouselId = 'indexCarCarousel' . $car->id;
                    @endphp
                    <div class="card brand-card h-100 shadow-sm rounded-4 overflow-hidden">
                        @if ($imagePaths->isNotEmpty())
                            <div id="{{ $carouselId }}" class="carousel slide">
                                <div class="carousel-inner">
                                    @foreach ($imagePaths as $imagePath)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <img
                                                src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                                class="d-block w-100 stock-image"
                                                alt="{{ $car->title }}"
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
                            <div class="d-flex align-items-center justify-content-center brand-muted stock-image">
                                <span>No image</span>
                            </div>
                        @endif
                        <div class="card-body p-4">
                            <h2 class="h5 card-title mb-1">{{ $car->title }}</h2>
                            <p class="mb-2 brand-muted small">{{ $car->make }} {{ $car->model }} ({{ $car->year }})</p>
                            @include('public.cars.partials.card-summary', ['car' => $car])
                            <p class="price-highlight">€{{ number_format($car->price) }}</p>
                            <a href="{{ route('cars.show', $car->slug) }}" class="btn btn-brand-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert mb-0 brand-card empty-state-card border-0">No available cars found.</div>
                </div>
            @endforelse
        </div>
    </section>

    <div class="mt-4 d-flex justify-content-center">
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>
    </div>
@endsection
