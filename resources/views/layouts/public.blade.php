<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ACPC Autos')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --brand-primary: #2f5e3a;
            --brand-dark: #1e3327;
            --brand-gold: #c9a45c;
            --brand-gold-light: #e0c98a;
            --brand-bg: #11161a;
            --brand-off-white: #f5f1e8;
        }

        body {
            background-color: var(--brand-bg);
            color: var(--brand-off-white);
        }

        .navbar-public {
            background-color: rgba(17, 22, 26, 0.95);
            border-bottom: 1px solid rgba(201, 164, 92, 0.25);
        }

        .brand-logo {
            height: 38px;
            width: auto;
            object-fit: contain;
        }

        .brand-card {
            background-color: #1a2025;
            border: 1px solid rgba(201, 164, 92, 0.22);
            color: var(--brand-off-white);
        }

        .hero-shell {
            background: linear-gradient(135deg, rgba(30, 51, 39, 0.96), rgba(17, 22, 26, 0.98));
            border: 1px solid rgba(224, 201, 138, 0.28);
        }

        .brand-muted {
            color: #c7bfae !important;
        }

        .btn-brand-primary {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
            color: var(--brand-off-white);
        }

        .btn-brand-primary:hover,
        .btn-brand-primary:focus {
            background-color: var(--brand-dark);
            border-color: var(--brand-dark);
            color: var(--brand-off-white);
        }

        .btn-brand-outline {
            border-color: var(--brand-gold);
            color: var(--brand-gold-light);
        }

        .btn-brand-outline:hover,
        .btn-brand-outline:focus {
            background-color: var(--brand-gold);
            border-color: var(--brand-gold);
            color: #1b1f22;
        }

        .text-brand-gold {
            color: var(--brand-gold-light) !important;
        }

        .badge-brand {
            background-color: var(--brand-primary);
            color: var(--brand-off-white);
        }

        .footer-public {
            border-top: 1px solid rgba(201, 164, 92, 0.25);
            color: #b7ae9a;
        }

        .footer-link {
            color: #d4cbb7;
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
            background-color: #1a2025;
            border-color: rgba(201, 164, 92, 0.2);
            color: var(--brand-off-white);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-public py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="ACPC Autos logo" class="brand-logo">
                <span class="fw-semibold text-brand-gold">ACPC Autos</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="publicNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('cars.index') }}">Browse Cars</a>
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
                    <h2 class="h6 text-brand-gold mb-2">ACPC Autos</h2>
                    <p class="mb-0 small">Premium hand-picked vehicles with a personal dealership experience.</p>
                </div>
                <div class="col-md-4">
                    <h2 class="h6 text-brand-gold mb-2">Contact</h2>
                    <p class="mb-1 small">Phone: <a href="#" class="footer-link">+00 0000 000000</a></p>
                    <p class="mb-0 small">Email: <a href="#" class="footer-link">sales@example.com</a></p>
                </div>
                <div class="col-md-4">
                    <h2 class="h6 text-brand-gold mb-2">Opening Hours</h2>
                    <p class="mb-0 small">Mon-Sat: 9:00am - 6:00pm</p>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top border-secondary-subtle">
                <p class="mb-0 small">&copy; {{ date('Y') }} ACPC Autos. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
