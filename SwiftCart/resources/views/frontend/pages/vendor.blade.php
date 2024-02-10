@extends('frontend.layout.master')
@section('title', 'vendors')
@section('content')

    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">

        <div class="overlay"></div>
        <div class="container">
            <h1 class="text-white">Vendors</h1>
            <div class="d-flex">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-2 me-2"></i> Vendors </a>
            </div>
        </div>
    </div>
    <div class="container vendors-list my-3">
        <form action="{{ request()->url() }}" class="form-search-vendor">
            <div class="input-group search mb-3 ms-auto">
                <input type="text" name="search" class="form-control shadow-none search-vendor"
                    value = "{{ $search }}" placeholder='search' id="">
                <button type="submit" class="input-group-text"><span><i
                            class="fa-solid fa-magnifying-glass"></i></span></button>
            </div>
        </form>
        <div class="card-body text-center rounded border bg-white mt-3 mb-4 {{ count($vendors) != 0 ? 'd-none' : '' }}">
            <h5 class="text-danger font-weight-bold" style="position:relative; top:4px">Sorry, No Results Found!</h5>
        </div>
        <div class="row gy-4">

            @foreach ($vendors as $vendor)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card position-relative rounded">
                        <img src="{{ asset('storage/upload/' . $vendor->banner) }}" alt=""
                            class="banner rounded img-fluid">
                        <div class="card-body rounded d-flex flex-column justify-content-center">
                            <h4 class="text-white">{{ $vendor->user->name }}</h4>
                            <p class="text-white"><i class="fa-solid fa-shop me-2"></i>{{ $vendor->shop_name }}</p>
                            <p class="text-white"><i class="fa-solid fa-phone me-2"></i> {{ $vendor->phone }}</p>
                            <p class="text-white"><i class="fa-solid fa-envelope me-2"></i>{{ $vendor->email }}</p>
                            <p class="review">
                                @for ($i = 0; $i < round($vendor->reviews_avg_rating); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = round($vendor->reviews_avg_rating); $i < 5; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                                <span class="text-white">({{ $vendor->reviews_count }} review)</span>
                            </p>
                            <div class="social_media d-flex gap-5 mb-3">
                                @if ($vendor->fb_link)
                                    <a href="{{ $vendor->fb_link }}"><i class="fa-brands fa-facebook"></i></a>
                                @endif
                                @if ($vendor->insta_link)
                                    <a href="{{ $vendor->insta_link }}"><i class="fa-brands fa-instagram"></i></a>
                                @endif
                                @if ($vendor->tw_link)
                                    <a href="{{ $vendor->tw_link }}"><i class="fa-brands fa-square-x-twitter"></i></a>
                                @endif
                            </div>
                            <a href = "{{ route('store.index', ['vendor_id' => $vendor->id]) }}"
                                class="btn btn-warning text-white shadow-sm visit-store-btn">Visit Store</a>



                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4 ms-auto" style="width: fit-content">
            {{ $vendors->links() }}
        </div>
    </div>

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection
@push('styles')
    <style>
        .vendors-list{
            min-height: calc(100vh - 610.67px)
        }
        .card::after {
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            z-index: 1;

        }

        .card-body {
            position: relative;
            z-index: 10;

        }

        .banner {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 0;
            width: 100%;
            height: 100%;
        }

        .social_media {
            height: 30px;
        }

        .social_media i {
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            background: white;
            color: black;

        }

        .visit-store-btn {
            width: fit-content
        }

        .pagination {
            background: white
        }

        .pagination .page-item .page-link {
            box-shadow: none !important
        }

        .search {
            max-width: 350px
        }

        .search i {
            cursor: pointer;
        }
    </style>
@endpush
@endsection
