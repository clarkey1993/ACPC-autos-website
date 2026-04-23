@extends('layouts.public')

@section('title', 'Contact Us - ACPC Autos')

@section('content')
    <style>
        .page-contact .contact-option-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 0.75rem;
            max-width: 560px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (min-width: 576px) {
            .page-contact .contact-option-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1rem;
            }
        }

        .page-contact .contact-option {
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            padding: 1rem 1.15rem;
            border-radius: 0.75rem;
            border: 1px solid var(--brand-panel-border);
            background: rgba(255, 255, 255, 0.04);
            color: inherit;
            text-decoration: none;
            text-align: center;
            min-height: 86px;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, background-color 0.2s ease;
        }

        .page-contact a.contact-option:hover,
        .page-contact a.contact-option:focus-visible {
            transform: translateY(-1px);
            border-color: var(--brand-panel-border-strong);
            background: rgba(213, 183, 122, 0.08);
            box-shadow: 0 8px 18px rgba(10, 28, 18, 0.28);
        }

        .page-contact .contact-option-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--brand-gold-light);
            font-weight: 600;
            line-height: 1;
        }

        .page-contact .contact-option-value {
            font-weight: 600;
            color: var(--brand-panel-text);
            font-size: 1rem;
            line-height: 1.2;
            word-break: break-word;
        }
    </style>

    <div class="page-contact">
        <section class="mb-4">
            <div class="contact-hero brand-card rounded-4 p-4 p-md-5">
                <p class="small text-uppercase text-brand-gold fw-semibold mb-2">Contact Us</p>
                <h1 class="h2 mb-2">Speak directly with ACPC Autos</h1>
                <p class="brand-muted mb-0">Book an appointment, ask about availability, or request more details on any vehicle.</p>
            </div>
        </section>

        <section class="mb-4 mb-md-5">
            <div class="contact-shell brand-card rounded-4 p-3 p-md-4 text-center">
                <h2 class="h4 mb-3">Contact options</h2>

                <div class="contact-option-grid">
                    <a href="tel:{{ preg_replace('/\s+/', '', $publicPhoneTel) }}" class="contact-option d-flex d-md-none">
                        <span class="contact-option-label">Phone</span>
                        <span class="contact-option-value">{{ $publicPhoneDisplay }}</span>
                    </a>

                    <div class="contact-option d-none d-md-flex" role="group" aria-label="Phone number">
                        <span class="contact-option-label">Phone</span>
                        <span class="contact-option-value">{{ $publicPhoneDisplay }}</span>
                    </div>

                    <a href="{{ $publicEmailMailto }}" class="contact-option d-flex">
                        <span class="contact-option-label">Email</span>
                        <span class="contact-option-value">{{ $publicEmailDisplay }}</span>
                    </a>
                </div>

                <p class="small brand-muted mb-0 mt-3">Or send us a message using the form below.</p>
            </div>
        </section>

        <section class="mb-2">
            <div class="contact-shell brand-card rounded-4 p-4 p-md-5">
                <h2 class="h4 mb-3">Send a message</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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

                <form method="POST" action="{{ route('contact.submit') }}">
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
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-brand-primary mt-3">Send message</button>
                </form>
            </div>
        </section>
    </div>
@endsection
