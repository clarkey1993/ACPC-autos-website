@extends('layouts.public')

@section('title', 'Home - ACPC Autos')

@section('content')
    <div class="hero-shell rounded-4 p-4 p-md-5 mb-5 shadow-sm">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Premium Dealer Stock</p>
                <h1 class="display-4 fw-semibold mb-3">Exceptional Cars, Ready for Immediate Delivery</h1>
                <p class="lead brand-muted mb-4">We keep a carefully selected stock of quality vehicles so you can browse confidently and buy with peace of mind.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('cars.index') }}" class="btn btn-brand-primary btn-lg">Browse Stock</a>
                    <a href="{{ route('cars.index') }}" class="btn btn-brand-outline btn-lg">View Latest Cars</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="brand-card rounded-3 p-3 p-md-4">
                    <p class="small text-brand-gold mb-2">Stock Snapshot</p>
                    <p class="mb-2">Small curated range. Strong quality control.</p>
                    <p class="mb-2">Personal support from viewing to handover.</p>
                    <p class="mb-0 brand-muted">Contact us directly for availability and appointment slots.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="mb-5">
        <div class="brand-card rounded-4 p-4 p-md-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h2 class="h2 section-title mb-2">Browse Stock</h2>
                    <p class="brand-muted mb-0">No overwhelming search tools - just a clean premium list of the cars currently available.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('cars.index') }}" class="btn btn-brand-primary">Go to Stock List</a>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <h2 class="h3 section-title mb-4">Why Buy From Us</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="brand-card rounded-4 p-4 h-100">
                    <h3 class="h5 text-brand-gold">Carefully Selected Cars</h3>
                    <p class="mb-0 brand-muted">Every vehicle in stock is chosen for quality, presentation, and value.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="brand-card rounded-4 p-4 h-100">
                    <h3 class="h5 text-brand-gold">Clear, Honest Details</h3>
                    <p class="mb-0 brand-muted">Simple listing information and transparent communication from our team.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="brand-card rounded-4 p-4 h-100">
                    <h3 class="h5 text-brand-gold">Personal Service</h3>
                    <p class="mb-0 brand-muted">A focused dealership experience with direct support from enquiry to purchase.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 section-title mb-0">Featured Latest Cars</h2>
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
                                No image
                            </div>
                        @endif
                        <div class="card-body p-4">
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
    </section>

    <section class="mb-2">
        <div class="brand-card rounded-4 p-4 p-md-5 text-center">
            <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Ready to Buy?</p>
            <h2 class="h2 mb-3">Speak to Our Team About Current Availability</h2>
            <p class="brand-muted mb-4">Get in touch for walkaround details, pricing confirmation, and booking a viewing.</p>
            <a href="{{ route('cars.index') }}" class="btn btn-brand-primary btn-lg">Enquire on Stock</a>
        </div>
    </section>
@endsection
