@extends('layouts.public')

@section('title', 'Home - ACPC Autos')

@section('content')
    <div class="p-4 p-md-5 mb-4 bg-white border rounded-3">
        <div class="col-lg-8">
            <h1 class="display-6 fw-bold">Quality Used Cars, Ready to Drive</h1>
            <p class="lead mb-4">Browse our latest available vehicles and find the right car for your needs.</p>
            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">Browse Cars</a>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Latest Cars</h2>
        <a href="{{ route('cars.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
    </div>

    <div class="row g-3">
        @forelse ($latestCars as $car)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($car->featured_image)
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($car->featured_image) }}"
                            class="card-img-top"
                            alt="{{ $car->title }}"
                            style="height: 200px; object-fit: cover;"
                        >
                    @endif
                    <div class="card-body">
                        <h3 class="h5 card-title">{{ $car->title }}</h3>
                        <p class="mb-1 text-muted">{{ $car->make }} {{ $car->model }} ({{ $car->year }})</p>
                        <p class="fw-semibold mb-3">€{{ number_format($car->price) }}</p>
                        <a href="{{ route('cars.show', $car->slug) }}" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary mb-0">No cars available right now. Please check back soon.</div>
            </div>
        @endforelse
    </div>
@endsection
