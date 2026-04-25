@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .admin-dashboard {
            display: flex;
            flex-direction: column;
            gap: 1.65rem;
        }

        .admin-dashboard__hero {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.35rem;
            border: 1px solid var(--admin-gold-border);
            border-radius: 1.25rem;
            background:
                linear-gradient(135deg, rgba(24, 69, 45, 0.96), rgba(16, 44, 29, 0.98)),
                radial-gradient(circle at top right, rgba(213, 183, 122, 0.22), transparent 18rem);
            color: var(--admin-cream);
            box-shadow: var(--admin-shadow);
        }

        .admin-dashboard__eyebrow {
            color: var(--admin-gold-light);
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .admin-dashboard__title {
            font-size: clamp(1.8rem, 3vw, 2.55rem);
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .admin-dashboard__intro {
            max-width: 34rem;
            color: rgba(245, 241, 232, 0.78);
        }

        .admin-action-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
            justify-content: flex-end;
        }

        .admin-btn {
            border-radius: 999px;
            padding: 0.62rem 1rem;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(10, 28, 18, 0.16);
        }

        .admin-btn--gold {
            background: linear-gradient(135deg, var(--admin-gold-light), var(--admin-gold));
            border-color: var(--admin-gold);
            color: var(--admin-green-deep);
        }

        .admin-btn--gold:hover,
        .admin-btn--gold:focus {
            background: var(--admin-gold-light);
            border-color: var(--admin-gold-light);
            color: var(--admin-green-deep);
        }

        .admin-btn--green {
            background: rgba(245, 241, 232, 0.08);
            border: 1px solid rgba(213, 183, 122, 0.46);
            color: var(--admin-cream);
        }

        .admin-btn--green:hover,
        .admin-btn--green:focus {
            background: rgba(213, 183, 122, 0.16);
            border-color: var(--admin-gold-light);
            color: var(--admin-cream);
        }

        .admin-stat-card {
            position: relative;
            height: 100%;
            padding: 1.1rem;
            border: 1px solid rgba(185, 145, 70, 0.18);
            border-radius: 1.1rem;
            background: rgba(255, 253, 249, 0.86);
            box-shadow: var(--admin-shadow);
            overflow: hidden;
        }

        .admin-stat-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 4px;
            background: linear-gradient(180deg, var(--admin-gold-light), var(--admin-green));
        }

        .admin-stat-card__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.85rem;
        }

        .admin-stat-card__label {
            margin: 0;
            color: var(--admin-muted);
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .admin-stat-card__icon {
            width: 2.35rem;
            height: 2.35rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.8rem;
            background: rgba(24, 69, 45, 0.08);
            color: var(--admin-green);
        }

        .admin-stat-card__value {
            margin: 0;
            color: var(--admin-green-deep);
            font-size: clamp(2rem, 4vw, 2.7rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1;
        }

        .admin-panel {
            height: 100%;
            border: 1px solid rgba(24, 36, 28, 0.09);
            border-radius: 1.15rem;
            background: rgba(255, 253, 249, 0.9);
            box-shadow: var(--admin-shadow);
            overflow: hidden;
        }

        .admin-panel__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.15rem;
            border-bottom: 1px solid rgba(24, 36, 28, 0.08);
            background: linear-gradient(180deg, rgba(245, 241, 232, 0.72), rgba(255, 253, 249, 0.92));
        }

        .admin-panel__title {
            margin: 0;
            color: var(--admin-green-deep);
            font-size: 1rem;
            font-weight: 800;
        }

        .admin-panel__link {
            color: var(--admin-gold);
            font-size: 0.84rem;
            font-weight: 700;
            text-decoration: none;
        }

        .admin-panel__link:hover,
        .admin-panel__link:focus {
            color: var(--admin-green);
            text-decoration: underline;
        }

        .admin-table {
            margin: 0;
        }

        .admin-table thead th {
            padding: 0.85rem 1.15rem;
            border-bottom: 1px solid rgba(24, 36, 28, 0.08);
            color: var(--admin-muted);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: rgba(245, 241, 232, 0.56);
        }

        .admin-table tbody td {
            padding: 1rem 1.15rem;
            border-bottom: 1px solid rgba(24, 36, 28, 0.07);
            color: var(--admin-text);
        }

        .admin-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .admin-table tbody tr:hover td {
            background-color: rgba(213, 183, 122, 0.08);
        }

        .admin-table__primary {
            font-weight: 750;
        }

        .admin-table__muted {
            color: var(--admin-muted);
            font-size: 0.86rem;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 0.3rem 0.62rem;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .admin-badge--read,
        .admin-badge--status {
            background: rgba(24, 69, 45, 0.1);
            color: var(--admin-green);
        }

        .admin-badge--new {
            background: rgba(213, 183, 122, 0.24);
            color: #72521c;
        }

        .admin-table-action {
            border-color: rgba(185, 145, 70, 0.48);
            border-radius: 999px;
            color: var(--admin-green);
            font-weight: 700;
            padding-inline: 0.85rem;
        }

        .admin-table-action:hover,
        .admin-table-action:focus {
            background: var(--admin-green);
            border-color: var(--admin-green);
            color: var(--admin-cream);
        }

        @media (max-width: 767.98px) {
            .admin-dashboard__hero {
                align-items: stretch;
                flex-direction: column;
            }

            .admin-action-group {
                justify-content: flex-start;
            }

            .admin-btn {
                flex: 1 1 auto;
                text-align: center;
            }

            .admin-table thead th,
            .admin-table tbody td {
                padding: 0.85rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="admin-dashboard">
        <section class="admin-dashboard__hero">
            <div>
                <div class="admin-dashboard__eyebrow mb-2">Admin overview</div>
                <h1 class="admin-dashboard__title mb-2">Dashboard</h1>
                <p class="admin-dashboard__intro mb-0">Overview of stock and customer enquiries.</p>
            </div>
            <div class="admin-action-group">
                <a href="{{ route('admin.cars.index') }}" class="btn admin-btn admin-btn--gold">Manage Cars</a>
                <a href="{{ route('admin.enquiries.index') }}" class="btn admin-btn admin-btn--green">All Enquiries</a>
            </div>
        </section>

        <section class="row g-3">
            <div class="col-6 col-md-4 col-xl-2">
                <div class="admin-stat-card">
                    <div class="admin-stat-card__top">
                        <h2 class="admin-stat-card__label">Total Cars</h2>
                        <span class="admin-stat-card__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362a2.5 2.5 0 0 1 2.298 1.515l.792 1.848c.075.175.12.358.136.544A2 2 0 0 1 16 7.864V10.5a.5.5 0 0 1-.5.5H15v1.5a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5V11H3v1.5a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5V11H.5a.5.5 0 0 1-.5-.5V7.864a2 2 0 0 1 1.592-1.957 2.4 2.4 0 0 1 .136-.544zM4.82 3a1.5 1.5 0 0 0-1.379.91L2.65 5.76c-.03.07-.05.143-.061.218h10.823a1.4 1.4 0 0 0-.06-.218l-.793-1.85A1.5 1.5 0 0 0 11.18 3zM2.5 8a.5.5 0 1 0 0 1 .5.5 0 0 0 0-1m11 0a.5.5 0 1 0 0 1 .5.5 0 0 0 0-1"/>
                            </svg>
                        </span>
                    </div>
                    <p class="admin-stat-card__value">{{ $totalCars }}</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="admin-stat-card">
                    <div class="admin-stat-card__top">
                        <h2 class="admin-stat-card__label">Available</h2>
                        <span class="admin-stat-card__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M13.485 1.929a1 1 0 0 1 1.414 1.414l-8.25 8.25a1 1 0 0 1-1.414 0l-4.134-4.134a1 1 0 1 1 1.414-1.414l3.427 3.427z"/>
                            </svg>
                        </span>
                    </div>
                    <p class="admin-stat-card__value">{{ $availableCars }}</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="admin-stat-card">
                    <div class="admin-stat-card__top">
                        <h2 class="admin-stat-card__label">Reserved</h2>
                        <span class="admin-stat-card__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 1.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0m.75 4a.75.75 0 0 0-1.5 0v4c0 .2.08.39.22.53l2.5 2.5a.75.75 0 1 0 1.06-1.06L8.75 8.19z"/>
                            </svg>
                        </span>
                    </div>
                    <p class="admin-stat-card__value">{{ $reservedCars }}</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="admin-stat-card">
                    <div class="admin-stat-card__top">
                        <h2 class="admin-stat-card__label">Sold</h2>
                        <span class="admin-stat-card__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2 2a1 1 0 0 0-1 1v10l2.2-1.65a1 1 0 0 1 1.2 0L6.6 13l2.2-1.65a1 1 0 0 1 1.2 0L12.2 13l2.8-2.1V3a1 1 0 0 0-1-1zm3 3h6v1H5zm0 2h6v1H5zm0 2h4v1H5z"/>
                            </svg>
                        </span>
                    </div>
                    <p class="admin-stat-card__value">{{ $soldCars }}</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="admin-stat-card">
                    <div class="admin-stat-card__top">
                        <h2 class="admin-stat-card__label">Enquiries</h2>
                        <span class="admin-stat-card__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-.5a.5.5 0 0 0-.5.5v.217l6.5 3.9 6.5-3.9V4a.5.5 0 0 0-.5-.5zm12.5 2.466-4.977 2.986 4.977 3.11zm-.55 6.534L8.75 9.25a1.5 1.5 0 0 1-1.5 0l-5.2 3.25A.5.5 0 0 0 2 12.5h12a.5.5 0 0 0-.05 0M1.5 12.062l4.977-3.11L1.5 5.966z"/>
                            </svg>
                        </span>
                    </div>
                    <p class="admin-stat-card__value">{{ $totalEnquiries }}</p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="admin-stat-card">
                    <div class="admin-stat-card__top">
                        <h2 class="admin-stat-card__label">Unread</h2>
                        <span class="admin-stat-card__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 1.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0m.75 4.25a.75.75 0 0 0-1.5 0v4.5a.75.75 0 0 0 1.5 0zm0 7a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0"/>
                            </svg>
                        </span>
                    </div>
                    <p class="admin-stat-card__value">{{ $unreadEnquiries }}</p>
                </div>
            </div>
        </section>

        <section class="row g-4">
            <div class="col-lg-6">
                <div class="admin-panel">
                    <div class="admin-panel__header">
                        <h2 class="admin-panel__title">Recent Enquiries</h2>
                        <a href="{{ route('admin.enquiries.index') }}" class="admin-panel__link">View all</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle admin-table">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Car</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentEnquiries as $enquiry)
                                    <tr>
                                        <td>
                                            <div class="admin-table__primary mb-1">{{ $enquiry->name }}</div>
                                            @if ($enquiry->is_read)
                                                <span class="admin-badge admin-badge--read">Read</span>
                                            @else
                                                <span class="admin-badge admin-badge--new">New</span>
                                            @endif
                                        </td>
                                        <td class="admin-table__muted">{{ $enquiry->car?->title ?? '—' }}</td>
                                        <td class="text-nowrap admin-table__muted">{{ $enquiry->created_at->format('M j, Y') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm admin-table-action">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center admin-table__muted py-4">No enquiries yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="admin-panel">
                    <div class="admin-panel__header">
                        <h2 class="admin-panel__title">Recent Cars</h2>
                        <a href="{{ route('admin.cars.index') }}" class="admin-panel__link">View all</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle admin-table">
                            <thead>
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
                                        <td class="admin-table__primary">{{ $car->title }}</td>
                                        <td>
                                            <span class="admin-badge admin-badge--status">{{ ucfirst($car->status) }}</span>
                                        </td>
                                        <td class="text-nowrap admin-table__muted">€{{ number_format($car->price) }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-sm admin-table-action">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center admin-table__muted py-4">No cars yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
