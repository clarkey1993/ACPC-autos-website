@extends('layouts.public')

@section('title', 'Home - ACPC Autos')

@section('content')
    <div class="page-home">
        <style>
            .page-home {
                --home-surface: linear-gradient(165deg, #fffefb 0%, #fbf8f2 56%, #f6f1e7 100%);
                --home-accent-line: linear-gradient(90deg, transparent, rgba(185, 145, 70, 0.66), rgba(47, 94, 58, 0.28), transparent);
                --featured-section-bg: linear-gradient(155deg, rgba(255, 254, 251, 0.98) 0%, rgba(250, 246, 237, 0.96) 52%, rgba(245, 240, 230, 0.96) 100%);
            }

            .page-home .home-panel,
            .page-home .card.brand-card:not(.car-inventory-card) {
                background: var(--home-surface);
                border: 1px solid rgba(185, 145, 70, 0.16);
                box-shadow: 0 10px 24px rgba(15, 24, 18, 0.07);
            }

            .page-home .home-muted {
                color: #667168 !important;
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

            .page-home .featured-shell {
                background: var(--featured-section-bg);
                border: 1px solid rgba(185, 145, 70, 0.15);
                border-radius: 1rem;
                padding: 1.75rem 1.15rem 1.35rem;
                box-shadow: 0 12px 28px rgba(15, 24, 18, 0.07);
            }

            .page-home .home-featured-heading {
                font-size: clamp(1.9rem, 3.4vw, 2.5rem);
                font-weight: 700;
                color: #232925;
                letter-spacing: -0.01em;
            }

            .page-home .home-featured-intro {
                max-width: 640px;
                margin-left: auto;
                margin-right: auto;
            }

            .page-home .home-featured-intro .home-title-accent {
                margin-left: auto;
                margin-right: auto;
            }

            .page-home .featured-cards-row {
                justify-content: center;
            }

            @media (prefers-color-scheme: dark) {
                .page-home {
                    --home-surface: linear-gradient(168deg, rgba(38, 48, 54, 0.95) 0%, rgba(30, 38, 44, 0.98) 55%, rgba(26, 32, 37, 0.99) 100%);
                    --home-accent-line: linear-gradient(90deg, transparent, rgba(201, 164, 92, 0.55), rgba(47, 94, 58, 0.45), transparent);
                    --featured-section-bg: linear-gradient(158deg, rgba(34, 44, 40, 0.55) 0%, rgba(28, 36, 42, 0.86) 100%);
                }

                .page-home .home-panel,
                .page-home .card.brand-card:not(.car-inventory-card) {
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
            }
        </style>

        <section id="featured-cars" class="py-3 py-md-4 mb-5 mb-md-6 featured-shell">
            <div class="home-featured-intro text-center mb-4">
                <div class="home-title-accent"></div>
                <h2 class="home-featured-heading home-section-title mb-2">Featured cars</h2>
                <p class="home-muted small mb-0">Current highlights from our showroom — tap a card for full details.</p>
            </div>

            <div class="row g-3 g-md-4 featured-cards-row">
                @forelse ($latestCars as $car)
                    <div class="col-12 col-sm-6 col-xl-4">
                        @include('public.cars.partials.car-card', ['car' => $car, 'carouselIdPrefix' => 'homeCarCard'])
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

@section('footer_brand')
    <a href="{{ route('home') }}" class="brand-logo-link d-inline-block mb-2">
        <img src="{{ asset('images/logo-full.png') }}" alt="ACPC Autos" class="brand-logo brand-logo--footer" loading="lazy" decoding="async">
    </a>
@endsection
