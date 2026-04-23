@extends('layouts.public')

@section('title', 'Home - ACPC Autos')

@section('content')
    <div class="page-home">
        <style>
            .page-home {
                --home-accent-line: linear-gradient(90deg, transparent, rgba(213, 183, 122, 0.9), rgba(185, 145, 70, 0.55), transparent);
            }

            .page-home .home-panel,
            .page-home .card.brand-card:not(.car-inventory-card) {
                background: var(--brand-panel-bg);
                border: 1px solid var(--brand-panel-border);
                color: var(--brand-panel-text);
                box-shadow: var(--brand-panel-shadow);
            }

            .page-home .home-panel h1,
            .page-home .home-panel h2,
            .page-home .home-panel h3,
            .page-home .home-panel h4,
            .page-home .home-panel h5,
            .page-home .home-panel h6 {
                color: var(--brand-panel-text);
            }

            .page-home .home-panel .text-brand-gold {
                color: var(--brand-gold-light) !important;
            }

            .page-home .home-muted {
                color: var(--brand-panel-muted) !important;
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
                background: var(--brand-panel-bg-soft);
                border: 1px solid var(--brand-panel-border);
                border-radius: 1rem;
                padding: 1.75rem 1.15rem 1.35rem;
                color: var(--brand-panel-text);
                box-shadow: var(--brand-panel-shadow);
            }

            .page-home .home-featured-heading {
                font-size: clamp(1.9rem, 3.4vw, 2.5rem);
                font-weight: 700;
                color: var(--brand-gold-light);
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

            .page-home .featured-shell .pagination .page-link {
                background-color: transparent;
                border-color: var(--brand-panel-border);
                color: var(--brand-panel-text);
            }

            .page-home .featured-shell .pagination .page-link:hover,
            .page-home .featured-shell .pagination .page-link:focus {
                background-color: rgba(213, 183, 122, 0.1);
                border-color: var(--brand-panel-border-strong);
                color: var(--brand-gold-light);
                box-shadow: none;
            }

            .page-home .featured-shell .pagination .page-item.active .page-link {
                background-color: var(--brand-primary);
                border-color: var(--brand-primary);
                color: #f7f5ef;
            }

            .page-home .featured-shell .pagination .page-item.disabled .page-link {
                background-color: transparent;
                color: var(--brand-panel-muted);
                opacity: 0.55;
            }
        </style>

        <section id="featured-cars" class="py-3 py-md-4 mb-5 mb-md-6 featured-shell">
            <div class="home-featured-intro text-center mb-4">
                <div class="home-title-accent"></div>
                <h2 class="home-featured-heading home-section-title mb-2">Current stock</h2>
                <p class="home-muted small mb-0">Browse our full showroom inventory in one place.</p>
            </div>

            <div class="row g-3 g-md-4 featured-cards-row">
                @forelse ($cars as $car)
                    <div class="col-12 col-sm-6 col-xl-4">
                        @include('public.cars.partials.car-card', ['car' => $car, 'carouselIdPrefix' => 'homeCarCard'])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="home-panel rounded-4 p-4 text-center home-muted">No cars available right now. Please check back soon.</div>
                    </div>
                @endforelse
            </div>

            @if ($cars->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $cars->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </section>

        <section class="mb-4 mb-md-5">
            <div class="home-title-accent"></div>
            <h2 class="h4 home-section-title text-brand-gold mb-3">Why buy from us</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="home-panel rounded-4 p-4 h-100">
                        <h3 class="h6 text-brand-gold text-uppercase small fw-semibold mb-2">Selection</h3>
                        <p class="mb-0 small home-muted">Low milage vehicles chosen for quality, condition, and long-term value.</p>
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
                <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Can't find what you're looking for?</p>
                <h2 class="h3 mb-2">Let us help find it</h2>
                <p class="home-muted small mb-4 mb-md-3">Tell us the make, model, budget, and any must-have features, and we'll do our best to source the right vehicle for you.</p>
                <a href="{{ route('contact') }}" class="btn btn-brand-primary btn-lg">Contact us!</a>
            </div>
        </section>
    </div>
@endsection

@section('footer_brand')
    <a href="{{ route('home') }}" class="brand-logo-link d-inline-block mb-2">
        <img src="{{ asset('images/logo-full.png') }}" alt="ACPC Autos" class="brand-logo brand-logo--footer" loading="lazy" decoding="async">
    </a>
@endsection
