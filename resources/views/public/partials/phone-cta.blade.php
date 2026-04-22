{{--
    Responsive phone CTA.

    Variables (all optional):
      - $variant: 'button-primary' (default) | 'inline-link'
      - $label:   Visible button text on mobile for 'button-primary' variant (default: 'Call us')

    Expects these globally-shared view vars (already passed to all public views):
      - $publicPhoneTel
      - $publicPhoneDisplay

    Behavior:
      - Mobile (< 768px): clickable tel: link (button or inline link).
      - Desktop (>= 768px): non-clickable styled display of the phone number.
--}}
@php
    $phoneCtaVariant = $variant ?? 'button-primary';
    $phoneCtaLabel = $label ?? 'Call us';
    $phoneCtaTel = 'tel:' . preg_replace('/\s+/', '', $publicPhoneTel);
@endphp

@if ($phoneCtaVariant === 'inline-link')
    <a href="{{ $phoneCtaTel }}" class="footer-link fw-semibold d-inline d-md-none">{{ $publicPhoneDisplay }}</a>
    <span class="phone-static-inline fw-semibold d-none d-md-inline" aria-label="Phone number">{{ $publicPhoneDisplay }}</span>
@else
    <a href="{{ $phoneCtaTel }}" class="btn btn-brand-primary d-inline-flex d-md-none align-items-center justify-content-center">{{ $phoneCtaLabel }}</a>
    <span class="btn btn-brand-primary phone-cta-static d-none d-md-inline-flex align-items-center justify-content-center"
          role="text"
          aria-label="Phone number {{ $publicPhoneDisplay }}">
        {{ $publicPhoneDisplay }}
    </span>
@endif
