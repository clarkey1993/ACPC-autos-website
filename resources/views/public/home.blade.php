@extends('layouts.public')

@section('title', __('public.home.title'))
@section('meta_description', __('public.home.meta_description'))

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

            .page-home .premium-parallax-section {
                position: relative;
                width: 100vw;
                min-height: 52vh;
                margin-left: calc(50% - 50vw);
                margin-right: calc(50% - 50vw);
                margin-top: 4rem;
                margin-bottom: 4rem;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                isolation: isolate;
                background-image:
                    linear-gradient(rgba(0, 0, 0, 0.56), rgba(0, 0, 0, 0.56)),
                    url("https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=2400&q=85");
                background-size: cover;
                background-position: center 58%;
                background-attachment: fixed;
                border-top: 1px solid rgba(213, 183, 122, 0.38);
                border-bottom: 1px solid rgba(213, 183, 122, 0.38);
                box-shadow: 0 18px 44px rgba(10, 28, 18, 0.28);
            }

            .page-home .premium-parallax-content {
                position: relative;
                z-index: 1;
                max-width: 760px;
                width: min(760px, 100%);
                margin-left: auto;
                margin-right: auto;
                padding: 2rem 1.25rem;
                text-align: center;
            }

            .page-home .premium-parallax-accent {
                width: 84px;
                height: 2px;
                margin: 0 auto 1.2rem;
                border-radius: 999px;
                background: var(--home-accent-line);
            }

            .page-home .premium-parallax-heading {
                color: var(--brand-gold-light);
                font-size: clamp(2rem, 4.1vw, 3.45rem);
                font-weight: 700;
                letter-spacing: -0.02em;
                line-height: 1.05;
                text-shadow: 0 3px 16px rgba(0, 0, 0, 0.5);
            }

            .page-home .premium-parallax-subheading {
                color: #f5f1e8;
                font-size: clamp(1rem, 2.1vw, 1.45rem);
                letter-spacing: 0.06em;
                text-shadow: 0 2px 12px rgba(0, 0, 0, 0.48);
            }

            @media (max-width: 991.98px) {
                .page-home .premium-parallax-section {
                    min-height: 48vh;
                    background-attachment: scroll;
                    background-position: center;
                }

                .page-home .premium-parallax-content {
                    margin-left: auto;
                    margin-right: auto;
                }
            }

            @media (max-width: 575.98px) {
                .page-home .premium-parallax-section {
                    min-height: 38vh;
                    margin-top: 2.75rem;
                    margin-bottom: 2.75rem;
                }

                .page-home .premium-parallax-content {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }

                .page-home .premium-parallax-subheading {
                    letter-spacing: 0.035em;
                }
            }
        </style>

        <section id="featured-cars" class="py-3 py-md-4 mb-5 mb-md-6 featured-shell">
            <div class="home-featured-intro text-center mb-4">
                <div class="home-title-accent"></div>
                <h2 class="home-featured-heading home-section-title mb-2">{{ __('public.home.current_stock') }}</h2>
                <p class="home-muted small mb-0">{{ __('public.home.showroom_intro') }}</p>
            </div>

            <div class="row g-3 g-md-4 featured-cards-row">
                @forelse ($cars as $car)
                    <div class="col-12 col-md-6">
                        @include('public.cars.partials.car-card', ['car' => $car, 'carouselIdPrefix' => 'homeCarCard'])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="home-panel rounded-4 p-4 text-center home-muted">{{ __('public.home.no_cars') }}</div>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="premium-parallax-section" aria-labelledby="premium-parallax-heading">
            <div class="premium-parallax-content">
                <div class="premium-parallax-accent"></div>
                <h2 id="premium-parallax-heading" class="premium-parallax-heading mb-3">{{ __('public.home.parallax_heading') }}</h2>
                <p class="premium-parallax-subheading mb-0">{{ __('public.home.parallax_subheading') }}</p>
            </div>
        </section>

        <section class="mb-4 mb-md-5">
            <div class="home-title-accent"></div>
            <h2 class="h4 home-section-title text-brand-gold mb-3">{{ __('public.home.why_buy') }}</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="home-panel rounded-4 p-4 h-100">
                        <h3 class="h6 text-brand-gold text-uppercase small fw-semibold mb-2">{{ __('public.home.selection') }}</h3>
                        <p class="mb-0 small home-muted">{{ __('public.home.selection_text') }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-panel rounded-4 p-4 h-100">
                        <h3 class="h6 text-brand-gold text-uppercase small fw-semibold mb-2">{{ __('public.home.clarity') }}</h3>
                        <p class="mb-0 small home-muted">{{ __('public.home.clarity_text') }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-panel rounded-4 p-4 h-100">
                        <h3 class="h6 text-brand-gold text-uppercase small fw-semibold mb-2">{{ __('public.home.service') }}</h3>
                        <p class="mb-0 small home-muted">{{ __('public.home.service_text') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-2">
            <div class="home-panel rounded-4 p-4 p-md-5 text-center">
                <p class="text-uppercase small text-brand-gold fw-semibold mb-2">{{ __('public.home.source_eyebrow') }}</p>
                <h2 class="h3 mb-2">{{ __('public.home.source_title') }}</h2>
                <p class="home-muted small mb-4 mb-md-3">{{ __('public.home.source_text') }}</p>
                <a href="{{ route('contact') }}" class="btn btn-brand-primary btn-lg">{{ __('public.buttons.contact_us') }}</a>
            </div>
        </section>
    </div>
@endsection

@section('footer_brand')
    <a href="{{ route('home') }}" class="brand-logo-link footer-brand-col__logo-link">
        <img src="{{ asset('images/logo-full.png') }}" alt="{{ __('public.brand') }}" class="brand-logo brand-logo--footer" loading="lazy" decoding="async">
    </a>
@endsection
