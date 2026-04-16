@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Site Settings</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <p class="text-muted small mb-4">
                These details appear in the public site footer and contact areas. There is only one row of settings for the whole site.
            </p>

            <form method="post" action="{{ route('admin.site-settings.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="business_phone" class="form-label">Business phone</label>
                    <input type="text" name="business_phone" id="business_phone"
                           class="form-control @error('business_phone') is-invalid @enderror"
                           value="{{ old('business_phone', $settings->business_phone) }}"
                           placeholder="+353 87 000 0000">
                    @error('business_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Shown on the site; used for click-to-call links.</div>
                </div>

                <div class="mb-3">
                    <label for="business_email" class="form-label">Business email</label>
                    <input type="email" name="business_email" id="business_email"
                           class="form-control @error('business_email') is-invalid @enderror"
                           value="{{ old('business_email', $settings->business_email) }}"
                           placeholder="sales@example.com">
                    @error('business_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="whatsapp_number" class="form-label">WhatsApp number</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number"
                           class="form-control @error('whatsapp_number') is-invalid @enderror"
                           value="{{ old('whatsapp_number', $settings->whatsapp_number) }}"
                           placeholder="353870000000">
                    @error('whatsapp_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Digits only (country code + number, no + or spaces). Non-digits are removed when you save.</div>
                </div>

                <div class="mb-4">
                    <label for="opening_hours_text" class="form-label">Appointments / opening text</label>
                    <textarea name="opening_hours_text" id="opening_hours_text" rows="3"
                              class="form-control @error('opening_hours_text') is-invalid @enderror"
                              placeholder="Viewings by appointment only">{{ old('opening_hours_text', $settings->opening_hours_text) }}</textarea>
                    @error('opening_hours_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Shown under “Appointments” in the public footer.</div>
                </div>

                <button type="submit" class="btn btn-primary">Save settings</button>
            </form>
        </div>
    </div>
@endsection
