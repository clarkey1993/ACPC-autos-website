@extends('layouts.public')

@section('title', 'Cars - ACPC Autos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Available Cars</h1>
    </div>

    <div class="row g-4">
        @forelse ($cars as $car)
            <div class="col-md-6 col-lg-4">
                <div class="card brand-card h-100 shadow-sm rounded-4 overflow-hidden">
                    @if ($car->featured_image)
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($car->featured_image) }}"
                            class="card-img-top"
                            alt="{{ $car->title }}"
                            style="height: 230px; object-fit: cover;"
                        >
                    @else
                        <div class="d-flex align-items-center justify-content-center brand-muted" style="height: 230px;">
                            <span>No image</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h2 class="h5 card-title">{{ $car->title }}</h2>
                        <p class="mb-1 brand-muted"><strong class="text-light">Make:</strong> {{ $car->make }}</p>
                        <p class="mb-1 brand-muted"><strong class="text-light">Model:</strong> {{ $car->model }}</p>
                        <p class="mb-1 brand-muted"><strong class="text-light">Year:</strong> {{ $car->year }}</p>
                        <p class="mb-1 text-brand-gold fw-semibold"><strong class="text-brand-gold">Price:</strong> €{{ number_format($car->price) }}</p>
                        <p class="mb-3 brand-muted">
                            <strong>Status:</strong>
                            <span class="badge badge-brand">{{ ucfirst($car->status) }}</span>
                        </p>
                        <a href="{{ route('cars.show', $car->slug) }}" class="btn btn-brand-primary btn-sm">View Car</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert mb-0 brand-card border-0">No available cars found.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>
@endsection
