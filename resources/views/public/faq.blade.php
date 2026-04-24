@extends('layouts.public')

@section('title', __('public.pages.faq.title'))
@section('meta_description', __('public.pages.faq.meta_description'))

@section('content')
    @include('public.partials.static-document', ['pageKey' => 'faq'])
@endsection
