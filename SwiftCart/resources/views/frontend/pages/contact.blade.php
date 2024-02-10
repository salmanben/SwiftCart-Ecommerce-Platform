@extends('frontend.layout.master')
@section('title', 'contact')
@section('content')
    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay">
        </div>
        <div class="container">
            <h1 class="text-white">Contact</h1>
            <div class="d-flex align-items-center">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i>
                    Contact
                </a>
            </div>
        </div>
    </div>
    <div class="container contact-container my-3">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8  col-md-6 col-lg-5 col-xl-4">
                <div>
                    <p class="mb-3 rounded border p-3" style="font-size: 18px !important; word-break:break-all"><i
                            class="fa-solid fa-envelope me-3 text-warning"></i>{{ @$general_setting->contact_email }}</p>
                    <p class="rounded border p-3" style="font-size: 18px !important; word-break:break-all"><i
                            class="fa-solid fa-phone me-3 text-warning"></i>{{ @$general_setting->contact_phone }}</p>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-6">
                <div class="card-body rounded border">
                    <form action="{{ route('contact.store') }}" method = "post">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control shadow-none" name="name"
                                value = "{{ old('name') }}" placeholder="name" id="">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control shadow-none" name="email"
                                value = "{{ old('email') }}" placeholder="email" id="">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" class="form-control shadow-none" name="phone"
                                value = "{{ old('phone') }}" placeholder="phone" id="">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="message" id="" cols="30" rows="10" class="form-control shadow-none"
                                placeholder="message" style="height: 150px; resize:none">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning text-white">submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @push('styles')
        <style>
            .contact-container {
                min-height: calc(100vh - 610.67px);
            }
        </style>
    @endpush
@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection

@endsection
