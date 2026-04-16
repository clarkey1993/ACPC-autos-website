@extends('layouts.public')

@section('title', $car->title . ' - ACPC Autos')

@section('content')
    <style>
        .page-cars-show .spec-label {
            color: #24392c;
        }

        .page-cars-show .main-car-gallery__hero {
            transition: opacity 0.28s ease;
            cursor: pointer;
        }

        .page-cars-show .thumbnail-button {
            overflow: hidden;
            border-width: 2px !important;
            border-style: solid !important;
            border-color: rgba(47, 94, 58, 0.24) !important;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .page-cars-show .thumbnail-button:hover {
            transform: scale(1.04);
        }

        .page-cars-show .thumbnail-button.active {
            border-color: #d4af37 !important;
            box-shadow: 0 0 0 1px rgba(212, 175, 55, 0.45);
        }

        .page-cars-show .show-hero-price {
            font-size: clamp(1.75rem, 4vw, 2.35rem);
            font-weight: 700;
            color: var(--brand-gold);
            letter-spacing: 0.02em;
            line-height: 1.1;
            margin-bottom: 0.25rem;
        }

        .page-cars-show .show-key-panel {
            border: 1px solid rgba(47, 94, 58, 0.16);
            border-radius: 0.65rem;
            padding: 1rem 1.15rem;
            background: rgba(47, 94, 58, 0.045);
        }

        .page-cars-show .show-key-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--brand-muted-text);
            margin-bottom: 0.2rem;
        }

        .page-cars-show .show-key-value {
            font-weight: 600;
            color: var(--brand-text);
            font-size: 0.95rem;
        }

        .page-cars-show .show-cta-row {
            display: grid;
            gap: 0.5rem;
        }

        @media (min-width: 576px) {
            .page-cars-show .show-cta-row {
                display: flex;
                flex-wrap: wrap;
            }

            .page-cars-show .show-cta-row .btn {
                width: auto;
            }
        }

        .page-cars-show .show-cta-row .btn {
            min-height: 44px;
        }

        .page-cars-show .show-trust-list li {
            padding-left: 0;
        }

        .page-cars-show .show-enquiry-anchor {
            scroll-margin-top: 5.5rem;
        }

        .page-cars-show .show-trust-bullet {
            width: 0.35rem;
            height: 0.35rem;
            border-radius: 50%;
            background: var(--brand-gold);
            margin-top: 0.45rem;
            flex-shrink: 0;
            opacity: 0.85;
        }

        @media (prefers-color-scheme: dark) {
            .page-cars-show .spec-label {
                color: #f5f1e8;
            }

            .page-cars-show .thumbnail-button {
                border-color: rgba(224, 201, 138, 0.32) !important;
            }

            .page-cars-show .show-key-panel {
                border-color: rgba(224, 201, 138, 0.22);
                background: rgba(255, 255, 255, 0.04);
            }
        }
    </style>

    <div class="page-cars-show">
    @php
        $imagePaths = collect();
        if ($car->featured_image) {
            $imagePaths->push($car->featured_image);
        }
        foreach ($car->images as $image) {
            $imagePaths->push($image->image_path);
        }
        $mainImagePath = $imagePaths->first();
    @endphp

    <section class="mb-4">
        <a href="{{ route('cars.index') }}" class="btn btn-brand-outline btn-sm">Back to Cars</a>
    </section>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card brand-card shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h2 mb-3">{{ $car->title }}</h1>

                    <div class="show-key-panel mb-4">
                        <p class="show-hero-price mb-3">€{{ number_format($car->price) }}</p>
                        <div class="row g-3 g-md-4">
                            <div class="col-6 col-md-4">
                                <div class="show-key-label">Year</div>
                                <div class="show-key-value">{{ $car->year }}</div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="show-key-label">Mileage</div>
                                <div class="show-key-value">{{ $car->mileage !== null ? number_format((int) $car->mileage) . ' km' : 'On request' }}</div>
                            </div>
                            @if ($car->fuel_type)
                                <div class="col-12 col-md-4">
                                    <div class="show-key-label">Fuel</div>
                                    <div class="show-key-value">{{ $car->fuel_type }}</div>
                                </div>
                            @endif
                        </div>
                        <div class="show-cta-row mt-3 pt-3 border-top border-secondary-subtle">
                            <a href="tel:{{ preg_replace('/\s+/', '', config('dealer.phone_tel')) }}" class="btn btn-brand-primary">Call now</a>
                            <a href="#enquiry-form" class="btn btn-brand-outline">Send enquiry</a>
                        </div>
                        <ul class="list-unstyled small brand-muted mb-0 mt-3 pt-3 border-top border-secondary-subtle show-trust-list">
                            <li class="d-flex gap-2 mb-2">
                                <span class="show-trust-bullet" aria-hidden="true"></span>
                                <span>Quality checked vehicles</span>
                            </li>
                            <li class="d-flex gap-2 mb-2">
                                <span class="show-trust-bullet" aria-hidden="true"></span>
                                <span>Viewing by appointment</span>
                            </li>
                            <li class="d-flex gap-2 mb-0">
                                <span class="show-trust-bullet" aria-hidden="true"></span>
                                <span>Personal support</span>
                            </li>
                        </ul>
                    </div>

                    @if ($mainImagePath)
                        <img
                            id="mainCarImage"
                            src="{{ \Illuminate\Support\Facades\Storage::url($mainImagePath) }}"
                            alt="{{ $car->title }}"
                            class="img-fluid rounded border mb-3 main-car-gallery__hero"
                            role="button"
                            data-current-index="0"
                            style="width: 100%; max-height: 520px; object-fit: cover; border-color: rgba(201, 164, 92, 0.35) !important;"
                        >

                        @if ($imagePaths->count() > 1)
                            <div class="row g-2 mb-4" id="carImageThumbnails">
                                @foreach ($imagePaths as $imagePath)
                                    <div class="col-4 col-sm-3 col-md-2">
                                        <button
                                            type="button"
                                            class="p-0 w-100 bg-transparent rounded thumbnail-button @if ($loop->first) active @endif"
                                            data-image-url="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                            data-image-index="{{ $loop->index }}"
                                        >
                                            <img
                                                src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                                alt="{{ $car->title }} thumbnail {{ $loop->iteration }}"
                                                class="w-100"
                                                style="height: 90px; object-fit: cover;"
                                            >
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="d-flex align-items-center justify-content-center rounded border mb-3 brand-muted" style="height: 340px; border-color: rgba(201, 164, 92, 0.35) !important;">
                            <span>No featured image</span>
                        </div>
                    @endif

                    <h2 class="h5 mb-3">Description</h2>
                    <p class="mb-0 brand-muted">{{ $car->description ?: 'No description provided.' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card brand-card shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <h2 class="h5 mb-3">Quick Specs</h2>
                    <p class="mb-2 brand-muted"><strong class="spec-label">Make:</strong> {{ $car->make }}</p>
                    <p class="mb-2 brand-muted"><strong class="spec-label">Model:</strong> {{ $car->model }}</p>
                    <p class="mb-2 brand-muted"><strong class="spec-label">Year:</strong> {{ $car->year }}</p>
                    <p class="mb-2 brand-muted"><strong class="spec-label">Mileage:</strong> {{ $car->mileage ? number_format($car->mileage) . ' km' : 'N/A' }}</p>
                    <p class="mb-2 brand-muted"><strong class="spec-label">Fuel:</strong> {{ $car->fuel_type ?: 'N/A' }}</p>
                    <p class="mb-2 brand-muted"><strong class="spec-label">Transmission:</strong> {{ $car->transmission ?: 'N/A' }}</p>
                    <p class="mb-0 brand-muted"><strong class="spec-label">Colour:</strong> {{ $car->colour ?: 'N/A' }}</p>
                </div>
            </div>

            <div class="card brand-card shadow-sm rounded-4">
                <div class="card-body p-4">
                    <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Interested in this car?</p>
                    <h2 class="h4 mb-2">Send an Enquiry</h2>
                    <p class="brand-muted mb-3">Submit the form and our team will contact you quickly with availability and next steps.</p>
                    <a href="#enquiry-form" class="btn btn-brand-primary w-100">Send enquiry</a>
                </div>
            </div>
        </div>
    </div>

    <div id="enquiry-form" class="card brand-card shadow-sm rounded-4 mb-4 show-enquiry-anchor">
        <div class="card-body p-4 p-md-5">
            <h2 class="h3 mb-3">Enquiry Form</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <p class="mb-2">Please fix the following:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('enquiries.store', ['car' => $car->slug]) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone (optional)</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                    </div>

                    <div class="col-12">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-brand-primary mt-3">Send Enquiry</button>
            </form>
        </div>
    </div>

    <div class="brand-card rounded-4 p-4 text-center mb-4">
        <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Need a faster response?</p>
        <h2 class="h4 mb-2">Call or email our sales team today</h2>
        <p class="brand-muted mb-2">
            <a href="tel:{{ preg_replace('/\s+/', '', config('dealer.phone_tel')) }}" class="footer-link fw-semibold">{{ config('dealer.phone_display') }}</a>
            <span class="mx-1 opacity-50">·</span>
            <a href="{{ config('dealer.email_mailto') }}" class="footer-link fw-semibold">{{ config('dealer.email_display') }}</a>
        </p>
        <a href="#enquiry-form" class="btn btn-brand-outline btn-sm">Send enquiry</a>
    </div>

    @if ($imagePaths->isNotEmpty())
        <div class="modal fade" id="carImageLightboxModal" tabindex="-1" aria-labelledby="carImageLightboxModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content bg-black">
                    <div class="modal-header border-0">
                        <h2 class="visually-hidden" id="carImageLightboxModalLabel">Car image gallery</h2>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center pt-0">
                        <div id="carLightboxCarousel" class="carousel slide w-100">
                            <div class="carousel-inner">
                                @foreach ($imagePaths as $imagePath)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                            class="d-block mx-auto"
                                            alt="{{ $car->title }} image {{ $loop->iteration }}"
                                            style="max-height: 85vh; max-width: 100%; object-fit: contain;"
                                        >
                                    </div>
                                @endforeach
                            </div>

                            @if ($imagePaths->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carLightboxCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carLightboxCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($imagePaths->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mainImage = document.getElementById('mainCarImage');
                const thumbnailButtons = document.querySelectorAll('#carImageThumbnails button[data-image-url]');
                const lightboxModalElement = document.getElementById('carImageLightboxModal');
                const lightboxCarouselElement = document.getElementById('carLightboxCarousel');

                if (!mainImage || !lightboxModalElement || !lightboxCarouselElement) {
                    return;
                }

                const lightboxModal = new bootstrap.Modal(lightboxModalElement);
                const lightboxCarousel = bootstrap.Carousel.getOrCreateInstance(lightboxCarouselElement, {
                    interval: false,
                    ride: false
                });

                let selectedImageIndex = parseInt(mainImage.getAttribute('data-current-index'), 10) || 0;

                function openLightboxAt(index) {
                    const i = Number(index) || 0;
                    lightboxCarousel.to(i);
                    lightboxModal.show();
                }

                function updateThumbnailActiveState(index) {
                    thumbnailButtons.forEach(function (btn) {
                        const idx = parseInt(btn.getAttribute('data-image-index'), 10);
                        btn.classList.toggle('active', idx === index);
                    });
                }

                function setSelectedImage(index, url) {
                    selectedImageIndex = Number(index) || 0;
                    const fadeMs = 120;

                    mainImage.style.opacity = '0.62';

                    window.setTimeout(function () {
                        const onLoaded = function () {
                            mainImage.style.opacity = '1';
                            mainImage.removeEventListener('load', onLoaded);
                        };

                        mainImage.addEventListener('load', onLoaded);
                        mainImage.src = url;
                        mainImage.setAttribute('data-current-index', String(selectedImageIndex));

                        if (mainImage.complete) {
                            mainImage.style.opacity = '1';
                            mainImage.removeEventListener('load', onLoaded);
                        }

                        updateThumbnailActiveState(selectedImageIndex);
                    }, fadeMs);
                }

                mainImage.addEventListener('click', function () {
                    const idx = parseInt(mainImage.getAttribute('data-current-index'), 10);
                    openLightboxAt(Number.isNaN(idx) ? selectedImageIndex : idx);
                });

                thumbnailButtons.forEach(function (button) {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        const url = this.getAttribute('data-image-url');
                        const clickedIndex = parseInt(this.getAttribute('data-image-index'), 10);
                        if (!url || Number.isNaN(clickedIndex)) {
                            return;
                        }
                        setSelectedImage(clickedIndex, url);
                    });
                });
            });
        </script>
    @endif
    </div>
@endsection
