@php
    $analyticsMeasurementId = config('dealer.analytics_measurement_id');
@endphp

<style>
    .cookie-consent-banner {
        position: fixed;
        left: 50%;
        transform: translateX(-50%);
        bottom: 1.25rem;
        width: min(960px, calc(100% - 1.5rem));
        z-index: 1055;
        background: var(--brand-navbar-bg);
        color: var(--brand-footer-text);
        border: 1px solid var(--brand-panel-border-strong);
        border-radius: 1rem;
        box-shadow: 0 14px 34px rgba(0, 0, 0, 0.34);
    }

    .cookie-consent-banner .cookie-consent-banner__text {
        color: var(--brand-footer-text);
        line-height: 1.45;
        font-size: 1rem;
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
        padding-bottom: clamp(7rem, 20vw, 12rem);
    }

    @media (min-width: 992px) {
        body.cookie-consent-visible main.py-5 {
            padding-bottom: 9rem;
        }
    }

    .cookie-consent-banner .cookie-consent-actions {
        gap: 0.75rem !important;
    }

    .cookie-consent-banner .cookie-consent-actions .btn {
        min-height: 2.75rem;
        padding-left: 1.2rem;
        padding-right: 1.2rem;
        font-weight: 600;
        font-size: 0.95rem;
    }

    @media (max-width: 575.98px) {
        .cookie-consent-banner {
            bottom: 0.9rem;
            width: calc(100% - 1rem);
            border-radius: 0.9rem;
        }

        .cookie-consent-banner .cookie-consent-banner__text {
            font-size: 0.96rem;
        }

        .cookie-consent-banner .cookie-consent-actions {
            width: 100%;
            flex-direction: column;
            align-items: stretch;
        }

        .cookie-consent-banner .cookie-consent-actions .btn {
            width: 100%;
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
    <div class="container-fluid px-3 px-md-4 py-3 py-md-4">
        <div class="row align-items-center g-3">
            <div class="col-lg">
                <p id="cookie-consent-desc" class="cookie-consent-banner__text mb-2 mb-lg-0">
                    {{ __('public.cookie_consent.message') }}
                    <a href="{{ route('cookies') }}" class="cookie-consent-banner__link ms-1">{{ __('public.cookie_consent.cookie_policy') }}</a>
                </p>
            </div>
            <div class="col-lg-auto d-flex flex-wrap justify-content-lg-end cookie-consent-actions">
                <button type="button" class="btn btn-brand-outline" id="cookie-consent-reject">
                    {{ __('public.cookie_consent.reject_non_essential') }}
                </button>
                <button type="button" class="btn btn-brand-primary" id="cookie-consent-accept">
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
