@extends('layouts.public')

@section('title', 'Used Cars for Sale in Málaga | ACPC Autos')
@section('meta_description', 'View current used cars for sale in Málaga from ACPC Autos. Browse available, reserved, and sold stock with full vehicle details.')

@section('content')
    <style>
        .page-cars-index .index-hero {
            background: linear-gradient(132deg, #fffefb 0%, #fbf8f2 58%, #f5f0e6 100%);
            border: 1px solid rgba(185, 145, 70, 0.2);
            box-shadow: 0 12px 26px rgba(15, 24, 18, 0.08);
        }

        .page-cars-index .empty-state-card {
            background: linear-gradient(148deg, #fffefb 0%, #f7f2e8 100%);
            border: 1px solid rgba(185, 145, 70, 0.22);
        }

        @media (prefers-color-scheme: dark) {
            .page-cars-index .index-hero {
                background: linear-gradient(128deg, rgba(36, 46, 52, 0.96) 0%, rgba(26, 33, 39, 0.98) 100%);
                border-color: rgba(201, 164, 92, 0.24);
                box-shadow: 0 10px 26px rgba(0, 0, 0, 0.24);
            }

            .page-cars-index .empty-state-card {
                background: linear-gradient(145deg, rgba(34, 42, 48, 0.98) 0%, rgba(26, 32, 37, 0.98) 100%);
                border-color: rgba(201, 164, 92, 0.24);
            }
        }
    </style>

    <div class="page-cars-index">
    <section class="mb-4">
        <div class="brand-card index-hero rounded-4 p-4 p-md-5">
            <h1 class="h2 mb-2">Current Stock</h1>
            <p class="brand-muted mb-0">A small premium collection of available vehicles. No clutter, just the best cars in stock right now.</p>
        </div>
    </section>

    <section>
        <div class="row g-4">
            @forelse ($cars as $car)
                <div class="col-md-6 col-lg-4">
                    @include('public.cars.partials.car-card', ['car' => $car, 'carouselIdPrefix' => 'indexCarCard'])
                </div>
            @empty
                <div class="col-12">
                    <div class="alert mb-0 brand-card empty-state-card border-0">No available cars found.</div>
                </div>
            @endforelse
        </div>
    </section>

    <div class="mt-4 d-flex justify-content-center">
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>
    </div>
@endsection
