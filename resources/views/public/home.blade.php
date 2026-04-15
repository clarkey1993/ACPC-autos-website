@extends('layouts.public')

@section('title', 'Home - ACPC Autos')

@section('content')
    <div class="page-home">
        <style>
            .page-home {
                --home-surface: linear-gradient(168deg, rgba(38, 48, 54, 0.95) 0%, rgba(30, 38, 44, 0.98) 55%, rgba(26, 32, 37, 0.99) 100%);
                --home-hero: linear-gradient(118deg, rgba(47, 94, 58, 0.42) 0%, rgba(30, 51, 39, 0.88) 42%, rgba(22, 30, 36, 0.94) 100%);
                --home-accent-line: linear-gradient(90deg, transparent, rgba(201, 164, 92, 0.55), rgba(47, 94, 58, 0.45), transparent);
            }

            .page-home .home-hero {
                background: var(--home-hero);
                border: 1px solid rgba(224, 201, 138, 0.32);
                box-shadow: 0 12px 40px rgba(0, 0, 0, 0.28);
            }

            .page-home .home-panel,
            .page-home .card.brand-card {
                background: var(--home-surface);
                border: 1px solid rgba(201, 164, 92, 0.26);
                color: #f5f1e8;
                box-shadow: 0 6px 22px rgba(0, 0, 0, 0.18);
            }

            .page-home .home-muted {
                color: #d8d0c4 !important;
            }

            .page-home .home-section-title {
                letter-spacing: 0.03em;
            }

            .page-home .home-title-accent {
                height: 3px;
                width: 56px;
                border-radius: 2px;
                background: var(--home-accent-line);
                margin-bottom: 0.75rem;
            }

            .page-home .home-featured-card .stock-image {
                height: 200px;
                object-fit: cover;
            }

            .page-home .home-hero .display-5 {
                line-height: 1.15;
            }
        </style>

        <section class="home-hero rounded-4 p-3 p-md-4 mb-4 shadow-sm">
            <div class="row align-items-center g-3 g-md-4">
                <div class="col-lg-7">
                    <p class="text-uppercase small text-brand-gold fw-semibold mb-2 mb-md-1">Premium dealer stock</p>
                    <h1 class="display-5 fw-semibold mb-2 mb-md-3">Exceptional cars, ready when you are</h1>
                    <p class="fs-6 home-muted mb-3 mb-md-3">A small, curated list of quality vehicles — browse with confidence and speak directly with our team.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#featured-cars" class="btn btn-brand-primary">View featured</a>
                        <a href="{{ route('cars.index') }}" class="btn btn-brand-outline">Full stock list</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="home-panel rounded-3 p-3 p-md-4">
                        <p class="small text-brand-gold fw-semibold mb-2">Why our stock stands out</p>
                        <p class="mb-2 small home-muted">Hand-picked vehicles with presentation and history in mind.</p>
                        <p class="mb-2 small home-muted">Straightforward details — no clutter, no endless filters.</p>
                        <p class="mb-0 small home-muted">Personal support from first look to handover.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="featured-cars" class="mb-4 mb-md-5">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-3">
                <div>
                    <div class="home-title-accent"></div>
                    <h2 class="h2 home-section-title text-brand-gold mb-0">Featured cars</h2>
                    <p class="home-muted small mb-0 mt-2">Current highlights from our showroom — tap a card for full details.</p>
                </div>
                <a href="{{ route('cars.index') }}" class="btn btn-brand-outline btn-sm align-self-center">Browse all stock</a>
            </div>

            <div class="row g-3 g-md-4">
                @forelse ($latestCars as $car)
                    <div class="col-12 col-sm-6 col-xl-4">
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
                        <div class="card brand-card home-featured-card h-100 rounded-4 overflow-hidden border-0">
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
                                <div class="d-flex align-items-center justify-content-center home-muted stock-image bg-dark bg-opacity-25">
                                    No image
                                </div>
                            @endif
                            <div class="card-body p-3 p-md-4 d-flex flex-column">
                                <h3 class="h5 card-title mb-1">{{ $car->title }}</h3>
                                <p class="small home-muted mb-2">{{ $car->make }} {{ $car->model }} · {{ $car->year }}</p>
                                <p class="fw-semibold text-brand-gold fs-5 mb-3">€{{ number_format($car->price) }}</p>
                                <a href="{{ route('cars.show', $car->slug) }}" class="btn btn-brand-primary btn-sm mt-auto">View details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="home-panel rounded-4 p-4 text-center home-muted">No cars available right now. Please check back soon.</div>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="mb-4 mb-md-5">
            <div class="home-panel rounded-4 p-3 p-md-4">
                <div class="row align-items-center g-3">
                    <div class="col-lg-8">
                        <div class="home-title-accent"></div>
                        <h2 class="h4 home-section-title mb-2">Browse stock</h2>
                        <p class="home-muted small mb-0">See every available vehicle in one clean list — built for a small premium inventory, not endless scrolling.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('cars.index') }}" class="btn btn-brand-primary">Go to stock list</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-4 mb-md-5">
            <div class="home-title-accent"></div>
            <h2 class="h4 home-section-title text-brand-gold mb-3">Why buy from us</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="home-panel rounded-4 p-4 h-100">
                        <h3 class="h6 text-brand-gold text-uppercase small fw-semibold mb-2">Selection</h3>
                        <p class="mb-0 small home-muted">Vehicles chosen for quality, condition, and long-term value.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-panel rounded-4 p-4 h-100">
                        <h3 class="h6 text-brand-gold text-uppercase small fw-semibold mb-2">Clarity</h3>
                        <p class="mb-0 small home-muted">Clear information and honest answers — no pressure tactics.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-panel rounded-4 p-4 h-100">
                        <h3 class="h6 text-brand-gold text-uppercase small fw-semibold mb-2">Service</h3>
                        <p class="mb-0 small home-muted">Direct contact with people who know every car on the floor.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-2">
            <div class="home-panel rounded-4 p-4 p-md-5 text-center">
                <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Ready to move forward?</p>
                <h2 class="h3 mb-2">Speak to us about availability</h2>
                <p class="home-muted small mb-4 mb-md-3">Viewings, pricing, and next steps — we respond promptly to serious enquiries.</p>
                <a href="{{ route('cars.index') }}" class="btn btn-brand-primary btn-lg">Enquire on stock</a>
            </div>
        </section>
    </div>
@endsection
