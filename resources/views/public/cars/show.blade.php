@extends('layouts.public')

@section('title', $car->title . ' - ACPC Autos')

@section('content')
    @php
        $imagePaths = collect();
        if ($car->featured_image) {
            $imagePaths->push($car->featured_image);
        }
        foreach ($car->images as $image) {
            $imagePaths->push($image->image_path);
        }
        $mainImagePath = $imagePaths->first();
    @endphp

    <section class="mb-4">
        <a href="{{ route('cars.index') }}" class="btn btn-brand-outline btn-sm">Back to Cars</a>
    </section>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card brand-card shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h2 mb-3">{{ $car->title }}</h1>

                    @if ($mainImagePath)
                        <img
                            id="mainCarImage"
                            src="{{ \Illuminate\Support\Facades\Storage::url($mainImagePath) }}"
                            alt="{{ $car->title }}"
                            class="img-fluid rounded border mb-3"
                            role="button"
                            data-current-index="0"
                            style="width: 100%; max-height: 520px; object-fit: cover; border-color: rgba(201, 164, 92, 0.35) !important;"
                        >

                        @if ($imagePaths->count() > 1)
                            <div class="row g-2 mb-4" id="carImageThumbnails">
                                @foreach ($imagePaths as $imagePath)
                                    <div class="col-4 col-sm-3 col-md-2">
                                        <button
                                            type="button"
                                            class="p-0 w-100 bg-transparent rounded border @if ($loop->first) border-2 border-warning @else border-secondary @endif"
                                            data-image-url="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                            data-image-index="{{ $loop->index }}"
                                            style="overflow: hidden;"
                                        >
                                            <img
                                                src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                                alt="{{ $car->title }} thumbnail {{ $loop->iteration }}"
                                                class="w-100"
                                                style="height: 90px; object-fit: cover;"
                                            >
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="d-flex align-items-center justify-content-center rounded border mb-3 brand-muted" style="height: 340px; border-color: rgba(201, 164, 92, 0.35) !important;">
                            <span>No featured image</span>
                        </div>
                    @endif

                    <h2 class="h5 mb-3">Description</h2>
                    <p class="mb-0 brand-muted">{{ $car->description ?: 'No description provided.' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card brand-card shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <h2 class="h5 mb-3">Quick Specs</h2>
                    <p class="mb-2 brand-muted"><strong class="text-light">Price:</strong> <span class="text-brand-gold fw-semibold">€{{ number_format($car->price) }}</span></p>
                    <p class="mb-2 brand-muted"><strong class="text-light">Make:</strong> {{ $car->make }}</p>
                    <p class="mb-2 brand-muted"><strong class="text-light">Model:</strong> {{ $car->model }}</p>
                    <p class="mb-2 brand-muted"><strong class="text-light">Year:</strong> {{ $car->year }}</p>
                    <p class="mb-2 brand-muted"><strong class="text-light">Mileage:</strong> {{ $car->mileage ? number_format($car->mileage) . ' km' : 'N/A' }}</p>
                    <p class="mb-2 brand-muted"><strong class="text-light">Fuel:</strong> {{ $car->fuel_type ?: 'N/A' }}</p>
                    <p class="mb-2 brand-muted"><strong class="text-light">Transmission:</strong> {{ $car->transmission ?: 'N/A' }}</p>
                    <p class="mb-0 brand-muted"><strong class="text-light">Colour:</strong> {{ $car->colour ?: 'N/A' }}</p>
                </div>
            </div>

            <div class="card brand-card shadow-sm rounded-4">
                <div class="card-body p-4">
                    <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Interested in this car?</p>
                    <h2 class="h4 mb-2">Send an Enquiry</h2>
                    <p class="brand-muted mb-0">Submit the form and our team will contact you quickly with availability and next steps.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card brand-card shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <h2 class="h3 mb-3">Enquiry Form</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <p class="mb-2">Please fix the following:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('enquiries.store', ['car' => $car->slug]) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone (optional)</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                    </div>

                    <div class="col-12">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-brand-primary mt-3">Send Enquiry</button>
            </form>
        </div>
    </div>

    <div class="brand-card rounded-4 p-4 text-center mb-4">
        <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Need a faster response?</p>
        <h2 class="h4 mb-2">Call or email our sales team today</h2>
        <p class="brand-muted mb-0">Phone placeholder: +00 0000 000000 | Email placeholder: sales@example.com</p>
    </div>

    @if ($imagePaths->isNotEmpty())
        <div class="modal fade" id="carImageLightboxModal" tabindex="-1" aria-labelledby="carImageLightboxModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content bg-black">
                    <div class="modal-header border-0">
                        <h2 class="visually-hidden" id="carImageLightboxModalLabel">Car image gallery</h2>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center pt-0">
                        <div id="carLightboxCarousel" class="carousel slide w-100">
                            <div class="carousel-inner">
                                @foreach ($imagePaths as $imagePath)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url($imagePath) }}"
                                            class="d-block mx-auto"
                                            alt="{{ $car->title }} image {{ $loop->iteration }}"
                                            style="max-height: 85vh; max-width: 100%; object-fit: contain;"
                                        >
                                    </div>
                                @endforeach
                            </div>

                            @if ($imagePaths->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carLightboxCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carLightboxCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($imagePaths->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mainImage = document.getElementById('mainCarImage');
                const thumbnailButtons = document.querySelectorAll('#carImageThumbnails button[data-image-url]');
                const lightboxModalElement = document.getElementById('carImageLightboxModal');
                const lightboxModal = new bootstrap.Modal(lightboxModalElement);
                const lightboxCarouselElement = document.getElementById('carLightboxCarousel');
                const lightboxCarousel = bootstrap.Carousel.getOrCreateInstance(lightboxCarouselElement, {
                    interval: false,
                    ride: false
                });

                function openLightboxAt(index) {
                    lightboxCarousel.to(Number(index) || 0);
                    lightboxModal.show();
                }

                if (mainImage) {
                    mainImage.addEventListener('click', function () {
                        openLightboxAt(mainImage.getAttribute('data-current-index'));
                    });
                }

                thumbnailButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        const clickedIndex = this.getAttribute('data-image-index');
                        mainImage.src = this.getAttribute('data-image-url');
                        mainImage.setAttribute('data-current-index', clickedIndex);

                        thumbnailButtons.forEach(function (thumbButton) {
                            thumbButton.classList.remove('border-warning', 'border-2');
                            thumbButton.classList.add('border-secondary');
                        });

                        this.classList.remove('border-secondary');
                        this.classList.add('border-warning', 'border-2');

                        openLightboxAt(clickedIndex);
                    });
                });
            });
        </script>
    @endif
@endsection
