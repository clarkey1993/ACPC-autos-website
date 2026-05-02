@php
    $analyticsMeasurementId = config('dealer.analytics_measurement_id');
@endphp

<style>
    .cookie-consent-banner {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1055;
        background: var(--brand-navbar-bg);
        color: var(--brand-footer-text);
        border-top: 1px solid var(--brand-gold-border);
        box-shadow: 0 -8px 28px rgba(0, 0, 0, 0.22);
    }

    .cookie-consent-banner .cookie-consent-banner__text {
        color: var(--brand-footer-text);
        line-height: 1.45;
    }

    .cookie-consent-banner .cookie-consent-banner__link {
        color: var(--brand-gold-light);
        text-decoration: underline;
        text-underline-offset: 2px;
    }

    .cookie-consent-banner .cookie-consent-banner__link:hover,
    .cookie-consent-banner .cookie-consent-banner__link:focus {
        color: #fff;
    }

    body.cookie-consent-visible main.py-5 {
        padding-bottom: clamp(6rem, 18vw, 11rem);
    }

    @media (min-width: 992px) {
        body.cookie-consent-visible main.py-5 {
            padding-bottom: 7.5rem;
        }
    }
</style>

<div
    id="cookie-consent-banner"
    class="cookie-consent-banner"
    role="dialog"
    aria-modal="false"
    aria-label="{{ __('public.cookie_consent.aria_banner') }}"
    hidden
>
    <div class="container py-3 py-md-3">
        <div class="row align-items-center g-3">
            <div class="col-lg">
                <p id="cookie-consent-desc" class="cookie-consent-banner__text small mb-2 mb-lg-0">
                    {{ __('public.cookie_consent.message') }}
                    <a href="{{ route('cookies') }}" class="cookie-consent-banner__link ms-1">{{ __('public.cookie_consent.cookie_policy') }}</a>
                </p>
            </div>
            <div class="col-lg-auto d-flex flex-wrap gap-2 justify-content-lg-end">
                <button type="button" class="btn btn-brand-outline btn-sm px-3" id="cookie-consent-reject">
                    {{ __('public.cookie_consent.reject_non_essential') }}
                </button>
                <button type="button" class="btn btn-brand-primary btn-sm px-3" id="cookie-consent-accept">
                    {{ __('public.cookie_consent.accept_all') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var STORAGE_KEY = 'acpc_cookie_consent';
        var COOKIE_MAX_AGE = 365 * 24 * 60 * 60;
        var VALUES = { all: 'all', essential: 'essential' };
        var measurementId = @json($analyticsMeasurementId ? (string) $analyticsMeasurementId : null);

        function storageGet() {
            try {
                var fromLs = window.localStorage.getItem(STORAGE_KEY);
                if (fromLs) {
                    return fromLs;
                }
            } catch (e) {
                /* ignore */
            }
            var match = document.cookie.match(
                new RegExp('(?:^|;\\s*)' + STORAGE_KEY.replace(/[-[\]/{}()*+?.\\^$|]/g, '\\$&') + '=([^;]*)')
            );
            return match ? decodeURIComponent(match[1]) : null;
        }

        function storageSet(value) {
            try {
                window.localStorage.setItem(STORAGE_KEY, value);
            } catch (e) {
                /* ignore */
            }
            try {
                document.cookie =
                    STORAGE_KEY +
                    '=' +
                    encodeURIComponent(value) +
                    ';path=/;max-age=' +
                    COOKIE_MAX_AGE +
                    ';SameSite=Lax';
            } catch (e2) {
                /* ignore */
            }
        }

        function loadAnalytics() {
            if (!measurementId || window.__acpcAnalyticsLoaded) {
                return;
            }
            window.__acpcAnalyticsLoaded = true;
            var s = document.createElement('script');
            s.async = true;
            s.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(measurementId);
            document.head.appendChild(s);
            s.onload = function () {
                window.dataLayer = window.dataLayer || [];
                function gtag() {
                    dataLayer.push(arguments);
                }
                window.gtag = gtag;
                gtag('js', new Date());
                gtag('config', measurementId);
            };
        }

        function hideBanner(banner) {
            banner.setAttribute('hidden', '');
            document.body.classList.remove('cookie-consent-visible');
        }

        function showBanner(banner) {
            banner.removeAttribute('hidden');
            document.body.classList.add('cookie-consent-visible');
        }

        var banner = document.getElementById('cookie-consent-banner');
        var btnAccept = document.getElementById('cookie-consent-accept');
        var btnReject = document.getElementById('cookie-consent-reject');
        if (!banner || !btnAccept || !btnReject) {
            return;
        }

        var existing = storageGet();
        if (existing === VALUES.all) {
            loadAnalytics();
            return;
        }
        if (existing === VALUES.essential) {
            return;
        }

        showBanner(banner);

        btnAccept.addEventListener('click', function () {
            storageSet(VALUES.all);
            loadAnalytics();
            hideBanner(banner);
        });

        btnReject.addEventListener('click', function () {
            storageSet(VALUES.essential);
            hideBanner(banner);
        });
    })();
</script>
