<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - ACPC Autos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --admin-green: #18452d;
            --admin-green-deep: #102c1d;
            --admin-green-soft: #235a3f;
            --admin-gold: #b99146;
            --admin-gold-light: #d5b77a;
            --admin-cream: #f5f1e8;
            --admin-text: #1f2420;
            --admin-muted: #687269;
            --admin-border: rgba(24, 36, 28, 0.1);
            --admin-gold-border: rgba(185, 145, 70, 0.28);
            --admin-shadow: 0 12px 30px rgba(16, 44, 29, 0.12);
        }

        body.admin-body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(213, 183, 122, 0.16), transparent 32rem),
                linear-gradient(180deg, #f7f3ea 0%, #f4f1e9 42%, #ebe6da 100%);
            color: var(--admin-text);
        }

        .admin-navbar {
            background: linear-gradient(135deg, var(--admin-green-deep), var(--admin-green) 58%, #143c28);
            border-bottom: 1px solid var(--admin-gold-border);
            box-shadow: 0 8px 24px rgba(10, 28, 18, 0.28);
        }

        .admin-navbar .container,
        .admin-main > .container {
            max-width: 1180px;
        }

        .admin-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            color: var(--admin-cream) !important;
            letter-spacing: 0.03em;
            text-decoration: none;
        }

        .admin-brand__mark {
            width: 2.4rem;
            height: 2.4rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(213, 183, 122, 0.5);
            border-radius: 999px;
            background: rgba(245, 241, 232, 0.08);
            color: var(--admin-gold-light);
            font-weight: 800;
            line-height: 1;
        }

        .admin-brand__text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .admin-brand__name {
            font-weight: 800;
            text-transform: uppercase;
        }

        .admin-brand__label {
            color: rgba(245, 241, 232, 0.72);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .admin-navbar .navbar-toggler {
            border-color: rgba(213, 183, 122, 0.42);
        }

        .admin-navbar .navbar-toggler:focus {
            box-shadow: 0 0 0 0.18rem rgba(213, 183, 122, 0.28);
        }

        .admin-navbar .nav-link {
            color: rgba(245, 241, 232, 0.82);
            border-radius: 999px;
            font-size: 0.88rem;
            font-weight: 600;
            padding: 0.45rem 0.8rem;
            transition: background-color 0.18s ease, color 0.18s ease;
        }

        .admin-navbar .nav-link:hover,
        .admin-navbar .nav-link:focus {
            background-color: rgba(245, 241, 232, 0.08);
            color: var(--admin-gold-light);
        }

        .admin-logout-btn {
            border: 1px solid rgba(213, 183, 122, 0.55);
            color: var(--admin-cream);
            border-radius: 999px;
            font-weight: 600;
            padding-inline: 1rem;
        }

        .admin-logout-btn:hover,
        .admin-logout-btn:focus {
            background-color: var(--admin-gold-light);
            border-color: var(--admin-gold-light);
            color: var(--admin-green-deep);
        }

        .admin-main {
            padding-top: 2rem;
            padding-bottom: 3.5rem;
        }

        .admin-alert {
            border-radius: 1rem;
            border: 1px solid var(--admin-border);
            box-shadow: var(--admin-shadow);
        }

        @media (max-width: 991.98px) {
            .admin-navbar .navbar-nav {
                gap: 0.25rem;
                padding-top: 0.75rem;
            }

            .admin-navbar form {
                padding-top: 0.75rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="admin-body">
    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar">
        <div class="container">
            <a class="navbar-brand admin-brand" href="{{ route('admin.dashboard') }}">
                <span class="admin-brand__mark">A</span>
                <span class="admin-brand__text">
                    <span class="admin-brand__name">ACPC Autos</span>
                    <span class="admin-brand__label">Admin</span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.cars.index') }}">Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.enquiries.index') }}">Enquiries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.site-settings.edit') }}">Site Settings</a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm admin-logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="admin-main">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success admin-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger admin-alert">
                    <p class="mb-2">Please fix the following errors:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
