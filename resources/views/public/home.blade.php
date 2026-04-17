@extends('layouts.public')

@section('title', 'Home - ACPC Autos')

@section('content')
    <div class="page-home">
        <style>
            .page-home {
                --home-surface: linear-gradient(165deg, #ffffff 0%, #fbf8f1 58%, #f4eee1 100%);
                --home-hero: linear-gradient(120deg, rgba(47, 94, 58, 0.1) 0%, rgba(255, 255, 255, 0.98) 46%, rgba(243, 235, 220, 0.96) 100%);
                --home-accent-line: linear-gradient(90deg, transparent, rgba(185, 145, 70, 0.8), rgba(47, 94, 58, 0.5), transparent);
                --featured-section-bg: linear-gradient(155deg, rgba(233, 241, 232, 0.5) 0%, rgba(246, 242, 232, 0.78) 45%, rgba(250, 247, 240, 0.92) 100%);
            }

            .page-home .home-hero {
                background: var(--home-hero);
                border: 1px solid rgba(185, 145, 70, 0.3);
                box-shadow: 0 14px 32px rgba(21, 36, 28, 0.09);
            }

            .page-home .home-panel,
            .page-home .card.brand-card {
                background: var(--home-surface);
                border: 1px solid rgba(47, 94, 58, 0.16);
                box-shadow: 0 8px 24px rgba(21, 36, 28, 0.08);
            }

            .page-home .home-muted {
                color: #5f6f63 !important;
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
                height: 215px;
                object-fit: cover;
            }

            .page-home .home-hero .display-5 {
                line-height: 1.12;
            }

            .page-home .home-hero-brandrow {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.45rem;
                max-width: 100%;
            }

            @media (min-width: 576px) {
                .page-home .home-hero-brandrow {
                    flex-direction: row;
                    flex-wrap: wrap;
                    align-items: center;
                    column-gap: 0.6rem;
                    row-gap: 0.25rem;
                }
            }

            .page-home .home-hero-brandrow .brand-logo-link {
                flex-shrink: 0;
                line-height: 0;
            }

            .page-home .home-hero-brandtext {
                flex: 0 1 auto;
                min-width: 0;
            }

            .page-home .brand-logo--hero {
                height: clamp(62px, 8.75vw, 92px);
                width: auto;
                max-width: min(400px, 100%);
                filter: drop-shadow(0 2px 12px rgba(31, 43, 36, 0.14));
            }

            .page-home .home-hero-name {
                font-size: clamp(1.48rem, 2.65vw, 1.95rem);
                font-weight: 700;
                letter-spacing: -0.022em;
                line-height: 1.12;
                color: #101c15;
                margin-bottom: 0;
                text-wrap: balance;
            }

            .page-home .home-hero-rule {
                width: 40px;
                height: 2px;
                border-radius: 2px;
                background: var(--home-accent-line);
                opacity: 0.88;
                margin-top: 0.35rem;
                margin-bottom: 0.3rem;
            }

            .page-home .home-hero-eyebrow {
                font-size: 0.6875rem;
                font-weight: 500;
                letter-spacing: 0.18em;
                line-height: 1.5;
                color: rgba(72, 62, 42, 0.82);
            }

            .page-home .featured-shell {
                background: var(--featured-section-bg);
                border: 1px solid rgba(47, 94, 58, 0.12);
                border-radius: 1rem;
                padding: 1.75rem 1.15rem 1.35rem;
                box-shadow: 0 6px 20px rgba(21, 36, 28, 0.06);
            }

            .page-home .home-featured-heading {
                font-size: clamp(1.65rem, 3vw, 2.2rem);
                font-weight: 700;
                color: #1f2f25;
            }

            @media (prefers-color-scheme: dark) {
                .page-home {
                    --home-surface: linear-gradient(168deg, rgba(38, 48, 54, 0.95) 0%, rgba(30, 38, 44, 0.98) 55%, rgba(26, 32, 37, 0.99) 100%);
                    --home-hero: linear-gradient(118deg, rgba(47, 94, 58, 0.42) 0%, rgba(30, 51, 39, 0.88) 42%, rgba(22, 30, 36, 0.94) 100%);
                    --home-accent-line: linear-gradient(90deg, transparent, rgba(201, 164, 92, 0.55), rgba(47, 94, 58, 0.45), transparent);
                    --featured-section-bg: linear-gradient(158deg, rgba(34, 44, 40, 0.55) 0%, rgba(28, 36, 42, 0.86) 100%);
                }

                .page-home .home-hero {
                    border-color: rgba(224, 201, 138, 0.32);
                    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.28);
                }

                .page-home .home-panel,
                .page-home .card.brand-card {
                    border-color: rgba(201, 164, 92, 0.26);
                    box-shadow: 0 6px 22px rgba(0, 0, 0, 0.18);
                }

                .page-home .home-muted {
                    color: #d8d0c4 !important;
                }

                .page-home .featured-shell {
                    border-color: rgba(201, 164, 92, 0.2);
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
                }

                .page-home .home-featured-heading {
                    color: #efe7d4;
                }

                .page-home .home-hero-name {
                    color: #faf6ec;
                }

                .page-home .home-hero-eyebrow {
                    color: rgba(216, 208, 196, 0.82);
                }

                .page-home .brand-logo--hero {
                    filter: brightness(1.08) contrast(1.04) drop-shadow(0 2px 14px rgba(0, 0, 0, 0.45));
                }
            }
        </style>

        <section id="featured-cars" class="py-3 py-md-4 mb-5 mb-md-6 featured-shell">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-3">
                <div>
                    <div class="home-title-accent"></div>
                    <h2 class="home-featured-heading home-section-title mb-0">Featured cars</h2>
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
                                <div class="d-flex align-items-center justify-content-center home-muted stock-image bg-secondary bg-opacity-10">
                                    No image
                                </div>
                            @endif
                            <div class="card-body p-3 p-md-4 d-flex flex-column">
                                <h3 class="h5 card-title mb-1">{{ $car->title }}</h3>
                                <p class="small home-muted mb-2">{{ $car->make }} {{ $car->model }} · {{ $car->year }}</p>
                                @include('public.cars.partials.card-summary', ['car' => $car])
                                <p class="price-highlight">€{{ number_format($car->price) }}</p>
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

        <section class="home-hero rounded-4 px-3 px-md-4 py-2 py-md-3 mt-3 mt-md-4 mb-3 mb-md-4 shadow-sm">
            <div class="row align-items-center g-3 g-md-4">
                <div class="col-lg-7">
                    <div class="home-hero-brandrow mb-2 mb-md-3">
                        <a href="{{ route('home') }}" class="brand-logo-link d-inline-flex align-items-center">
                            <img src="{{ asset('images/logo-full.png') }}" alt="ACPC Autos" class="brand-logo brand-logo--hero" decoding="async">
                        </a>
                        <div class="home-hero-brandtext">
                            <p class="home-hero-name">ACPC Autos</p>
                            <div class="home-hero-rule"></div>
                            <p class="text-uppercase home-hero-eyebrow mb-0">Premium dealer stock</p>
                        </div>
                    </div>
                    <h1 class="display-5 fw-semibold mb-2 mb-md-2">Exceptional cars, ready when you are</h1>
                    <p class="fs-6 home-muted mb-3 mb-md-3">A small, curated list of quality vehicles — browse with confidence and speak directly with our team.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#featured-cars" class="btn btn-brand-primary">View featured</a>
                        <a href="{{ route('cars.index') }}" class="btn btn-brand-outline">Full stock list</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="home-panel rounded-3 p-3 p-md-4 h-100">
                        <p class="small text-brand-gold fw-semibold mb-2">Why our stock stands out</p>
                        <p class="mb-2 small home-muted">Hand-picked vehicles with presentation and history in mind.</p>
                        <p class="mb-2 small home-muted">Straightforward details — no clutter, no endless filters.</p>
                        <p class="mb-0 small home-muted">Personal support from first look to handover.</p>
                    </div>
                </div>
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

@section('footer_brand')
    <a href="{{ route('home') }}" class="brand-logo-link d-inline-block mb-2">
        <img src="{{ asset('images/logo-full.png') }}" alt="ACPC Autos" class="brand-logo brand-logo--footer" loading="lazy" decoding="async">
    </a>
@endsection
