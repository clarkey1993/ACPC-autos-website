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
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="mb-0">&copy; {{ date('Y') }} ACPC Autos. All rights reserved.</p>
            <p class="mb-0 small">Premium pre-owned vehicles.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
