@extends('frontend.layouts.index')

@section('title', 'Layanan Simpanan & Kalkulator - SIKOPI')

@section('content')
    @include('frontend.services.savings_hero')
    @include('frontend.services.savings_calculator')
    @include('frontend.services.savings_workflow')
@endsection