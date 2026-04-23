@extends('layouts.public')

@section('title', 'About Us - ACPC Autos')

@section('content')
    <style>
        .page-about .about-hero {
            background: linear-gradient(132deg, #fffefb 0%, #fbf8f2 58%, #f5f0e6 100%);
            border: 1px solid rgba(185, 145, 70, 0.2);
            box-shadow: 0 12px 26px rgba(15, 24, 18, 0.08);
        }

        .page-about .about-panel {
            background: linear-gradient(165deg, #fffefb 0%, #fbf8f2 58%, #f6f1e7 100%);
            border: 1px solid rgba(185, 145, 70, 0.16);
            box-shadow: 0 10px 24px rgba(15, 24, 18, 0.07);
        }

        .page-about .about-eyebrow {
            letter-spacing: 0.11em;
        }

        .page-about .about-bullet {
            width: 0.38rem;
            height: 0.38rem;
            border-radius: 999px;
            background: var(--brand-gold);
            margin-top: 0.42rem;
            flex-shrink: 0;
            opacity: 0.9;
        }

        @media (prefers-color-scheme: dark) {
            .page-about .about-hero {
                background: linear-gradient(132deg, rgba(36, 46, 52, 0.96) 0%, rgba(26, 33, 39, 0.98) 100%);
                border-color: rgba(201, 164, 92, 0.24);
                box-shadow: 0 10px 26px rgba(0, 0, 0, 0.24);
            }

            .page-about .about-panel {
                background: linear-gradient(168deg, rgba(38, 48, 54, 0.95) 0%, rgba(30, 38, 44, 0.98) 55%, rgba(26, 32, 37, 0.99) 100%);
                border-color: rgba(201, 164, 92, 0.24);
                box-shadow: 0 10px 26px rgba(0, 0, 0, 0.2);
            }
        }
    </style>

    <div class="page-about">
        <section class="mb-4">
            <div class="about-hero brand-card rounded-4 p-4 p-md-5">
                <p class="small text-uppercase text-brand-gold fw-semibold mb-2 about-eyebrow">About ACPC Autos</p>
                <h1 class="h2 mb-2">A premium, personal dealership experience in Malaga</h1>
                <p class="brand-muted mb-0">
                    We focus on quality over volume: carefully selected vehicles, transparent information, and one-to-one service from first enquiry to handover.
                </p>
            </div>
        </section>

        <section class="mb-4 mb-md-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="about-panel brand-card rounded-4 p-4 h-100">
                        <h2 class="h4 mb-3">Our mission</h2>
                        <p class="brand-muted mb-0">
                            To make buying a premium used car straightforward, confident, and genuinely enjoyable with honest guidance and carefully prepared stock.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-panel brand-card rounded-4 p-4 h-100">
                        <h2 class="h4 mb-3">Why buy from us</h2>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex gap-2 mb-2"><span class="about-bullet" aria-hidden="true"></span><span class="brand-muted">Hand-picked premium vehicles with clear provenance</span></li>
                            <li class="d-flex gap-2 mb-2"><span class="about-bullet" aria-hidden="true"></span><span class="brand-muted">Clear pricing and direct, no-pressure communication</span></li>
                            <li class="d-flex gap-2 mb-0"><span class="about-bullet" aria-hidden="true"></span><span class="brand-muted">Personal support before and after your purchase</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-4 mb-md-5">
            <div class="about-panel brand-card rounded-4 p-4 p-md-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <h2 class="h4 mb-3">Carefully selected vehicles</h2>
                        <p class="brand-muted mb-0">
                            Every vehicle is chosen for condition, quality, and long-term value. We keep stock intentionally curated so every listing receives proper attention and detailed presentation.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <h2 class="h5 mb-3">Personal service</h2>
                        <p class="brand-muted mb-2">Viewings are by appointment, giving you dedicated time with our team and each vehicle.</p>
                        <p class="brand-muted mb-0">Based in Malaga, we offer an approachable premium service for local and international buyers.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-2">
            <div class="about-panel brand-card rounded-4 p-4 text-center">
                <p class="text-uppercase small text-brand-gold fw-semibold mb-2">Ready to explore our stock?</p>
                <h2 class="h4 mb-2">Browse current vehicles</h2>
                <p class="brand-muted mb-3">Discover our latest hand-picked arrivals and speak with us directly for availability.</p>
                <a href="{{ $publicDedicatedCarsPageEnabled ? route('cars.index') : route('home') }}" class="btn btn-brand-primary">
                    {{ $publicDedicatedCarsPageEnabled ? 'Browse Cars' : 'View Current Stock' }}
                </a>
            </div>
        </section>
    </div>
@endsection
