@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Dashboard</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-primary btn-sm">Manage Cars</a>
            <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary btn-sm">All Enquiries</a>
        </div>
    </div>

    <p class="text-muted mb-4">Overview of stock and customer enquiries.</p>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm h-100 border-start border-primary border-4">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Total Cars</h2>
                    <p class="h2 mb-0">{{ $totalCars }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm h-100 border-start border-success border-4">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Available</h2>
                    <p class="h2 mb-0">{{ $availableCars }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm h-100 border-start border-warning border-4">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Reserved</h2>
                    <p class="h2 mb-0">{{ $reservedCars }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm h-100 border-start border-secondary border-4">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Sold</h2>
                    <p class="h2 mb-0">{{ $soldCars }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm h-100 border-start border-info border-4">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Enquiries</h2>
                    <p class="h2 mb-0">{{ $totalEnquiries }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm h-100 border-start border-danger border-4">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Unread</h2>
                    <p class="h2 mb-0">{{ $unreadEnquiries }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Recent Enquiries</span>
                    <a href="{{ route('admin.enquiries.index') }}" class="small">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Customer</th>
                                <th>Car</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentEnquiries as $enquiry)
                                <tr class="{{ $enquiry->is_read ? '' : 'table-warning' }}">
                                    <td>
                                        {{ $enquiry->name }}
                                        <div>
                                            @if ($enquiry->is_read)
                                                <span class="badge text-bg-secondary">Read</span>
                                            @else
                                                <span class="badge text-bg-warning">New</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $enquiry->car?->title ?? '—' }}</td>
                                    <td class="text-nowrap small">{{ $enquiry->created_at->format('M j, Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No enquiries yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Recent Cars</span>
                    <a href="{{ route('admin.cars.index') }}" class="small">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentCars as $car)
                                <tr>
                                    <td>{{ $car->title }}</td>
                                    <td>
                                        <span class="badge text-bg-secondary">{{ ucfirst($car->status) }}</span>
                                    </td>
                                    <td class="text-nowrap">€{{ number_format($car->price) }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No cars yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
