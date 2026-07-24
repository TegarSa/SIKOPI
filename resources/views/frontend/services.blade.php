@extends('frontend.layouts.index')

@section('title', 'Layanan Pinjaman & Simulasi - SIKOPI')

@section('content')
    @include('frontend.services.loan_hero')
    @include('frontend.services.loan_calculator')
    @include('frontend.services.loan_terms')
@endsection