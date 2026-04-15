@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="h3 mb-4">Dashboard</h1>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Total Cars</h2>
                    <p class="display-6 mb-0">{{ $totalCars }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Available Cars</h2>
                    <p class="display-6 mb-0">{{ $availableCars }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h6 text-muted mb-2">Sold Cars</h2>
                    <p class="display-6 mb-0">{{ $soldCars }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
