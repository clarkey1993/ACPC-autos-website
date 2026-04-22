{{-- Status + mileage for public listing cards (expects $car). Parent card should use class `car-inventory-card` with `card brand-card` for premium listing styling. --}}
<div class="d-flex flex-wrap align-items-center gap-2 mb-2">
    <span class="badge {{ $car->cardStatusBadgeClass() }} rounded-pill car-card-status px-2 py-1 small fw-semibold">{{ $car->cardStatusLabel() }}</span>
</div>
<p class="small brand-muted mb-2 d-flex flex-wrap align-items-center column-gap-2 row-gap-1">
    <span>{{ $car->cardMileageText() }}</span>
</p>
