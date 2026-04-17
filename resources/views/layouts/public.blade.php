<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ACPC Autos')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            color-scheme: light dark;
            --brand-primary: #2f5e3a;
            --brand-dark: #1e3327;
            --brand-gold: #b99146;
            --brand-gold-light: #d5b77a;
            --brand-bg: #f8f6f1;
            --brand-surface: #ffffff;
            --brand-surface-alt: #f2eee4;
            --brand-text: #1f2b24;
            --brand-muted-text: #59675d;
            --brand-border: #e5e5e5;
            --brand-gold-border: rgba(185, 145, 70, 0.35);
            --brand-navbar-bg: rgba(255, 255, 255, 0.94);
            --brand-navbar-link: #22352a;
            --brand-footer-text: #6a756d;
            --brand-footer-link: #2b3f33;
            --brand-card-shadow: 0 8px 20px rgba(20, 30, 24, 0.07);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --brand-primary: #2f5e3a;
                --brand-dark: #1e3327;
                --brand-gold: #c9a45c;
                --brand-gold-light: #e0c98a;
                --brand-bg: #101418;
                --brand-surface: #1d252c;
                --brand-surface-alt: #1e252b;
                --brand-text: #f5f1e8;
                --brand-muted-text: #c7bfae;
                --brand-border: rgba(201, 164, 92, 0.3);
                --brand-gold-border: rgba(224, 201, 138, 0.3);
                --brand-navbar-bg: rgba(17, 22, 26, 0.95);
                --brand-navbar-link: #f5f1e8;
                --brand-footer-text: #b7ae9a;
                --brand-footer-link: #d4cbb7;
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
            backdrop-filter: blur(8px);
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
            height: clamp(42px, 3.35vw, 46px);
            width: auto;
            max-height: 46px;
            margin-right: 0.55rem;
            display: block;
            align-self: center;
        }

        .navbar-public .navbar-brand.brand-logo-link {
            display: inline-flex;
            align-items: center;
            line-height: 1;
        }

        .navbar-brand-name {
            font-size: clamp(1.09rem, 0.65vw + 0.98rem, 1.22rem);
            font-weight: 600;
            letter-spacing: 0.012em;
            line-height: 1.2;
            align-self: center;
        }

        .brand-logo-link {
            text-decoration: none;
            color: inherit;
        }

        .brand-logo-link:hover .brand-logo,
        .brand-logo-link:focus-visible .brand-logo {
            transform: scale(1.03);
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

        @media (prefers-color-scheme: dark) {
            .brand-logo--navbar,
            .brand-logo--footer {
                filter: brightness(1.08) contrast(1.04);
            }
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

        .footer-public {
            border-top: 1px solid var(--brand-gold-border);
            color: var(--brand-footer-text);
            background-color: var(--brand-surface-alt);
        }

        .footer-link {
            color: var(--brand-footer-link);
            text-decoration: none;
        }

        .footer-link:hover {
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
        }

        .nav-link-public:hover,
        .nav-link-public:focus {
            color: var(--brand-primary) !important;
        }

        .navbar-phone-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--brand-navbar-link);
            text-decoration: none;
            padding: 0.35rem 0.55rem;
            border-radius: 0.375rem;
            border: 1px solid rgba(47, 94, 58, 0.14);
            background-color: rgba(47, 94, 58, 0.04);
            white-space: nowrap;
            transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease;
        }

        .navbar-phone-link:hover,
        .navbar-phone-link:focus {
            color: var(--brand-primary);
            background-color: rgba(47, 94, 58, 0.1);
            border-color: rgba(47, 94, 58, 0.22);
        }

        .navbar-phone-link svg {
            flex-shrink: 0;
            opacity: 0.85;
        }

        @media (prefers-color-scheme: dark) {
            .navbar-phone-link {
                border-color: rgba(224, 201, 138, 0.2);
                background-color: rgba(255, 255, 255, 0.04);
            }

            .navbar-phone-link:hover,
            .navbar-phone-link:focus {
                color: var(--brand-gold-light);
                background-color: rgba(255, 255, 255, 0.08);
                border-color: rgba(224, 201, 138, 0.32);
            }
        }

        @media (min-width: 992px) {
            .navbar-phone-wrap {
                border-left: 1px solid rgba(47, 94, 58, 0.14);
                padding-left: 0.65rem;
                margin-left: 0.35rem;
            }
        }

        @media (min-width: 992px) and (prefers-color-scheme: dark) {
            .navbar-phone-wrap {
                border-left-color: rgba(224, 201, 138, 0.22);
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

        /**
         * Inventory listing cards (grid): same premium dark panel as dark-mode branding,
         * on light pages only — softer lift on white; buttons use global .btn-brand-*.
         * Add class `car-inventory-card` to any `card brand-card` used for stock listings.
         */
        @media not (prefers-color-scheme: dark) {
            .card.brand-card.car-inventory-card {
                /* Green-forward depth aligned with --brand-primary / dark-mode gold trim */
                background: linear-gradient(
                    168deg,
                    rgba(34, 52, 42, 0.98) 0%,
                    rgba(22, 40, 30, 0.98) 46%,
                    rgba(14, 24, 18, 0.99) 100%
                );
                border: 1px solid rgba(224, 201, 138, 0.28);
                color: #f5f1e8;
                box-shadow:
                    0 0 0 1px rgba(255, 255, 255, 0.04),
                    0 10px 26px rgba(8, 16, 12, 0.2),
                    0 3px 10px rgba(8, 16, 12, 0.1),
                    inset 0 1px 0 rgba(255, 255, 255, 0.06);
                transition:
                    box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.28s cubic-bezier(0.4, 0, 0.2, 1),
                    border-color 0.22s ease;
            }

            .card.brand-card.car-inventory-card:hover {
                transform: translateY(-3px);
                border-color: rgba(224, 201, 138, 0.38);
                box-shadow:
                    0 0 0 1px rgba(255, 255, 255, 0.05),
                    0 14px 34px rgba(8, 16, 12, 0.26),
                    0 4px 12px rgba(8, 16, 12, 0.12),
                    inset 0 1px 0 rgba(255, 255, 255, 0.08);
            }

            .card.brand-card.car-inventory-card .carousel,
            .card.brand-card.car-inventory-card .carousel-inner,
            .card.brand-card.car-inventory-card .carousel-item {
                background: #0d1410;
            }

            .card.brand-card.car-inventory-card .carousel .stock-image {
                background: #0d1410;
            }

            .card.brand-card.car-inventory-card .carousel {
                box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.35);
            }

            .card.brand-card.car-inventory-card .card-body {
                background: transparent;
            }

            .card.brand-card.car-inventory-card .card-title {
                color: #f5f1e8;
                letter-spacing: -0.01em;
            }

            .card.brand-card.car-inventory-card .home-muted {
                color: rgba(199, 191, 174, 0.92) !important;
            }

            .card.brand-card.car-inventory-card .brand-muted {
                color: rgba(199, 191, 174, 0.92) !important;
            }

            /* Same tokens as dark :root: --brand-gold + light highlight for legibility on green */
            .card.brand-card.car-inventory-card .price-highlight {
                color: #c9a45c;
                text-shadow: 0 0 1px rgba(0, 0, 0, 0.45), 0 1px 2px rgba(0, 0, 0, 0.35);
            }

            .card.brand-card.car-inventory-card .carousel-control-prev,
            .card.brand-card.car-inventory-card .carousel-control-next {
                opacity: 0.92;
            }

            .card.brand-card.car-inventory-card > .d-flex.stock-image {
                background: rgba(0, 0, 0, 0.28) !important;
                color: rgba(245, 241, 232, 0.52) !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            }

            .card.brand-card.car-inventory-card .badge.text-bg-success {
                background-color: #2f5e3a !important;
                color: #f7f5ef !important;
            }

            .card.brand-card.car-inventory-card .badge.text-bg-warning {
                background-color: #c9a45c !important;
                color: #1a1610 !important;
            }

            .card.brand-card.car-inventory-card .badge.text-bg-secondary {
                background-color: rgba(255, 255, 255, 0.1) !important;
                color: #f5f1e8 !important;
                border: 1px solid rgba(255, 255, 255, 0.14);
            }

            @media (prefers-reduced-motion: reduce) {
                .card.brand-card.car-inventory-card,
                .card.brand-card.car-inventory-card:hover {
                    transition: none;
                    transform: none;
                }
            }
        }
    </style>
</head>
<body>
    @php
        $publicWhatsAppMessage = config('dealer.whatsapp_message');
    @endphp
    <nav class="navbar navbar-expand-lg navbar-public py-3">
        <div class="container">
            <a class="navbar-brand brand-logo-link gap-0 py-0" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-icon.png') }}" alt="" class="brand-logo brand-logo--navbar" decoding="async">
                <span class="navbar-brand-name text-brand-gold">ACPC Autos</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="publicNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link nav-link-public" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-public" href="{{ route('cars.index') }}">Browse Cars</a>
                    </li>
                    <li class="nav-item navbar-phone-wrap">
                        <a class="navbar-phone-link my-1 my-lg-0" href="tel:{{ preg_replace('/\s+/', '', $publicPhoneTel) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            </svg>
                            <span>{{ $publicPhoneDisplay }}</span>
                        </a>
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
                    <p class="mb-1 small">Phone: <a href="tel:{{ preg_replace('/\s+/', '', $publicPhoneTel) }}" class="footer-link">{{ $publicPhoneDisplay }}</a></p>
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
</body>
</html>
