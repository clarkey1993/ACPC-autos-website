@extends('layouts.public')

@section('title', __('public.pages.terms.title'))
@section('meta_description', __('public.pages.terms.meta_description'))

@section('content')
    @include('public.partials.static-document', ['pageKey' => 'terms'])
@endsection
