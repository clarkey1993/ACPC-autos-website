@extends('layouts.public')

@section('title', __('public.pages.privacy.title'))
@section('meta_description', __('public.pages.privacy.meta_description'))

@section('content')
    @include('public.partials.static-document', ['pageKey' => 'privacy'])
@endsection
