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
    $carCardSummaryParts = [
        '€' . number_format($car->price),
        $car->cardMileageText(),
    ];
    if ($carCardFuel) {
        $carCardSummaryParts[] = $carCardFuel;
    }
    if ($carCardTransmission) {
        $carCardSummaryParts[] = $carCardTransmission;
    }
@endphp

<article class="card car-card car-inventory-card border-0 h-100"
         data-card-link="{{ route('cars.show', $car->slug) }}"
         role="link"
         tabindex="0"
         aria-label="{{ __('public.cars.view_details_aria', ['title' => $car->title]) }}">
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
                        <span class="visually-hidden">{{ __('public.cars.previous') }}</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $carCardCarouselId }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{ __('public.cars.next') }}</span>
                    </button>
                    <div class="card-image-count" aria-label="{{ $carCardImagePaths->count() }} {{ __('public.cars.photos') }}">
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
                <span>{{ __('public.cars.no_image') }}</span>
            </div>
        @endif

        @if (in_array($car->status, ['reserved', 'sold', 'arriving_soon', 'just_arrived'], true))
            <div class="car-ribbon-layer" aria-hidden="true">
                <div class="car-ribbon car-ribbon--{{ $car->status }}">{{ $car->cardStatusLabel() }}</div>
            </div>
            <span class="visually-hidden">{{ __('public.cars.status') }}: {{ $car->cardStatusLabel() }}</span>
        @else
            <span class="car-card__status badge {{ $car->cardStatusBadgeClass() }} rounded-pill px-2 py-1 small fw-semibold">
                {{ $car->cardStatusLabel() }}
            </span>
        @endif
    </div>

    <div class="car-card__body">
        <h3 class="car-card__title">{{ $car->title }}</h3>
        <p class="car-card__summary">{{ implode(' · ', $carCardSummaryParts) }}</p>

        <a href="{{ route('cars.show', $car->slug) }}" class="car-card__cta">
            {{ __('public.cars.view_details') }} →
        </a>
    </div>
</article>
