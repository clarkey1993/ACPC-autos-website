@extends('layouts.admin')

@section('title', 'Cars')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Cars</h1>
        <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">Create Car</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cars as $car)
                        <tr>
                            <td>
                                @if ($car->featured_image)
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($car->featured_image) }}"
                                        alt="{{ $car->title }}"
                                        class="img-thumbnail"
                                        style="width: 70px; height: 50px; object-fit: cover;"
                                    >
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </td>
                            <td>{{ $car->title }}</td>
                            <td>{{ $car->make }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->year }}</td>
                            <td>€{{ number_format($car->price) }}</td>
                            <td>
                                <span class="badge text-bg-secondary">{{ $car->cardStatusLabel() }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this car?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No cars found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Showing {{ $cars->firstItem() ?? 0 }} to {{ $cars->lastItem() ?? 0 }} of {{ $cars->total() }} cars
        </small>
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>
@endsection
