@extends('layouts.public')

@section('title', $car->title . ' - ACPC Autos')

@section('content')
    <style>
        .page-cars-show {
            --show-surface: var(--brand-surface);
            --show-surface-alt: var(--brand-surface-alt);
            --show-border: var(--brand-border);
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
            border: 1px solid var(--show-border);
            border-radius: 1.1rem;
            overflow: hidden;
            background: var(--show-surface-alt);
            box-shadow: 0 6px 22px rgba(15, 24, 18, 0.08);
        }

        .page-cars-show .show-gallery__media {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            max-height: 620px;
            background: var(--show-surface-alt);
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
            color: var(--brand-muted-text);
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
            padding: 0;
            top: 50%;
            bottom: auto;
            transform: translateY(-50%);
            pointer-events: auto;
        }

        .page-cars-show .show-gallery .carousel-control-prev {
            left: clamp(0.75rem, 2vw, 1.25rem);
            right: auto;
        }

        .page-cars-show .show-gallery .carousel-control-next {
            right: clamp(0.75rem, 2vw, 1.25rem);
            left: auto;
        }

        .page-cars-show .show-gallery .carousel-control-prev-icon,
        .page-cars-show .show-gallery .carousel-control-next-icon {
            width: clamp(2.85rem, 4.6vw, 3.45rem);
            height: clamp(2.85rem, 4.6vw, 3.45rem);
            padding: 0;
            /* Chevron scales with the circle — fills most of the button for visibility */
            background-size: 58% 58%;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #1f4d2e;
            border: 1px solid rgba(212, 175, 55, 0.55);
            border-radius: 999px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(0, 0, 0, 0.15);
            transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease, border-color 0.2s ease;
        }

        .page-cars-show .show-gallery .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23d4af37'%3E%3Cpath fill-rule='evenodd' d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3E%3C/svg%3E");
        }

        .page-cars-show .show-gallery .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23d4af37'%3E%3Cpath fill-rule='evenodd' d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        }

        .page-cars-show .show-gallery .carousel-control-prev:hover .carousel-control-prev-icon,
        .page-cars-show .show-gallery .carousel-control-next:hover .carousel-control-next-icon,
        .page-cars-show .show-gallery .carousel-control-prev:focus-visible .carousel-control-prev-icon,
        .page-cars-show .show-gallery .carousel-control-next:focus-visible .carousel-control-next-icon {
            background-color: #2a6b41;
            border-color: rgba(212, 175, 55, 0.9);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.4), 0 0 0 2px rgba(212, 175, 55, 0.25);
            transform: scale(1.05);
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
            border-color: rgba(185, 145, 70, 0.35);
        }

        .page-cars-show .show-thumb.active {
            border-color: var(--brand-gold);
            box-shadow: 0 0 0 1px rgba(185, 145, 70, 0.4);
        }

        /* -------- Main info band (title / price / specs / CTAs) -------- */
        .page-cars-show .show-info {
            background: var(--show-surface);
            border: 1px solid var(--show-border);
            border-radius: 1rem;
            padding: 1.35rem 1.35rem 1.2rem;
            box-shadow: 0 4px 16px rgba(15, 24, 18, 0.06);
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
            border-bottom: 1px solid var(--show-border);
            list-style: none;
        }

        .page-cars-show .show-chips li {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            color: var(--brand-text);
            font-size: 0.9rem;
            font-weight: 500;
            line-height: 1.1;
        }

        .page-cars-show .show-chips svg {
            width: 1rem;
            height: 1rem;
            color: var(--brand-gold);
            opacity: 0.88;
            flex-shrink: 0;
        }

        .page-cars-show .show-chips__label {
            color: var(--brand-muted-text);
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
            background: var(--show-surface);
            border: 1px solid var(--show-border);
            border-radius: 1rem;
            padding: 1.4rem 1.4rem 1.3rem;
            box-shadow: 0 4px 16px rgba(15, 24, 18, 0.06);
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
            color: var(--brand-text);
            margin: 0 0 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
        }

        .page-cars-show .show-section__title::before {
            content: "";
            width: 1.6rem;
            height: 2px;
            background: var(--brand-gold);
            opacity: 0.85;
            border-radius: 2px;
        }

        .page-cars-show .show-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 0.75rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .page-cars-show .show-details-grid li {
            display: block;
            padding: 0.7rem 0.85rem;
            background: var(--show-surface-alt);
            border: 1px solid var(--show-border);
            border-radius: 0.6rem;
        }

        .page-cars-show .show-details-grid__label {
            display: block;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--brand-muted-text);
            margin-bottom: 0.25rem;
        }

        .page-cars-show .show-details-grid__value {
            font-size: 0.97rem;
            font-weight: 600;
            color: var(--brand-text);
            line-height: 1.25;
        }

        .page-cars-show .show-description {
            color: var(--brand-text);
            font-size: 0.98rem;
            line-height: 1.65;
            margin: 0;
            white-space: pre-line;
        }

        .page-cars-show .show-description--muted {
            color: var(--brand-muted-text);
        }

        /* -------- Enquiry + call-out sections -------- */
        .page-cars-show .show-enquiry {
            scroll-margin-top: 5.5rem;
        }

        .page-cars-show .show-enquiry__header {
            margin-bottom: 1rem;
        }

        .page-cars-show .show-contact-card {
            background: var(--show-surface);
            border: 1px solid var(--show-border);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 16px rgba(15, 24, 18, 0.06);
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
    @endphp

    <section class="show-back">
        <a href="{{ route('cars.index') }}" class="btn btn-brand-outline btn-sm">&larr; Back to Cars</a>
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
                                    alt="{{ $car->title }} image {{ $loop->iteration }}"
                                    class="show-gallery__image js-open-lightbox"
                                    data-image-index="{{ $loop->index }}"
                                    loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                    decoding="async"
                                >
                            </div>
                        @endforeach
                    </div>

                    @if ($imagePaths->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $mainCarouselId }}" data-bs-slide="prev" aria-label="Previous image">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#{{ $mainCarouselId }}" data-bs-slide="next" aria-label="Next image">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <div class="show-gallery__count" aria-label="{{ $imagePaths->count() }} photos">
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
                <div class="show-gallery__empty">No image available</div>
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
                    aria-label="Show image {{ $loop->iteration }}"
                >
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                        alt="{{ $car->title }} thumbnail {{ $loop->iteration }}"
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
                <span><span class="show-chips__label">Mileage</span>{{ $car->cardMileageText() }}</span>
            </li>
            @if ($carFuel)
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M3 2.5A1.5 1.5 0 0 1 4.5 1h6A1.5 1.5 0 0 1 12 2.5V14h.5a.5.5 0 0 1 0 1h-10a.5.5 0 0 1 0-1H3V2.5zm1 12h7V2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0-.5.5v12zm9.5-6.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V10a.5.5 0 0 1-.5-.5V8h1zm-.5-3.5a.5.5 0 0 1 .5-.5H14a.5.5 0 0 1 .5.5v3h-1V4.5z"/></svg>
                    <span><span class="show-chips__label">Fuel</span>{{ $carFuel }}</span>
                </li>
            @endif
            @if ($carTransmission)
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M8 1a.5.5 0 0 1 .5.5V6h3.5a.5.5 0 0 1 0 1H8.5v7.5a.5.5 0 0 1-1 0V7H4a.5.5 0 0 1 0-1h3.5V1.5A.5.5 0 0 1 8 1z"/><path d="M4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm11 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM4 12.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm11 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/></svg>
                    <span><span class="show-chips__label">Transmission</span>{{ $carTransmission }}</span>
                </li>
            @endif
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                <span><span class="show-chips__label">Year</span>{{ $car->year }}</span>
            </li>
        </ul>

        <div class="show-cta-row">
            @include('public.partials.phone-cta', ['variant' => 'button-primary', 'label' => 'Call now'])
            @if ($car->status === 'sold')
                <a href="{{ route('cars.index') }}" class="btn btn-brand-outline">Ask about similar vehicles</a>
            @else
                <a href="#enquiry-form" class="btn btn-brand-outline">Send enquiry</a>
            @endif
        </div>
    </section>

    {{-- ================= Vehicle details ================= --}}
    <section class="show-section">
        <h2 class="show-section__title">Vehicle Details</h2>
        <ul class="show-details-grid">
            <li>
                <span class="show-details-grid__label">Make</span>
                <span class="show-details-grid__value">{{ $car->make ?: 'N/A' }}</span>
            </li>
            <li>
                <span class="show-details-grid__label">Model</span>
                <span class="show-details-grid__value">{{ $car->model ?: 'N/A' }}</span>
            </li>
            <li>
                <span class="show-details-grid__label">Year</span>
                <span class="show-details-grid__value">{{ $car->year ?: 'N/A' }}</span>
            </li>
            <li>
                <span class="show-details-grid__label">Mileage</span>
                <span class="show-details-grid__value">{{ $car->cardMileageText() }}</span>
            </li>
            <li>
                <span class="show-details-grid__label">Fuel</span>
                <span class="show-details-grid__value">{{ $carFuel ?: 'N/A' }}</span>
            </li>
            <li>
                <span class="show-details-grid__label">Transmission</span>
                <span class="show-details-grid__value">{{ $carTransmission ?: 'N/A' }}</span>
            </li>
            <li>
                <span class="show-details-grid__label">Colour</span>
                <span class="show-details-grid__value">{{ $carColour ?: 'N/A' }}</span>
            </li>
            @if ($carLocation)
                <li>
                    <span class="show-details-grid__label">Location</span>
                    <span class="show-details-grid__value">{{ $carLocation }}</span>
                </li>
            @endif
            <li>
                <span class="show-details-grid__label">Status</span>
                <span class="show-details-grid__value">{{ $car->cardStatusLabel() }}</span>
            </li>
        </ul>
    </section>

    {{-- ================= Features ================= --}}
    <section class="show-section">
        <h2 class="show-section__title">Features</h2>
        @if ($car->description)
            <p class="show-description">{{ $car->description }}</p>
        @else
            <p class="show-description show-description--muted mb-0">No description provided.</p>
        @endif
    </section>

    {{-- ================= Enquiry form ================= --}}
    <section id="enquiry-form" class="show-section show-enquiry">
        <div class="show-enquiry__header">
            @if ($car->status === 'sold')
                <p class="text-uppercase small text-brand-gold fw-semibold mb-1" style="letter-spacing: 0.1em;">Looking for something similar?</p>
                <h2 class="h4 mb-1">Ask about similar vehicles</h2>
                <p class="brand-muted mb-0">This vehicle has been sold. Tell us what you're looking for and our team will be in touch with similar stock.</p>
            @elseif ($car->status === 'reserved')
                <p class="text-uppercase small text-brand-gold fw-semibold mb-1" style="letter-spacing: 0.1em;">Currently reserved</p>
                <h2 class="h4 mb-1">Register your interest</h2>
                <p class="brand-muted mb-0">This vehicle is reserved. Leave your details and we'll let you know if it becomes available again.</p>
            @else
                <p class="text-uppercase small text-brand-gold fw-semibold mb-1" style="letter-spacing: 0.1em;">Interested in this car?</p>
                <h2 class="h4 mb-1">Send an enquiry</h2>
                <p class="brand-muted mb-0">Leave your details and our team will get back to you quickly.</p>
            @endif
        </div>

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

            <button type="submit" class="btn btn-brand-primary mt-3">Send enquiry</button>
        </form>
    </section>

    {{-- ================= Contact fallback ================= --}}
    <div class="show-contact-card">
        <p class="text-uppercase small text-brand-gold fw-semibold mb-2" style="letter-spacing: 0.1em;">Need a faster response?</p>
        <h2 class="h5 mb-2">Call or email our sales team today</h2>
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
                        <h2 class="visually-hidden" id="carImageLightboxModalLabel">Car image gallery</h2>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center pt-0">
                        <div id="{{ $lightboxCarouselId }}" class="carousel slide w-100" data-bs-ride="false" data-bs-interval="false">
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
                                <button class="carousel-control-prev" type="button" data-bs-target="#{{ $lightboxCarouselId }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#{{ $lightboxCarouselId }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
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
