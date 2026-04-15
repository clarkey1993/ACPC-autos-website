@extends('layouts.public')

@section('title', 'Cars - ACPC Autos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Available Cars</h1>
    </div>

    <div class="row g-3">
        @forelse ($cars as $car)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    @if ($car->featured_image)
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($car->featured_image) }}"
                            class="card-img-top"
                            alt="{{ $car->title }}"
                            style="height: 220px; object-fit: cover;"
                        >
                    @else
                        <div class="bg-secondary-subtle d-flex align-items-center justify-content-center" style="height: 220px;">
                            <span class="text-muted">No image</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h2 class="h5 card-title">{{ $car->title }}</h2>
                        <p class="mb-1"><strong>Make:</strong> {{ $car->make }}</p>
                        <p class="mb-1"><strong>Model:</strong> {{ $car->model }}</p>
                        <p class="mb-1"><strong>Year:</strong> {{ $car->year }}</p>
                        <p class="mb-1"><strong>Price:</strong> €{{ number_format($car->price) }}</p>
                        <p class="mb-3">
                            <strong>Status:</strong>
                            <span class="badge text-bg-success">{{ ucfirst($car->status) }}</span>
                        </p>
                        <a href="{{ route('cars.show', $car->slug) }}" class="btn btn-primary btn-sm">View Car</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary mb-0">No available cars found.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>
@endsection
