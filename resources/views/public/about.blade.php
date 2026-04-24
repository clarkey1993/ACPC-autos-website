@extends('layouts.public')

@section('title', __('public.about.title'))
@section('meta_description', __('public.about.meta_description'))

@section('content')
    <style>
        .page-about .about-eyebrow {
            letter-spacing: 0.11em;
        }

        .page-about .about-bullet {
            width: 0.38rem;
            height: 0.38rem;
            border-radius: 999px;
            background: var(--brand-gold-light);
            margin-top: 0.42rem;
            flex-shrink: 0;
            opacity: 0.95;
        }
    </style>

    <div class="page-about">
        <section class="mb-4">
            <div class="about-hero brand-card rounded-4 p-4 p-md-5">
                <p class="small text-uppercase text-brand-gold fw-semibold mb-2 about-eyebrow">{{ __('public.about.eyebrow') }}</p>
                <h1 class="h2 mb-2">{{ __('public.about.hero_title') }}</h1>
                <p class="brand-muted mb-0">
                    {{ __('public.about.hero_text') }}
                </p>
            </div>
        </section>

        <section class="mb-4 mb-md-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="about-panel brand-card rounded-4 p-4 h-100">
                        <h2 class="h4 mb-3">{{ __('public.about.mission_title') }}</h2>
                        <p class="brand-muted mb-0">
                            {{ __('public.about.mission_text') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-panel brand-card rounded-4 p-4 h-100">
                        <h2 class="h4 mb-3">{{ __('public.about.why_buy_title') }}</h2>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex gap-2 mb-2"><span class="about-bullet" aria-hidden="true"></span><span class="brand-muted">{{ __('public.about.point_1') }}</span></li>
                            <li class="d-flex gap-2 mb-2"><span class="about-bullet" aria-hidden="true"></span><span class="brand-muted">{{ __('public.about.point_2') }}</span></li>
                            <li class="d-flex gap-2 mb-0"><span class="about-bullet" aria-hidden="true"></span><span class="brand-muted">{{ __('public.about.point_3') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-4 mb-md-5">
            <div class="about-panel brand-card rounded-4 p-4 p-md-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <h2 class="h4 mb-3">{{ __('public.about.selected_title') }}</h2>
                        <p class="brand-muted mb-0">
                            {{ __('public.about.selected_text') }}
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <h2 class="h5 mb-3">{{ __('public.about.personal_title') }}</h2>
                        <p class="brand-muted mb-2">{{ __('public.about.personal_text_1') }}</p>
                        <p class="brand-muted mb-0">{{ __('public.about.personal_text_2') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-2">
            <div class="about-panel brand-card rounded-4 p-4 text-center">
                <p class="text-uppercase small text-brand-gold fw-semibold mb-2">{{ __('public.about.cta_eyebrow') }}</p>
                <h2 class="h4 mb-2">{{ __('public.about.cta_title') }}</h2>
                <p class="brand-muted mb-3">{{ __('public.about.cta_text') }}</p>
                <a href="{{ $publicDedicatedCarsPageEnabled ? route('cars.index') : route('home') }}" class="btn btn-brand-primary">
                    {{ $publicDedicatedCarsPageEnabled ? __('public.buttons.browse_cars') : __('public.buttons.view_current_stock') }}
                </a>
            </div>
        </section>
    </div>
@endsection
