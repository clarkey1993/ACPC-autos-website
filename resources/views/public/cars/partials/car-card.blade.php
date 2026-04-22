{{--
    Premium marketplace-style public car listing card.
    Expected vars:
      - $car           : App\Models\Car
      - $carouselIdPrefix (optional): string prefix for the carousel id (default: 'carCard')
--}}
@php
    $carCardImagePaths = collect();
    if ($car->featured_image) {
        $carCardImagePaths->push($car->featured_image);
    }
    foreach ($car->images as $carCardImage) {
        $carCardImagePaths->push($carCardImage->image_path);
    }
    $carCardCarouselId = ($carouselIdPrefix ?? 'carCard') . $car->id;
    $carCardFuel = $car->cardFuelText();
    $carCardTransmission = $car->cardTransmissionText();
@endphp

<article class="card car-card car-inventory-card border-0 h-100"
         data-card-link="{{ route('cars.show', $car->slug) }}"
         role="link"
         tabindex="0"
         aria-label="View details for {{ $car->title }}">
    <div class="car-card__media">
        @if ($carCardImagePaths->isNotEmpty())
            <div id="{{ $carCardCarouselId }}" class="carousel slide car-card__carousel">
                <div class="carousel-inner">
                    @foreach ($carCardImagePaths as $carCardImagePath)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($carCardImagePath) }}"
                                class="car-card__image"
                                alt="{{ $car->title }}"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    @endforeach
                </div>

                @if ($carCardImagePaths->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carCardCarouselId }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $carCardCarouselId }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    <div class="card-image-count" aria-label="{{ $carCardImagePaths->count() }} photos">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                            <path d="M15 12V6a1 1 0 0 0-1-1h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 3H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 5H2a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM2 4h1.172a1 1 0 0 0 .707-.293l.828-.828A3 3 0 0 1 6.828 2h2.344a3 3 0 0 1 2.121.879l.828.828A1 1 0 0 0 12.828 4H14a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                            <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                        </svg>
                        <span>{{ $carCardImagePaths->count() }}</span>
                    </div>
                @endif
            </div>
        @else
            <div class="car-card__image car-card__image--empty d-flex align-items-center justify-content-center">
                <span>No image</span>
            </div>
        @endif

        @if ($car->status === 'reserved' || $car->status === 'sold')
            <div class="car-ribbon-layer" aria-hidden="true">
                <div class="car-ribbon car-ribbon--{{ $car->status }}">{{ $car->cardStatusLabel() }}</div>
            </div>
            <span class="visually-hidden">Status: {{ $car->cardStatusLabel() }}</span>
        @else
            <span class="car-card__status badge {{ $car->cardStatusBadgeClass() }} rounded-pill px-2 py-1 small fw-semibold">
                {{ $car->cardStatusLabel() }}
            </span>
        @endif
    </div>

    <div class="car-card__body">
        <p class="car-card__meta">{{ $car->make }} {{ $car->model }} · {{ $car->year }}</p>
        <h3 class="car-card__title">{{ $car->title }}</h3>
        <p class="car-card__price">€{{ number_format($car->price) }}</p>

        <ul class="car-card__specs list-unstyled">
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                    <path d="M4 9a5 5 0 1 1 10 0A5 5 0 0 1 4 9zm5-8a.5.5 0 0 1 .5.5V3h2a.5.5 0 0 1 .5.5V4a6 6 0 1 1-6 0v-.5a.5.5 0 0 1 .5-.5h2V1.5A.5.5 0 0 1 9 1z"/>
                </svg>
                <span>{{ $car->cardMileageText() }}</span>
            </li>
            @if ($carCardFuel)
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M3 2.5A1.5 1.5 0 0 1 4.5 1h6A1.5 1.5 0 0 1 12 2.5V14h.5a.5.5 0 0 1 0 1h-10a.5.5 0 0 1 0-1H3V2.5zm1 12h7V2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0-.5.5v12zm9.5-6.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V10a.5.5 0 0 1-.5-.5V8h1zm-.5-3.5a.5.5 0 0 1 .5-.5H14a.5.5 0 0 1 .5.5v3h-1V4.5z"/>
                    </svg>
                    <span>{{ $carCardFuel }}</span>
                </li>
            @endif
            @if ($carCardTransmission)
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M8 1a.5.5 0 0 1 .5.5V6h3.5a.5.5 0 0 1 0 1H8.5v7.5a.5.5 0 0 1-1 0V7H4a.5.5 0 0 1 0-1h3.5V1.5A.5.5 0 0 1 8 1z"/>
                        <path d="M4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm11 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM4 12.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm11 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                    <span>{{ $carCardTransmission }}</span>
                </li>
            @endif
        </ul>

        <a href="{{ route('cars.show', $car->slug) }}" class="car-card__cta">
            View details
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
            </svg>
        </a>
    </div>
</article>
