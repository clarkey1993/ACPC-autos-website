<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoTitle = trim($__env->yieldContent('title', 'ACPC Autos'));
        $seoDescription = trim($__env->yieldContent('meta_description', 'Premium used cars for sale in Malaga. Explore hand-picked vehicles and contact ACPC Autos for viewings and enquiries.'));
        $seoCanonical = trim($__env->yieldContent('canonical_url', url()->current()));
        $seoOgImage = trim($__env->yieldContent('og_image', asset('images/logo-full.png')));
        $seoOgType = trim($__env->yieldContent('og_type', 'website'));
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">
    <link rel="canonical" href="{{ $seoCanonical }}">

    <meta property="og:site_name" content="ACPC Autos">
    <meta property="og:locale" content="en_GB">
    <meta property="og:type" content="{{ $seoOgType }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoOgImage }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoOgImage }}">
    <meta name="twitter:url" content="{{ $seoCanonical }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            color-scheme: light dark;
            --brand-primary: #2f5e3a;
            --brand-dark: #1e3327;
            --brand-deep: #14361f;
            --brand-gold: #b99146;
            --brand-gold-light: #d5b77a;
            --brand-bg: #f6f4ef;
            --brand-surface: #fffdf9;
            --brand-surface-alt: #f5f1e8;
            --brand-text: #1f2420;
            --brand-muted-text: #667168;
            --brand-border: rgba(24, 36, 28, 0.1);
            --brand-gold-border: rgba(185, 145, 70, 0.28);
            --brand-navbar-bg: #18452d;
            --brand-navbar-link: #f5f1e8;
            --brand-footer-bg: #18452d;
            --brand-footer-text: #e8e1cf;
            --brand-footer-link: #f5f1e8;
            --brand-panel-bg: linear-gradient(165deg, #1d4f35 0%, #18452d 55%, #143c28 100%);
            --brand-panel-bg-soft: linear-gradient(155deg, #235a3f 0%, #1d4f35 55%, #18452d 100%);
            --brand-panel-border: rgba(185, 145, 70, 0.22);
            --brand-panel-border-strong: rgba(213, 183, 122, 0.38);
            --brand-panel-text: #f5f1e8;
            --brand-panel-muted: #c4bba5;
            --brand-panel-media-bg: #0d2a1a;
            --brand-panel-shadow: 0 10px 26px rgba(10, 28, 18, 0.32);
            --brand-panel-shadow-hover: 0 14px 32px rgba(10, 28, 18, 0.44);
            --brand-card-shadow: 0 10px 24px rgba(14, 22, 17, 0.08);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --brand-primary: #2f5e3a;
                --brand-dark: #1e3327;
                --brand-deep: #0f2c1b;
                --brand-gold: #c9a45c;
                --brand-gold-light: #e0c98a;
                --brand-bg: #101418;
                --brand-surface: #1d252c;
                --brand-surface-alt: #1e252b;
                --brand-text: #f5f1e8;
                --brand-muted-text: #c7bfae;
                --brand-border: rgba(201, 164, 92, 0.3);
                --brand-gold-border: rgba(224, 201, 138, 0.3);
                --brand-navbar-bg: #143c28;
                --brand-navbar-link: #f5f1e8;
                --brand-footer-bg: #143c28;
                --brand-footer-text: #d4cbb7;
                --brand-footer-link: #f0e9d6;
                --brand-panel-bg: linear-gradient(165deg, #18452d 0%, #143c28 55%, #0f331f 100%);
                --brand-panel-bg-soft: linear-gradient(155deg, #1d4f35 0%, #18452d 55%, #143c28 100%);
                --brand-panel-border: rgba(201, 164, 92, 0.25);
                --brand-panel-border-strong: rgba(224, 201, 138, 0.4);
                --brand-panel-text: #f5f1e8;
                --brand-panel-muted: #c7bfae;
                --brand-panel-media-bg: #0b2218;
                --brand-panel-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
                --brand-panel-shadow-hover: 0 16px 38px rgba(0, 0, 0, 0.5);
                --brand-card-shadow: 0 10px 28px rgba(0, 0, 0, 0.34);
            }
        }

        body {
            background-color: var(--brand-bg);
            color: var(--brand-text);
        }

        main.py-5 {
            padding-bottom: 5rem;
        }

        .navbar-public {
            background-color: var(--brand-navbar-bg);
            border-bottom: 1px solid var(--brand-gold-border);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.25);
            position: relative;
        }

        .navbar-public .navbar-top-row {
            min-height: 3.25rem;
        }

        .navbar-public .navbar-toggler {
            border-color: var(--brand-gold-border);
            padding: 0.35rem 0.55rem;
        }

        .navbar-public .navbar-toggler:focus {
            box-shadow: 0 0 0 0.18rem rgba(185, 145, 70, 0.35);
        }

        .navbar-public .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(245, 241, 232, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .brand-logo {
            width: auto;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            object-position: center;
            vertical-align: middle;
            flex-shrink: 0;
            transform-origin: center center;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .brand-logo--navbar {
            height: clamp(2.5rem, 8.5vw, 7rem);
            width: auto;
            max-height: 7.25rem;
            display: block;
            position: absolute;
            right: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-right: clamp(-1.4rem, -1.4vw, -0.7rem);
            pointer-events: none;
        }

        .navbar-public .navbar-brand.brand-logo-link {
            display: inline-flex;
            align-items: center;
            line-height: 1;
            z-index: 3;
            position: relative;
        }

        .navbar-brand-name {
            font-size: clamp(1.45rem, 4.6vw, 3.1rem);
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            line-height: 1.05;
            align-self: center;
            white-space: nowrap;
        }

        @media (min-width: 768px) {
            .navbar-brand-name {
                letter-spacing: 0.1em;
            }
        }

        .brand-logo-link {
            text-decoration: none;
            color: inherit;
        }

        .brand-logo-link:hover .brand-logo,
        .brand-logo-link:focus-visible .brand-logo {
            transform: scale(1.03);
        }

        .brand-logo-link:hover .brand-logo--navbar,
        .brand-logo-link:focus-visible .brand-logo--navbar {
            transform: translateY(-50%) scale(1.03);
        }

        .brand-logo-link:focus-visible {
            outline: 2px solid var(--brand-gold);
            outline-offset: 3px;
            border-radius: 0.25rem;
        }

        .brand-logo--footer {
            height: clamp(44px, 5vw, 56px);
            width: auto;
        }

        .brand-logo--navbar,
        .brand-logo--footer {
            filter: brightness(1.08) contrast(1.04);
        }

        .brand-card {
            background-color: var(--brand-surface);
            border: 1px solid var(--brand-border);
            color: var(--brand-text);
            box-shadow: var(--brand-card-shadow);
        }

        .hero-shell {
            background: linear-gradient(135deg, rgba(244, 239, 226, 0.98), rgba(255, 255, 255, 1));
            border: 1px solid var(--brand-gold-border);
        }

        @media (prefers-color-scheme: dark) {
            .hero-shell {
                background: linear-gradient(135deg, rgba(30, 51, 39, 0.96), rgba(17, 22, 26, 0.98));
            }
        }

        .brand-muted {
            color: var(--brand-muted-text) !important;
        }

        .btn-brand-primary {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
            color: #f7f5ef;
            min-height: 42px;
            padding: 0.6rem 1.1rem;
            font-weight: 600;
            line-height: 1.2;
            transition: all 0.2s ease;
        }

        .btn-brand-primary:hover,
        .btn-brand-primary:focus {
            background-color: var(--brand-dark);
            border-color: var(--brand-dark);
            color: #f7f5ef;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(30, 51, 39, 0.24);
        }

        .btn-brand-outline {
            border-color: var(--brand-gold);
            color: var(--brand-gold);
            background-color: transparent;
            min-height: 42px;
            padding: 0.6rem 1.1rem;
            font-weight: 600;
            line-height: 1.2;
            transition: all 0.2s ease;
        }

        .btn-brand-outline:hover,
        .btn-brand-outline:focus {
            background-color: var(--brand-gold);
            border-color: var(--brand-gold);
            color: #1b1f22;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(185, 145, 70, 0.24);
        }

        .text-brand-gold {
            color: var(--brand-gold-light) !important;
        }

        .badge-brand {
            background-color: var(--brand-primary);
            color: #f7f5ef;
        }

        /* ============================================================
           Shared dark-green brand panel system
           ------------------------------------------------------------
           Applied to any main content card across the public site so the
           whole site feels unified with the header/footer palette. New
           pages can just use class "brand-dark-panel" or the per-page
           class is remapped onto these tokens.
        ============================================================ */
        .brand-dark-panel,
        .page-about .about-panel,
        .page-contact .contact-shell,
        .page-cars-show .show-info,
        .page-cars-show .show-section,
        .page-cars-show .show-contact-card {
            background: var(--brand-panel-bg);
            border: 1px solid var(--brand-panel-border);
            color: var(--brand-panel-text);
            box-shadow: var(--brand-panel-shadow);
        }

        .brand-dark-panel-soft,
        .page-about .about-hero,
        .page-contact .contact-hero,
        .page-cars-show .show-gallery {
            background: var(--brand-panel-bg-soft);
            border: 1px solid var(--brand-panel-border);
            color: var(--brand-panel-text);
            box-shadow: var(--brand-panel-shadow);
        }

        .brand-dark-panel h1,
        .brand-dark-panel h2,
        .brand-dark-panel h3,
        .brand-dark-panel h4,
        .brand-dark-panel h5,
        .brand-dark-panel h6,
        .brand-dark-panel-soft h1,
        .brand-dark-panel-soft h2,
        .brand-dark-panel-soft h3,
        .brand-dark-panel-soft h4,
        .brand-dark-panel-soft h5,
        .brand-dark-panel-soft h6,
        .page-about .about-panel h1,
        .page-about .about-panel h2,
        .page-about .about-panel h3,
        .page-about .about-panel h4,
        .page-about .about-panel h5,
        .page-about .about-panel h6,
        .page-about .about-hero h1,
        .page-about .about-hero h2,
        .page-about .about-hero h3,
        .page-contact .contact-shell h1,
        .page-contact .contact-shell h2,
        .page-contact .contact-shell h3,
        .page-contact .contact-shell h4,
        .page-contact .contact-hero h1,
        .page-contact .contact-hero h2,
        .page-contact .contact-hero h3,
        .page-cars-show .show-info h1,
        .page-cars-show .show-info h2,
        .page-cars-show .show-info h3,
        .page-cars-show .show-section h1,
        .page-cars-show .show-section h2,
        .page-cars-show .show-section h3,
        .page-cars-show .show-contact-card h1,
        .page-cars-show .show-contact-card h2,
        .page-cars-show .show-contact-card h3 {
            color: var(--brand-panel-text);
        }

        .brand-dark-panel .brand-muted,
        .brand-dark-panel-soft .brand-muted,
        .page-about .about-panel .brand-muted,
        .page-about .about-hero .brand-muted,
        .page-contact .contact-shell .brand-muted,
        .page-contact .contact-hero .brand-muted,
        .page-cars-show .show-info .brand-muted,
        .page-cars-show .show-section .brand-muted,
        .page-cars-show .show-contact-card .brand-muted {
            color: var(--brand-panel-muted) !important;
        }

        .brand-dark-panel .text-brand-gold,
        .brand-dark-panel-soft .text-brand-gold,
        .page-about .about-panel .text-brand-gold,
        .page-about .about-hero .text-brand-gold,
        .page-contact .contact-shell .text-brand-gold,
        .page-contact .contact-hero .text-brand-gold,
        .page-cars-show .show-info .text-brand-gold,
        .page-cars-show .show-section .text-brand-gold,
        .page-cars-show .show-contact-card .text-brand-gold {
            color: var(--brand-gold-light) !important;
        }

        .footer-public {
            border-top: 1px solid var(--brand-gold-border);
            color: var(--brand-footer-text);
            background-color: var(--brand-footer-bg);
            box-shadow: inset 0 1px 0 rgba(185, 145, 70, 0.12);
        }

        .footer-public .text-brand-gold {
            color: var(--brand-gold-light) !important;
        }

        .footer-public .border-top.border-secondary-subtle {
            border-color: var(--brand-gold-border) !important;
        }

        .footer-link {
            color: var(--brand-footer-link);
            text-decoration: none;
            transition: color 0.18s ease;
        }

        .footer-link:hover,
        .footer-link:focus {
            color: var(--brand-gold-light);
            text-decoration: underline;
        }

        .section-title {
            letter-spacing: 0.02em;
        }

        .stock-image {
            height: 240px;
            object-fit: cover;
        }

        .pagination .page-link {
            background-color: var(--brand-surface);
            border-color: var(--brand-border);
            color: var(--brand-text);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
            color: #f7f5ef;
        }

        .form-control,
        .form-select,
        .form-control:focus,
        .form-select:focus {
            background-color: var(--brand-surface);
            color: var(--brand-text);
            border-color: var(--brand-border);
        }

        .form-control::placeholder {
            color: color-mix(in srgb, var(--brand-muted-text) 75%, transparent);
        }

        .nav-link-public {
            color: var(--brand-navbar-link) !important;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-size: 0.82rem;
            padding-left: 0.85rem !important;
            padding-right: 0.85rem !important;
            transition: color 0.18s ease;
        }

        .nav-link-public:hover,
        .nav-link-public:focus {
            color: var(--brand-gold-light) !important;
        }

        @media (min-width: 992px) {
            .navbar-public .navbar-nav {
                gap: 0.5rem !important;
            }

            .navbar-public .navbar-collapse {
                border-top: 1px solid var(--brand-gold-border);
                padding-top: 0.35rem;
            }
        }

        @media (max-width: 991.98px) {
            .navbar-public .navbar-collapse {
                padding-top: 0.5rem;
            }

            .navbar-public .navbar-nav {
                gap: 0.1rem;
            }
        }

        .whatsapp-float {
            position: fixed;
            right: max(1rem, env(safe-area-inset-right, 0px));
            bottom: max(1rem, env(safe-area-inset-bottom, 0px));
            z-index: 1040;
            width: 3.375rem;
            height: 3.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #25d366;
            color: #fff;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .whatsapp-float:hover,
        .whatsapp-float:focus {
            background-color: #1ebe5d;
            color: #fff;
            transform: scale(1.04);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }

        .whatsapp-float:focus-visible {
            outline: 2px solid var(--brand-gold-light);
            outline-offset: 3px;
        }

        @media (prefers-color-scheme: dark) {
            .whatsapp-float {
                box-shadow: 0 4px 18px rgba(0, 0, 0, 0.45);
            }
        }

        .car-card-status {
            font-size: 0.65rem;
            letter-spacing: 0.05em;
        }

        .price-highlight {
            color: var(--brand-gold);
            font-weight: 700;
            font-size: clamp(1.3rem, 2.1vw, 1.6rem);
            margin-top: 0.35rem;
            margin-bottom: 0.7rem;
            letter-spacing: 0.01em;
        }

        /* Responsive phone CTA — desktop shows number as a styled, non-clickable box/text */
        .phone-cta-static {
            cursor: default;
            pointer-events: none;
            transform: none !important;
            box-shadow: none !important;
            user-select: text;
        }

        .phone-cta-static:hover,
        .phone-cta-static:focus {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
            color: #f7f5ef;
            transform: none !important;
            box-shadow: none !important;
        }

        .phone-static-inline {
            color: var(--brand-footer-link);
            user-select: text;
        }

        /**
         * Clickable card behaviour — works in both light and dark mode.
         * The whole `.car-inventory-card` is clickable via a `.stretched-link` on the
         * "View details" button. Carousel controls and the image-count overlay sit
         * above the stretched-link's ::after so they continue to work.
         */
        .car-inventory-card[data-card-link] {
            cursor: pointer;
        }

        .car-inventory-card[data-card-link]:focus-visible {
            outline: 2px solid var(--brand-gold);
            outline-offset: 3px;
        }

        /* ============================================================
           Marketplace-style public car listing card
           ------------------------------------------------------------
           Class map:
             .car-card              : outer card element
             .car-inventory-card    : shared hook (cursor, focus, overlay)
             .car-card__media       : image/carousel region
             .car-card__image       : image inside carousel
             .car-card__status      : status badge over image
             .car-card__body        : content area under image
             .car-card__meta        : small uppercase meta line
             .car-card__title       : compact title
             .car-card__price       : prominent price
             .car-card__specs       : inline mileage/fuel/transmission row
             .car-card__cta         : subtle "View details" link
             .card-image-count      : image count pill overlay
        ============================================================ */

        .car-card {
            background: var(--brand-panel-bg);
            border: 1px solid var(--brand-panel-border);
            border-radius: 0.875rem;
            overflow: hidden;
            color: var(--brand-panel-text);
            box-shadow: var(--brand-panel-shadow);
            transition:
                transform 0.22s cubic-bezier(0.4, 0, 0.2, 1),
                box-shadow 0.22s cubic-bezier(0.4, 0, 0.2, 1),
                border-color 0.2s ease;
            display: flex;
            flex-direction: column;
        }

        .car-card:hover,
        .car-card:focus-within {
            transform: translateY(-2px);
            box-shadow: var(--brand-panel-shadow-hover);
            border-color: var(--brand-panel-border-strong);
        }

        .car-card__media {
            position: relative;
            aspect-ratio: 16 / 11;
            background: var(--brand-panel-media-bg);
            overflow: hidden;
        }

        .car-card__media .carousel,
        .car-card__media .carousel-inner,
        .car-card__media .carousel-item {
            height: 100%;
        }

        .car-card__media::after {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 38%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.32) 100%);
            pointer-events: none;
            z-index: 2;
        }

        .car-card__image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.22, 0.61, 0.36, 1);
            will-change: transform;
        }

        .car-card:hover .car-card__image,
        .car-card:focus-within .car-card__image {
            transform: scale(1.05);
        }

        .car-card__image--empty {
            color: var(--brand-panel-muted);
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .car-card__status {
            position: absolute;
            top: 0.7rem;
            left: 0.7rem;
            z-index: 4;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-size: 0.68rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.22);
        }

        /* ----------------------------------------------------------------
           Diagonal status ribbon (Reserved / Sold) shown across vehicle images.
           Used on: public car cards (.car-card__media) and detail page gallery
           (.show-gallery__media). Pointer-events disabled so the card/gallery
           remain fully clickable.
        -----------------------------------------------------------------*/
        .car-ribbon-layer {
            position: absolute;
            inset: 0;
            z-index: 5;
            pointer-events: none;
            overflow: hidden;
        }

        .car-ribbon {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 160%;
            transform: translate(-50%, -50%) rotate(-18deg);
            padding: 0.55rem 1rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.28em;
            font-weight: 800;
            font-size: clamp(1rem, 2.2vw, 1.5rem);
            line-height: 1;
            border-top: 1px solid rgba(255, 255, 255, 0.25);
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.35);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
        }

        .car-ribbon--reserved {
            background: linear-gradient(135deg, #c8941e 0%, #e7c46a 55%, #b8860b 100%);
            color: #1a1208;
        }

        .car-ribbon--sold {
            background: linear-gradient(135deg, #6d0f0f 0%, #a61d1d 55%, #7a1212 100%);
            color: #fff;
        }

        /* Smaller ribbon text inside compact card media */
        .car-card__media .car-ribbon {
            font-size: clamp(0.78rem, 1.7vw, 1.05rem);
            letter-spacing: 0.22em;
            padding: 0.42rem 0.75rem;
        }

        /* Larger ribbon text for the big detail-page gallery */
        .show-gallery__media .car-ribbon {
            font-size: clamp(1.15rem, 2.6vw, 1.9rem);
            letter-spacing: 0.32em;
            padding: 0.7rem 1.25rem;
        }

        .car-card__body {
            padding: 0.95rem 1rem 1.05rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            flex: 1 1 auto;
        }

        .car-card__meta {
            text-transform: uppercase;
            letter-spacing: 0.09em;
            font-size: 0.7rem;
            color: var(--brand-panel-muted);
            margin: 0 0 0.1rem;
        }

        .car-card__title {
            font-size: 1.02rem;
            font-weight: 700;
            letter-spacing: 0.005em;
            line-height: 1.25;
            color: var(--brand-panel-text);
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-clamp: 2;
            overflow: hidden;
        }

        .car-card__price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--brand-gold);
            margin: 0.25rem 0 0.45rem;
            letter-spacing: 0.005em;
            line-height: 1.15;
        }

        .car-card__specs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem 0.9rem;
            font-size: 0.78rem;
            color: var(--brand-panel-muted);
            margin: 0 0 0.25rem;
            padding: 0;
        }

        .car-card__specs li {
            display: inline-flex;
            align-items: center;
            gap: 0.32rem;
            line-height: 1.1;
        }

        .car-card__specs svg {
            width: 0.9rem;
            height: 0.9rem;
            opacity: 0.72;
            flex-shrink: 0;
        }

        .car-card__cta {
            margin-top: auto;
            padding-top: 0.35rem;
            color: var(--brand-gold);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.32rem;
            align-self: flex-start;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            transition: color 0.18s ease, gap 0.18s ease;
        }

        .car-card__cta svg {
            width: 0.85rem;
            height: 0.85rem;
            transition: transform 0.2s ease;
        }

        .car-card__cta:hover,
        .car-card__cta:focus,
        .car-card:hover .car-card__cta {
            color: var(--brand-gold-light);
        }

        .car-card:hover .car-card__cta svg {
            transform: translateX(3px);
        }

        /* Image count pill overlay (shared). */
        .car-inventory-card .carousel-control-prev,
        .car-inventory-card .carousel-control-next {
            z-index: 4;
        }

        .car-inventory-card .card-image-count {
            position: absolute;
            bottom: 0.7rem;
            right: 0.7rem;
            z-index: 4;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.25rem 0.6rem;
            border-radius: 999px;
            background: rgba(12, 18, 14, 0.62);
            color: #fefaf0;
            font-size: 0.74rem;
            font-weight: 600;
            line-height: 1;
            letter-spacing: 0.02em;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            pointer-events: none;
            user-select: none;
        }

        .car-inventory-card .card-image-count svg {
            width: 0.85rem;
            height: 0.85rem;
            flex-shrink: 0;
        }

        /* Dark mode: tokens already swap via :root rules — only tune ribbon/media if needed. */
        @media (prefers-color-scheme: dark) {
            .car-card__media {
                background: var(--brand-panel-media-bg);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .car-card,
            .car-card:hover,
            .car-card:focus-within,
            .car-card__image,
            .car-card:hover .car-card__image,
            .car-card:focus-within .car-card__image,
            .car-card:hover .car-card__cta svg {
                transition: none;
                transform: none;
            }
        }
    </style>
    @php
        $localBusinessSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'AutoDealer',
            'name' => 'ACPC Autos',
            'url' => route('home'),
            'telephone' => $publicPhoneTel ?? null,
            'email' => $publicEmailDisplay ?? null,
            'image' => asset('images/logo-full.png'),
            'priceRange' => 'EUR',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Malaga',
                'addressCountry' => 'ES',
            ],
            'areaServed' => [
                '@type' => 'City',
                'name' => 'Malaga',
            ],
            'description' => 'Premium hand-picked used cars in Malaga with personal dealership service.',
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'description' => $publicOpeningHoursText ?? null,
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($localBusinessSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @stack('structured_data')
</head>
<body>
    @php
        $publicWhatsAppMessage = config('dealer.whatsapp_message');
    @endphp
    <nav class="navbar navbar-expand-lg navbar-public">
        <div class="container flex-column py-2 py-md-3">
            <div class="navbar-top-row w-100 d-flex align-items-center justify-content-center position-relative">
                <a class="navbar-brand brand-logo-link d-inline-flex align-items-center gap-0 m-0 py-1" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="" class="brand-logo brand-logo--navbar" decoding="async">
                    <span class="navbar-brand-name text-brand-gold">ACPC Autos</span>
                </a>
                <button class="navbar-toggler position-absolute end-0 top-50 translate-middle-y" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse w-100 justify-content-center" id="publicNavbar">
                <ul class="navbar-nav justify-content-center align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-public" href="{{ route('home') }}">Home</a>
                    </li>
                    @if ($publicDedicatedCarsPageEnabled)
                        <li class="nav-item">
                            <a class="nav-link nav-link-public" href="{{ route('cars.index') }}">Browse Cars</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link nav-link-public" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-public" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer-public py-4 mt-4">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-md-4">
                    @hasSection('footer_brand')
                        @yield('footer_brand')
                    @else
                        <h2 class="h6 text-brand-gold mb-2">ACPC Autos</h2>
                    @endif
                    <p class="mb-0 small">Premium hand-picked vehicles with a personal dealership experience.</p>
                </div>
                <div class="col-md-4">
                    <h2 class="h6 text-brand-gold mb-2">Contact</h2>
                    <p class="mb-1 small">Phone: @include('public.partials.phone-cta', ['variant' => 'inline-link'])</p>
                    <p class="mb-0 small">Email: <a href="{{ $publicEmailMailto }}" class="footer-link">{{ $publicEmailDisplay }}</a></p>
                </div>
                <div class="col-md-4">
                    <h2 class="h6 text-brand-gold mb-2">Appointments</h2>
                    <p class="mb-0 small">{{ $publicAppointmentsText }}</p>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top border-secondary-subtle">
                <p class="mb-0 small">&copy; {{ date('Y') }} ACPC Autos. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <a
        class="whatsapp-float"
        href="https://wa.me/{{ $publicWhatsAppNumber }}?text={{ rawurlencode($publicWhatsAppMessage) }}"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat on WhatsApp"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.101h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.197-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
        </svg>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        (function () {
            var INTERACTIVE_SELECTOR = 'a[href], button, input, select, textarea, label, [data-bs-toggle], [data-bs-slide], [data-bs-slide-to], [data-no-card-link]';

            function navigateFromCard(card, openInNewTab) {
                var url = card.getAttribute('data-card-link');
                if (!url) {
                    return;
                }
                if (openInNewTab) {
                    window.open(url, '_blank', 'noopener');
                } else {
                    window.location.href = url;
                }
            }

            document.addEventListener('click', function (event) {
                var card = event.target.closest('[data-card-link]');
                if (!card) {
                    return;
                }
                if (event.target.closest(INTERACTIVE_SELECTOR)) {
                    return;
                }
                if (window.getSelection && window.getSelection().toString()) {
                    return;
                }
                var openInNewTab = event.ctrlKey || event.metaKey || event.shiftKey || event.button === 1;
                event.preventDefault();
                navigateFromCard(card, openInNewTab);
            });

            document.addEventListener('auxclick', function (event) {
                if (event.button !== 1) {
                    return;
                }
                var card = event.target.closest('[data-card-link]');
                if (!card) {
                    return;
                }
                if (event.target.closest(INTERACTIVE_SELECTOR)) {
                    return;
                }
                event.preventDefault();
                navigateFromCard(card, true);
            });

            document.addEventListener('keydown', function (event) {
                if (event.key !== 'Enter' && event.key !== ' ' && event.key !== 'Spacebar') {
                    return;
                }
                var card = event.target.closest('[data-card-link]');
                if (!card || card !== event.target) {
                    return;
                }
                event.preventDefault();
                navigateFromCard(card, false);
            });
        })();
    </script>
</body>
</html>
