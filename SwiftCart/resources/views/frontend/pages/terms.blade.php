@extends('frontend.layout.master')
@section('title', 'terms and conditions')
@section('content')

    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <h1 class="text-white">Terms And Conditions</h1>
            <div class="d-flex">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i> Terms And Conditions </a>
            </div>
        </div>
    </div>

    <section class="container my-3">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-3" style="position: relative; top:8px">Terms And Conditions</h4>
                </div>
                <div class="card-body">
                    <p>{!! $terms->content !!}</p>
                </div>
            </div>
        </div>
    </section>

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection

@endsection
