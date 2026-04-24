@extends('layouts.public')

@section('title', __('public.brand') . ' | ' . trim(preg_replace('/\s+/', ' ', ($car->make ?: '') . ' ' . ($car->model ?: ''))) . ' ' . __('public.cars.show_title_suffix'))
@section('meta_description', __('public.cars.show_meta_template', [
    'name' => trim(preg_replace('/\s+/', ' ', ($car->make ?: '') . ' ' . ($car->model ?: ''))),
    'mid' => __('public.cars.show_meta_mid'),
    'year' => $car->year ?: __('public.fallback.used'),
    'mileage' => $car->cardMileageText(),
    'price' => '€' . number_format((float) $car->price),
    'end' => __('public.cars.show_meta_end'),
]))
@section('canonical_url', route('cars.show', $car->slug))
@section('og_type', 'product')
@section('og_image', $car->featured_image ? url(\Illuminate\Support\Facades\Storage::url($car->featured_image)) : asset('images/logo-full.png'))

@section('content')
    <style>
        .page-cars-show {
            --show-border: var(--brand-panel-border);
            /* When max-height caps the hero, width must cap too or 16:10 leaves empty bands */
            --show-gallery-max-width: min(100%, calc(620px * 16 / 10));
        }

        /* -------- Top back link -------- */
        .page-cars-show .show-back {
            margin-bottom: 0.75rem;
        }

        /* -------- Title + price header above gallery -------- */
        .page-cars-show .show-hero-header {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 0.5rem 1.5rem;
            margin: 0 0 1rem;
        }

        .page-cars-show .show-hero-title {
            flex: 1 1 auto;
            min-width: 0;
            font-size: clamp(1.7rem, 3.4vw, 2.45rem);
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: 0.005em;
            color: var(--brand-text);
            margin: 0;
            text-wrap: balance;
        }

        .page-cars-show .show-hero-price {
            flex: 0 0 auto;
            font-size: clamp(1.45rem, 2.8vw, 2rem);
            font-weight: 700;
            color: var(--brand-gold);
            letter-spacing: 0.005em;
            line-height: 1.15;
            margin: 0;
            white-space: nowrap;
            text-align: right;
        }

        /* -------- Gallery (carousel on top) -------- */
        .page-cars-show .show-gallery {
            display: block;
            width: 100%;
            max-width: var(--show-gallery-max-width);
            margin-inline: auto;
            position: relative;
            border-radius: 1.1rem;
            overflow: hidden;
        }

        .page-cars-show .show-gallery__media {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            max-height: 620px;
            background: var(--brand-panel-media-bg);
            overflow: hidden;
        }

        .page-cars-show .show-gallery__carousel,
        .page-cars-show .show-gallery__carousel .carousel-inner,
        .page-cars-show .show-gallery__carousel .carousel-item {
            height: 100%;
            min-height: 0;
        }

        .page-cars-show .show-gallery__image {
            display: block;
            width: 100%;
            height: 100%;
            min-height: 100%;
            object-fit: cover;
            object-position: center;
            cursor: zoom-in;
        }

        .page-cars-show .show-gallery__empty {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-panel-muted);
            font-size: 0.9rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .page-cars-show .show-gallery .carousel-control-prev,
        .page-cars-show .show-gallery .carousel-control-next {
            width: auto;
            z-index: 12;
            opacity: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            top: 50%;
            bottom: auto;
            transform: translateY(-50%);
            pointer-events: auto;
            filter: none;
        }

        .page-cars-show .show-gallery .carousel-control-prev {
            left: clamp(0.75rem, 2vw, 1.25rem);
            right: auto;
        }

        .page-cars-show .show-gallery .carousel-control-next {
            right: clamp(0.75rem, 2vw, 1.25rem);
            left: auto;
        }

        /* Gold chevron only (no circle) — drop-shadow keeps it readable on any photo */
        .page-cars-show .show-gallery .carousel-control-prev-icon,
        .page-cars-show .show-gallery .carousel-control-next-icon {
            width: clamp(2rem, 3.6vw, 2.55rem);
            height: clamp(2.55rem, 5.1vw, 3.35rem);
            padding: 0;
            background-color: transparent;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            border: none;
            border-radius: 0;
            box-shadow: none;
            filter: drop-shadow(0 1px 1px rgba(0, 0, 0, 0.9)) drop-shadow(0 0 10px rgba(0, 0, 0, 0.55));
            transition: filter 0.2s ease, transform 0.2s ease;
        }

        /* Taller, slimmer stroke chevrons (narrower angle + lighter line weight) */
        .page-cars-show .show-gallery .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 30' fill='none' stroke='%23d4af37' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='14 3 6 15 14 27'/%3E%3C/svg%3E");
        }

        .page-cars-show .show-gallery .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 30' fill='none' stroke='%23d4af37' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 3 14 15 6 27'/%3E%3C/svg%3E");
        }

        .page-cars-show .show-gallery .carousel-control-prev:hover .carousel-control-prev-icon,
        .page-cars-show .show-gallery .carousel-control-next:hover .carousel-control-next-icon,
        .page-cars-show .show-gallery .carousel-control-prev:focus-visible .carousel-control-prev-icon,
        .page-cars-show .show-gallery .carousel-control-next:focus-visible .carousel-control-next-icon {
            filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.95)) drop-shadow(0 0 14px rgba(0, 0, 0, 0.65)) drop-shadow(0 0 6px rgba(212, 175, 55, 0.55));
            transform: scale(1.08);
        }

        .page-cars-show .show-gallery .carousel-control-prev:focus-visible,
        .page-cars-show .show-gallery .carousel-control-next:focus-visible {
            outline: none;
        }

        @media (prefers-reduced-motion: reduce) {
            .page-cars-show .show-gallery .carousel-control-prev-icon,
            .page-cars-show .show-gallery .carousel-control-next-icon {
                transition: none;
            }

            .page-cars-show .show-gallery .carousel-control-prev:hover .carousel-control-prev-icon,
            .page-cars-show .show-gallery .carousel-control-next:hover .carousel-control-next-icon,
            .page-cars-show .show-gallery .carousel-control-prev:focus-visible .carousel-control-prev-icon,
            .page-cars-show .show-gallery .carousel-control-next:focus-visible .carousel-control-next-icon {
                transform: none;
            }
        }

        .page-cars-show .show-gallery__count {
            position: absolute;
            top: 0.85rem;
            right: 0.85rem;
            z-index: 5;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.65rem;
            border-radius: 999px;
            background: rgba(12, 18, 14, 0.62);
            color: #fefaf0;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            pointer-events: none;
        }

        .page-cars-show .show-gallery__count svg {
            width: 0.9rem;
            height: 0.9rem;
        }

        .page-cars-show .show-thumbnails {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(84px, 1fr));
            gap: 0.5rem;
            margin-top: 0.85rem;
            width: 100%;
            max-width: var(--show-gallery-max-width);
            margin-inline: auto;
        }

        @media (min-width: 768px) {
            .page-cars-show .show-thumbnails {
                grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
                gap: 0.6rem;
            }
        }

        .page-cars-show .show-thumb {
            display: block;
            padding: 0;
            background: transparent;
            border: 2px solid transparent;
            border-radius: 0.55rem;
            overflow: hidden;
            aspect-ratio: 4 / 3;
            cursor: pointer;
            transition: border-color 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease;
        }

        .page-cars-show .show-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .page-cars-show .show-thumb:hover {
            transform: translateY(-1px);
            border-color: var(--brand-panel-border-strong);
        }

        .page-cars-show .show-thumb.active {
            border-color: var(--brand-gold-light);
            box-shadow: 0 0 0 1px var(--brand-panel-border-strong);
        }

        /* -------- Main info band (title / price / specs / CTAs) -------- */
        .page-cars-show .show-info {
            border-radius: 1rem;
            padding: 1.35rem 1.35rem 1.2rem;
            margin-top: 1.25rem;
        }

        @media (min-width: 768px) {
            .page-cars-show .show-info {
                padding: 1.75rem 1.85rem 1.5rem;
            }
        }

        .page-cars-show .show-info__status-row {
            display: flex;
            justify-content: flex-start;
            margin: 0 0 0.75rem;
        }

        .page-cars-show .show-info__status {
            font-size: 0.65rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.22rem 0.55rem;
        }

        .page-cars-show .show-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem 1.3rem;
            margin: 0 0 1.1rem;
            padding: 0 0 0.95rem;
            border-bottom: 1px solid var(--brand-panel-border);
            list-style: none;
        }

        .page-cars-show .show-chips li {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            color: var(--brand-panel-text);
            font-size: 0.9rem;
            font-weight: 500;
            line-height: 1.1;
        }

        .page-cars-show .show-chips svg {
            width: 1rem;
            height: 1rem;
            color: var(--brand-gold-light);
            opacity: 0.95;
            flex-shrink: 0;
        }

        .page-cars-show .show-chips__label {
            color: var(--brand-panel-muted);
            font-weight: 500;
            margin-right: 0.15rem;
        }

        .page-cars-show .show-cta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
        }

        .page-cars-show .show-cta-row .btn {
            min-height: 44px;
        }

        @media (max-width: 575.98px) {
            .page-cars-show .show-cta-row {
                flex-direction: column;
            }

            .page-cars-show .show-cta-row .btn,
            .page-cars-show .show-cta-row > * {
                width: 100%;
            }
        }

        /* -------- Vehicle details section -------- */
        .page-cars-show .show-section {
            border-radius: 1rem;
            padding: 1.4rem 1.4rem 1.3rem;
            margin-top: 1.25rem;
        }

        @media (min-width: 768px) {
            .page-cars-show .show-section {
                padding: 1.75rem 1.85rem 1.6rem;
            }
        }

        .page-cars-show .show-section__title {
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--brand-panel-text);
            margin: 0 0 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
        }

        .page-cars-show .show-section__title::before {
            content: "";
            width: 1.6rem;
            height: 2px;
            background: var(--brand-gold-light);
            opacity: 0.95;
            border-radius: 2px;
        }

        .page-cars-show .show-details-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .page-cars-show .show-details-list__item {
            display: grid;
            grid-template-columns: minmax(6.5rem, 9.5rem) 1fr;
            gap: 0.35rem 1rem;
            align-items: baseline;
            padding: 0.72rem 0;
            border-bottom: 1px solid var(--brand-panel-border);
        }

        .page-cars-show .show-details-list__item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .page-cars-show .show-details-list__label {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: capitalize;
            color: var(--brand-gold-light);
        }

        .page-cars-show .show-details-list__label::after {
            content: ":";
            color: var(--brand-gold-light);
            margin-left: 0.05em;
        }

        .page-cars-show .show-details-list__value {
            font-size: 0.98rem;
            font-weight: 500;
            color: var(--brand-panel-text);
            line-height: 1.45;
        }

        @media (max-width: 480px) {
            .page-cars-show .show-details-list__item {
                grid-template-columns: 1fr;
                gap: 0.2rem 0;
                padding: 0.62rem 0;
            }

            .page-cars-show .show-details-list__label {
                font-size: 0.78rem;
            }

            .page-cars-show .show-details-list__value {
                font-size: 0.94rem;
                padding-left: 0.05rem;
            }
        }

        .page-cars-show .show-description {
            color: var(--brand-panel-text);
            font-size: 0.98rem;
            line-height: 1.65;
            margin: 0;
            white-space: pre-line;
        }

        .page-cars-show .show-description--muted {
            color: var(--brand-panel-muted);
        }

        /* -------- Enquiry + call-out sections -------- */
        .page-cars-show .show-enquiry {
            scroll-margin-top: 5.5rem;
        }

        .page-cars-show .show-enquiry__header {
            margin-bottom: 1rem;
        }

        .page-cars-show .show-contact-card {
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            margin-top: 1.25rem;
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
        $mainCarouselId = 'showCarCarousel';
        $lightboxCarouselId = 'carLightboxCarousel';
        $carFuel = $car->cardFuelText();
        $carTransmission = $car->cardTransmissionText();
        $carColour = $car->colour;
        $carLocation = $car->location;
        $vehicleSchemaImages = $imagePaths
            ->map(fn ($path) => url(\Illuminate\Support\Facades\Storage::url($path)))
            ->values()
            ->all();
        $vehicleSchemaName = trim(preg_replace('/\s+/', ' ', ($car->make ?: '') . ' ' . ($car->model ?: '')));
        $vehicleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Vehicle',
            'name' => $vehicleSchemaName !== '' ? $vehicleSchemaName : $car->title,
            'brand' => [
                '@type' => 'Brand',
                'name' => $car->make ?: 'ACPC Autos',
            ],
            'model' => $car->model ?: null,
            'vehicleModelDate' => $car->year ? (string) $car->year : null,
            'mileageFromOdometer' => $car->mileage !== null ? [
                '@type' => 'QuantitativeValue',
                'value' => (int) $car->mileage,
                'unitCode' => 'KMT',
            ] : null,
            'vehicleTransmission' => $carTransmission,
            'fuelType' => $carFuel,
            'color' => $carColour ?: null,
            'image' => $vehicleSchemaImages,
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'EUR',
                'price' => $car->price !== null ? (float) $car->price : null,
                'availability' => match ($car->status) {
                    'available' => 'https://schema.org/InStock',
                    'reserved' => 'https://schema.org/PreOrder',
                    'sold' => 'https://schema.org/SoldOut',
                    default => 'https://schema.org/InStock',
                },
                'url' => route('cars.show', $car->slug),
                'itemCondition' => 'https://schema.org/UsedCondition',
                'seller' => [
                    '@type' => 'AutoDealer',
                    'name' => 'ACPC Autos',
                ],
            ],
        ];
    @endphp

    @push('structured_data')
        <script type="application/ld+json">{!! json_encode($vehicleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endpush

    <section class="show-back">
        <a href="{{ route('home') }}" class="btn btn-brand-outline btn-sm">&larr; {{ __('public.buttons.back') }}</a>
    </section>

    {{-- ================= Title + price (above gallery) ================= --}}
    <header class="show-hero-header">
        <h1 class="show-hero-title">{{ $car->title }}</h1>
        <p class="show-hero-price">€{{ number_format($car->price) }}</p>
    </header>

    {{-- ================= Gallery ================= --}}
    <section class="show-gallery mb-0">
        <div class="show-gallery__media">
            @if ($imagePaths->isNotEmpty())
                <div
                    id="{{ $mainCarouselId }}"
                    class="carousel slide show-gallery__carousel"
                    data-bs-ride="false"
                    data-bs-interval="false"
                    data-bs-touch="true"
                >
                    <div class="carousel-inner">
                        @foreach ($imagePaths as $imagePath)
                            <div class="carousel-item @if ($loop->first) active @endif">
                                <img
                                    src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                    alt="{{ $car->title }} {{ __('public.cars.photos') }} {{ $loop->iteration }}"
                                    class="show-gallery__image js-open-lightbox"
                                    data-image-index="{{ $loop->index }}"
                                    loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                    decoding="async"
                                >
                            </div>
                        @endforeach
                    </div>

                    @if ($imagePaths->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $mainCarouselId }}" data-bs-slide="prev" aria-label="{{ __('public.cars.previous') }} {{ __('public.cars.photos') }}">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">{{ __('public.cars.previous') }}</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#{{ $mainCarouselId }}" data-bs-slide="next" aria-label="{{ __('public.cars.next') }} {{ __('public.cars.photos') }}">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">{{ __('public.cars.next') }}</span>
                        </button>
                        <div class="show-gallery__count" aria-label="{{ $imagePaths->count() }} {{ __('public.cars.photos') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M15 12V6a1 1 0 0 0-1-1h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 3H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 5H2a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM2 4h1.172a1 1 0 0 0 .707-.293l.828-.828A3 3 0 0 1 6.828 2h2.344a3 3 0 0 1 2.121.879l.828.828A1 1 0 0 0 12.828 4H14a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                                <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                            </svg>
                            <span id="showGalleryCountCurrent">1</span>
                            <span>/</span>
                            <span>{{ $imagePaths->count() }}</span>
                        </div>
                    @endif
                </div>
            @else
                <div class="show-gallery__empty">{{ __('public.cars.no_image_available') }}</div>
            @endif

            @if ($car->status === 'reserved' || $car->status === 'sold')
                <div class="car-ribbon-layer" aria-hidden="true">
                    <div class="car-ribbon car-ribbon--{{ $car->status }}">{{ $car->cardStatusLabel() }}</div>
                </div>
            @endif
        </div>
    </section>

    @if ($imagePaths->count() > 1)
        <div class="show-thumbnails" id="showGalleryThumbs">
            @foreach ($imagePaths as $imagePath)
                <button
                    type="button"
                    class="show-thumb @if ($loop->first) active @endif"
                    data-bs-target="#{{ $mainCarouselId }}"
                    data-bs-slide-to="{{ $loop->index }}"
                    data-image-index="{{ $loop->index }}"
                    aria-label="{{ __('public.cars.show_image', ['number' => $loop->iteration]) }}"
                >
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                        alt="{{ $car->title }} {{ __('public.cars.photos') }} {{ $loop->iteration }}"
                        loading="lazy"
                        decoding="async"
                    >
                </button>
            @endforeach
        </div>
    @endif

    {{-- ================= Spec chips + CTAs ================= --}}
    <section class="show-info">
        <div class="show-info__status-row">
            <span class="badge {{ $car->cardStatusBadgeClass() }} rounded-pill show-info__status">{{ $car->cardStatusLabel() }}</span>
        </div>

        <ul class="show-chips">
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M4 9a5 5 0 1 1 10 0A5 5 0 0 1 4 9zm5-8a.5.5 0 0 1 .5.5V3h2a.5.5 0 0 1 .5.5V4a6 6 0 1 1-6 0v-.5a.5.5 0 0 1 .5-.5h2V1.5A.5.5 0 0 1 9 1z"/></svg>
                <span><span class="show-chips__label">{{ __('public.cars.mileage') }}</span>{{ $car->cardMileageText() }}</span>
            </li>
            @if ($carFuel)
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M3 2.5A1.5 1.5 0 0 1 4.5 1h6A1.5 1.5 0 0 1 12 2.5V14h.5a.5.5 0 0 1 0 1h-10a.5.5 0 0 1 0-1H3V2.5zm1 12h7V2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0-.5.5v12zm9.5-6.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V10a.5.5 0 0 1-.5-.5V8h1zm-.5-3.5a.5.5 0 0 1 .5-.5H14a.5.5 0 0 1 .5.5v3h-1V4.5z"/></svg>
                    <span><span class="show-chips__label">{{ __('public.cars.fuel') }}</span>{{ $carFuel }}</span>
                </li>
            @endif
            @if ($carTransmission)
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M8 1a.5.5 0 0 1 .5.5V6h3.5a.5.5 0 0 1 0 1H8.5v7.5a.5.5 0 0 1-1 0V7H4a.5.5 0 0 1 0-1h3.5V1.5A.5.5 0 0 1 8 1z"/><path d="M4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm11 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM4 12.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm11 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/></svg>
                    <span><span class="show-chips__label">{{ __('public.cars.transmission') }}</span>{{ $carTransmission }}</span>
                </li>
            @endif
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                <span><span class="show-chips__label">{{ __('public.cars.year') }}</span>{{ $car->year }}</span>
            </li>
        </ul>

        <div class="show-cta-row">
            @include('public.partials.phone-cta', ['variant' => 'button-primary', 'label' => __('public.buttons.call_now')])
            @if ($car->status === 'sold')
                <a href="{{ $publicDedicatedCarsPageEnabled ? route('cars.index') : route('home') }}" class="btn btn-brand-outline">{{ __('public.buttons.ask_similar') }}</a>
            @else
                <a href="#enquiry-form" class="btn btn-brand-outline">{{ __('public.forms.send_enquiry') }}</a>
            @endif
        </div>
    </section>

    {{-- ================= Vehicle details ================= --}}
    <section class="show-section">
        <h2 class="show-section__title">{{ __('public.cars.vehicle_details') }}</h2>
        <ul class="show-details-list">
            <li class="show-details-list__item">
                <span class="show-details-list__label">{{ __('public.cars.make') }}</span>
                <span class="show-details-list__value">{{ $car->make ?: __('public.fallback.na') }}</span>
            </li>
            <li class="show-details-list__item">
                <span class="show-details-list__label">{{ __('public.cars.model') }}</span>
                <span class="show-details-list__value">{{ $car->model ?: __('public.fallback.na') }}</span>
            </li>
            <li class="show-details-list__item">
                <span class="show-details-list__label">{{ __('public.cars.year') }}</span>
                <span class="show-details-list__value">{{ $car->year ?: __('public.fallback.na') }}</span>
            </li>
            <li class="show-details-list__item">
                <span class="show-details-list__label">{{ __('public.cars.mileage') }}</span>
                <span class="show-details-list__value">{{ $car->cardMileageText() }}</span>
            </li>
            <li class="show-details-list__item">
                <span class="show-details-list__label">{{ __('public.cars.fuel') }}</span>
                <span class="show-details-list__value">{{ $carFuel ?: __('public.fallback.na') }}</span>
            </li>
            <li class="show-details-list__item">
                <span class="show-details-list__label">{{ __('public.cars.transmission') }}</span>
                <span class="show-details-list__value">{{ $carTransmission ?: __('public.fallback.na') }}</span>
            </li>
            <li class="show-details-list__item">
                <span class="show-details-list__label">{{ __('public.cars.colour') }}</span>
                <span class="show-details-list__value">{{ $carColour ?: __('public.fallback.na') }}</span>
            </li>
            @if ($carLocation)
                <li class="show-details-list__item">
                    <span class="show-details-list__label">{{ __('public.cars.location') }}</span>
                    <span class="show-details-list__value">{{ $carLocation }}</span>
                </li>
            @endif
            <li class="show-details-list__item">
                <span class="show-details-list__label">{{ __('public.cars.status') }}</span>
                <span class="show-details-list__value">{{ $car->cardStatusLabel() }}</span>
            </li>
        </ul>
    </section>

    {{-- ================= Features ================= --}}
    <section class="show-section">
        <h2 class="show-section__title">{{ __('public.cars.features') }}</h2>
        @if ($car->description)
            <p class="show-description">{{ $car->description }}</p>
        @else
            <p class="show-description show-description--muted mb-0">{{ __('public.cars.no_description') }}</p>
        @endif
    </section>

    {{-- ================= Enquiry form ================= --}}
    <section id="enquiry-form" class="show-section show-enquiry">
        <div class="show-enquiry__header">
            @if ($car->status === 'sold')
                <p class="text-uppercase small text-brand-gold fw-semibold mb-1" style="letter-spacing: 0.1em;">{{ __('public.cars.sold_eyebrow') }}</p>
                <h2 class="h4 mb-1">{{ __('public.cars.sold_title') }}</h2>
                <p class="brand-muted mb-0">{{ __('public.cars.sold_text') }}</p>
            @elseif ($car->status === 'reserved')
                <p class="text-uppercase small text-brand-gold fw-semibold mb-1" style="letter-spacing: 0.1em;">{{ __('public.cars.reserved_eyebrow') }}</p>
                <h2 class="h4 mb-1">{{ __('public.cars.reserved_title') }}</h2>
                <p class="brand-muted mb-0">{{ __('public.cars.reserved_text') }}</p>
            @else
                <p class="text-uppercase small text-brand-gold fw-semibold mb-1" style="letter-spacing: 0.1em;">{{ __('public.cars.available_eyebrow') }}</p>
                <h2 class="h4 mb-1">{{ __('public.cars.available_title') }}</h2>
                <p class="brand-muted mb-0">{{ __('public.cars.available_text') }}</p>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <p class="mb-2">{{ __('public.forms.errors_heading') }}</p>
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
                    <label for="name" class="form-label">{{ __('public.forms.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">{{ __('public.forms.email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">{{ __('public.forms.phone_optional') }}</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                </div>

                <div class="col-12">
                    <label for="message" class="form-label">{{ __('public.forms.message') }}</label>
                    <textarea name="message" id="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-brand-primary mt-3">{{ __('public.forms.send_enquiry') }}</button>
        </form>
    </section>

    {{-- ================= Contact fallback ================= --}}
    <div class="show-contact-card">
        <p class="text-uppercase small text-brand-gold fw-semibold mb-2" style="letter-spacing: 0.1em;">{{ __('public.cars.fast_response') }}</p>
        <h2 class="h5 mb-2">{{ __('public.cars.sales_team') }}</h2>
        <p class="brand-muted mb-2">
            @include('public.partials.phone-cta', ['variant' => 'inline-link'])
            <span class="mx-1 opacity-50">·</span>
            <a href="{{ $publicEmailMailto }}" class="footer-link fw-semibold">{{ $publicEmailDisplay }}</a>
        </p>
    </div>

    {{-- ================= Lightbox ================= --}}
    @if ($imagePaths->isNotEmpty())
        <div class="modal fade" id="carImageLightboxModal" tabindex="-1" aria-labelledby="carImageLightboxModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content bg-black">
                    <div class="modal-header border-0">
                        <h2 class="visually-hidden" id="carImageLightboxModalLabel">{{ __('public.cars.gallery_title') }}</h2>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="{{ __('public.cars.close') }}"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center pt-0">
                        <div id="{{ $lightboxCarouselId }}" class="carousel slide w-100" data-bs-ride="false" data-bs-interval="false">
                            <div class="carousel-inner">
                                @foreach ($imagePaths as $imagePath)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                            class="d-block mx-auto"
                                            alt="{{ $car->title }} {{ __('public.cars.photos') }} {{ $loop->iteration }}"
                                            loading="lazy"
                                            decoding="async"
                                            style="max-height: 85vh; max-width: 100%; object-fit: contain;"
                                        >
                                    </div>
                                @endforeach
                            </div>

                            @if ($imagePaths->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#{{ $lightboxCarouselId }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">{{ __('public.cars.previous') }}</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#{{ $lightboxCarouselId }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">{{ __('public.cars.next') }}</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var mainCarouselEl = document.getElementById('{{ $mainCarouselId }}');
                var lightboxModalEl = document.getElementById('carImageLightboxModal');
                var lightboxCarouselEl = document.getElementById('{{ $lightboxCarouselId }}');
                var thumbsWrap = document.getElementById('showGalleryThumbs');
                var countCurrentEl = document.getElementById('showGalleryCountCurrent');

                if (!mainCarouselEl) {
                    return;
                }

                var mainCarousel = bootstrap.Carousel.getOrCreateInstance(mainCarouselEl, {
                    interval: false,
                    ride: false,
                    touch: true
                });
                var lightboxModal = lightboxModalEl ? new bootstrap.Modal(lightboxModalEl) : null;
                var lightboxCarousel = lightboxCarouselEl ? bootstrap.Carousel.getOrCreateInstance(lightboxCarouselEl, {
                    interval: false,
                    ride: false
                }) : null;

                function syncThumbnails(activeIndex) {
                    if (!thumbsWrap) {
                        return;
                    }
                    var buttons = thumbsWrap.querySelectorAll('.show-thumb');
                    buttons.forEach(function (btn) {
                        var idx = parseInt(btn.getAttribute('data-image-index'), 10);
                        btn.classList.toggle('active', idx === activeIndex);
                    });
                }

                mainCarouselEl.addEventListener('slid.bs.carousel', function (event) {
                    var idx = typeof event.to === 'number' ? event.to : 0;
                    syncThumbnails(idx);
                    if (countCurrentEl) {
                        countCurrentEl.textContent = String(idx + 1);
                    }
                });

                var openLightboxImages = mainCarouselEl.querySelectorAll('.js-open-lightbox');
                openLightboxImages.forEach(function (img) {
                    img.addEventListener('click', function () {
                        if (!lightboxModal || !lightboxCarousel) {
                            return;
                        }
                        var activeItem = mainCarouselEl.querySelector('.carousel-item.active img.js-open-lightbox');
                        var currentIndex = 0;
                        if (activeItem) {
                            currentIndex = parseInt(activeItem.getAttribute('data-image-index'), 10) || 0;
                        }
                        lightboxCarousel.to(currentIndex);
                        lightboxModal.show();
                    });
                });
            });
        </script>
    @endif
    </div>
@endsection
