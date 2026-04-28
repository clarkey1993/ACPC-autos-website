@extends('layouts.admin')

@section('title', 'Enquiry Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Enquiry Details</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary btn-sm">Back to Enquiries</a>
            <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}" onsubmit="return confirm('Delete this enquiry? This cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="h5 mb-3">Customer Details</h2>
                    <p class="mb-2"><strong>Name:</strong> {{ $enquiry->name }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $enquiry->email }}</p>
                    <p class="mb-2"><strong>Phone:</strong> {{ $enquiry->phone ?: 'N/A' }}</p>
                    <p class="mb-2">
                        <strong>Status:</strong>
                        @if ($enquiry->is_read)
                            <span class="badge text-bg-secondary">Read</span>
                        @else
                            <span class="badge text-bg-warning">New</span>
                        @endif
                    </p>
                    <p class="mb-0"><strong>Received:</strong> {{ $enquiry->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="h5 mb-3">Enquiry Type</h2>
                    @if ($enquiry->car)
                        <p class="mb-2"><strong>Title:</strong> {{ $enquiry->car->title }}</p>
                        <p class="mb-2"><strong>Make:</strong> {{ $enquiry->car->make }}</p>
                        <p class="mb-2"><strong>Model:</strong> {{ $enquiry->car->model }}</p>
                        <p class="mb-2"><strong>Year:</strong> {{ $enquiry->car->year }}</p>
                        <p class="mb-0"><strong>Price:</strong> €{{ number_format($enquiry->car->price) }}</p>
                    @else
                        <p class="text-muted mb-0">General enquiry</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h5 mb-0">Message</h2>
                        @unless ($enquiry->is_read)
                            <form method="POST" action="{{ route('admin.enquiries.read', $enquiry) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Mark as Read</button>
                            </form>
                        @endunless
                    </div>
                    <p class="mb-0" style="white-space: pre-wrap;">{{ $enquiry->message }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
