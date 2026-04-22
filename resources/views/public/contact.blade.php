@extends('layouts.public')

@section('title', 'Contact Us - ACPC Autos')

@section('content')
    <style>
        .page-contact .contact-shell {
            background: linear-gradient(165deg, #fffefb 0%, #fbf8f2 58%, #f6f1e7 100%);
            border: 1px solid rgba(185, 145, 70, 0.16);
            box-shadow: 0 10px 24px rgba(15, 24, 18, 0.07);
        }

        .page-contact .contact-hero {
            background: linear-gradient(132deg, #fffefb 0%, #fbf8f2 58%, #f5f0e6 100%);
            border: 1px solid rgba(185, 145, 70, 0.2);
            box-shadow: 0 12px 26px rgba(15, 24, 18, 0.08);
        }

        .page-contact .contact-action-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 0.75rem;
        }

        @media (min-width: 576px) {
            .page-contact .contact-action-grid {
                grid-template-columns: minmax(0, 320px);
            }
        }

        @media (prefers-color-scheme: dark) {
            .page-contact .contact-shell {
                background: linear-gradient(168deg, rgba(38, 48, 54, 0.95) 0%, rgba(30, 38, 44, 0.98) 55%, rgba(26, 32, 37, 0.99) 100%);
                border-color: rgba(201, 164, 92, 0.24);
                box-shadow: 0 10px 26px rgba(0, 0, 0, 0.2);
            }

            .page-contact .contact-hero {
                background: linear-gradient(132deg, rgba(36, 46, 52, 0.96) 0%, rgba(26, 33, 39, 0.98) 100%);
                border-color: rgba(201, 164, 92, 0.24);
                box-shadow: 0 10px 26px rgba(0, 0, 0, 0.24);
            }
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
            <div class="contact-shell brand-card rounded-4 p-4">
                <h2 class="h4 mb-3">Contact options</h2>
                <div class="contact-action-grid mb-3">
                    <a href="tel:{{ preg_replace('/\s+/', '', $publicPhoneTel) }}" class="btn btn-brand-primary">Call us</a>
                </div>
                <p class="small brand-muted mb-1">Email: <a class="footer-link fw-semibold" href="{{ $publicEmailMailto }}">{{ $publicEmailDisplay }}</a></p>
                <p class="small brand-muted mb-0">Or send us a message using the form below.</p>
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
