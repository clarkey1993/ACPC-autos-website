@extends('layouts.public')

@section('title', __('public.pages.warranty.title'))
@section('meta_description', __('public.pages.warranty.meta_description'))

@section('content')
    @include('public.partials.static-document', ['pageKey' => 'warranty'])
@endsection
