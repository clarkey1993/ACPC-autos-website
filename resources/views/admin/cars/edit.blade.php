@extends('layouts.admin')

@section('title', 'Edit Car')

@section('content')
    <h1 class="h3 mb-3">Edit Car</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.cars._form', ['submitLabel' => 'Update Car'])
            </form>
        </div>
    </div>
@endsection
