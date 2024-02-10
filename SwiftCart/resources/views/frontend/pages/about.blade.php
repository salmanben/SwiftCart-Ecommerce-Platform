@extends('frontend.layout.master')
@section('title', 'about')
@section('content')
    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <h1 class="text-white">About</h1>
            <div class="d-flex">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i> About </a>
            </div>
        </div>
    </div>

    <div class="container about-container my-3">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-3" style="position: relative; top:8px">About</h4>
            </div>
            <div class="card-body">
                <p>{!! $about->content !!}</p>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .about-container {
                min-height: calc(100vh - 610.67px);
            }
        </style>
    @endpush
@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection

@endsection
