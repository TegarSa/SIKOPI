@extends('frontend.layouts.index')

@section('title', 'Beranda - Sistem Informasi Koperasi SIKOPI')

@section('content')
    @include('frontend.homepage.index')
    @include('frontend.homepage.about')
    @include('frontend.homepage.services')
    @include('frontend.homepage.steps')
    @include('frontend.homepage.stats')
    @include('frontend.homepage.news')
@endsection