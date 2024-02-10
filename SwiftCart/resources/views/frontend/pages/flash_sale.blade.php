@extends('frontend.layout.master')
@section('title', 'flash sale')
@section('content')
    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <h1 class="text-white">Flash Sale</h1>
            <div class="d-flex">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i> Flash Sale </a>
            </div>
        </div>
    </div>
    <div class="container flash-sale-container my-3">
        <div class="row gy-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        <div class="mt-4 ms-auto" style="width: fit-content">
            {{ $products->links() }}
        </div>

    </div>
    @push('styles')
        <style>
            .flash-sale-container {
                min-height: calc(100vh - 610.67px)
            }

            .pagination {
                background: white
            }

            .pagination .page-item .page-link {
                box-shadow: none !important
            }
        </style>
    @endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/product_card.css') }}">
@endsection
@push('scripts')
    <script>
        var aImage = document.querySelectorAll(".product .a-image");
        aImage.forEach(e => {
            var images = e.querySelectorAll('img');
            if (images.length === 2) {
                images[0].addEventListener('mouseover', hoverImage);

                function hoverImage() {
                    images[0].style.opacity = 0
                    images[1].style.opacity = 1
                }
                e.onmouseleave = () => {
                    images[1].style.opacity = 0
                    images[0].style.opacity = 1
                };
            }
        });
    </script>
@endpush

@endsection
