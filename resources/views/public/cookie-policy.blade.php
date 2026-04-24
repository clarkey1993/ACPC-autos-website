@extends('layouts.public')

@section('title', __('public.pages.cookies.title'))
@section('meta_description', __('public.pages.cookies.meta_description'))

@section('content')
    @include('public.partials.static-document', ['pageKey' => 'cookies'])
@endsection
