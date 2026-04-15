@extends('layouts.admin')

@section('title', 'Edit Car')

@section('content')
    <h1 class="h3 mb-3">Edit Car</h1>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h2 class="h6 mb-3">Current Featured Image</h2>

            @if ($car->featured_image)
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($car->featured_image) }}"
                    alt="{{ $car->title }}"
                    class="img-thumbnail"
                    style="width: 220px; height: 160px; object-fit: cover;"
                >
            @else
                <p class="text-muted mb-0">No featured image uploaded yet.</p>
            @endif
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.cars._form', ['submitLabel' => 'Update Car'])
            </form>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <h2 class="h6 mb-3">Gallery Images</h2>

            @if ($car->images->isEmpty())
                <p class="text-muted mb-0">No gallery images uploaded yet.</p>
            @else
                <div class="row g-3">
                    @foreach ($car->images as $image)
                        <div class="col-6 col-md-4 col-lg-3">
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}"
                                alt="{{ $car->title }} gallery image"
                                class="img-thumbnail w-100"
                                style="height: 140px; object-fit: cover;"
                            >
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
