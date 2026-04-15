@extends('layouts.admin')

@section('title', 'Create Car')

@section('content')
    <h1 class="h3 mb-3">Create Car</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
                @include('admin.cars._form', ['submitLabel' => 'Create Car'])
            </form>
        </div>
    </div>
@endsection
