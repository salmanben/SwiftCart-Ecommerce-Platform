@extends('frontend.layout.master')
@section('title', $shop_name)
@section('content')

    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <h1 class="text-white">{{$shop_name}}</h1>
            <div class="d-flex">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i> {{$shop_name}} </a>
            </div>
        </div>
    </div>

    <div class="container my-3 product_filter">
        @if ($product_filter_banner && $product_filter_banner->banner1->status)
            <div class="banner mb-3">
                <a href="{{ $product_filter_banner->banner1->url }}" class="d-block">
                    <img src="{{ asset('storage/upload/' . $product_filter_banner->banner1->image) }}" class="rounded"
                        style="display:block;height: 200px; width:100%" alt="">
                </a>
            </div>
        @endif
        <div class="card-body text-center rounded border bg-white mt-3 mb-4 {{ count($products) != 0 ? 'd-none' : '' }}">
            <h5 class="text-danger font-weight-bold" style="position:relative; top:4px">Sorry, No Results Found!</h5>
        </div>
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="bg-white shadow-sm p-3 rounded">
                    <a class="text-white title-menu bg-info d-lg-none d-flex justify-content-between align-items-center fs-6 p-2 rounded"
                        data-bs-toggle="collapse" href="#collapse_filter" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample1">
                        <span>Filter</span> <span><i class="fa-solid fa-caret-down"></i></span>
                    </a>
                    <div class="collapse show mt-3" id="collapse_filter">
                        <div class="">
                            <a class="text-white title-menu bg-warning d-flex justify-content-between align-items-center fs-6 p-2 rounded"
                                data-bs-toggle="collapse" href="#collapse_cat" role="button" aria-expanded="false"
                                aria-controls="multiCollapseExample1">
                                <span>Categories</span> <span><i class="fa-solid fa-caret-down"></i></span>
                            </a>
                            <div class="collapse show" id="collapse_cat">
                                <ul class=" mt-3">
                                    <li class="dropdown nav-item position-static mb-2">
                                        <a class="text-body fs-6 {{ !request()->has('category') || request('category') == 'all' ? 'active' : '' }}"
                                            href="{{ route('store.index', ['category' => 'all', 'vendor_id'=>$vendor_id]) }}">
                                            All
                                        </a>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li class="dropdown nav-item position-static mb-2">
                                            <a class="text-body fs-6 {{ request()->has('category') && request('category') == $category->name ? 'active' : '' }}"
                                                href="{{ route('store.index', ['category' => $category->name, 'vendor_id'=>$vendor_id])}}">
                                                {{ $category->name }}

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                        <form action="{{ route('store.index', request('vendor_id'))}}" class="filter-form" method="GET">
                            <input type="hidden" name="vendor_id" value="{{$vendor_id}}">
                            <div class="mt-4 brands">
                                <a class="text-white title-menu bg-warning d-flex justify-content-between align-items-center fs-6 p-2 rounded"
                                    data-bs-toggle="collapse" href="#collapse_brand" role="button" aria-expanded="false"
                                    aria-controls="multiCollapseExample1">
                                    <span>Brand</span> <span><i class="fa-solid fa-caret-down"></i></span>
                                </a>
                                <div class="collapse show" id="collapse_brand">
                                    @foreach ($brands as $brand)
                                        <div class="d-flex align-items-center mt-3">
                                            <input type="checkbox" name="brand[]" value="{{ $brand->name }}"
                                                id="brand{{ $brand->name }}"
                                                {{ in_array($brand->name, request('brand', [])) ? 'checked' : '' }}>
                                            <label for="brand{{ $brand->name }}"
                                                class="form-label ms-3 text-muted">{{ $brand->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="mt-4">
                                <a class="text-white title-menu bg-warning d-flex justify-content-between align-items-center fs-6 p-2 rounded"
                                    data-bs-toggle="collapse" href="#collapse_price" role="button" aria-expanded="false"
                                    aria-controls="multiCollapseExample1">
                                    <span>Price</span> <span><i class="fa-solid fa-caret-down"></i></span>
                                </a>
                                <div class="collapse show" id="collapse_price">
                                    <div class="d-flex  gap-3 justify-content-between mt-3">
                                        <input type="number" class="form-control shadow-none"
                                            value="{{ request()->has('from_price') ? request('from_price') : '' }}"
                                            name="from_price" min=0 placeholder="{{ $currency_icon }}from" id="">
                                        <input type="number" class="form-control shadow-none"
                                            value="{{ request()->has('to_price') ? request('to_price') : '' }}" min=0
                                            name="to_price" placeholder="{{ $currency_icon }}to" id="">
                                    </div>
                                </div>

                            </div>
                            <div class="mt-4">
                                <a class="text-white title-menu bg-warning d-flex justify-content-between align-items-center fs-6 p-2 rounded"
                                    data-bs-toggle="collapse" href="#collapse_size" role="button" aria-expanded="false"
                                    aria-controls="multiCollapseExample1">
                                    <span>Size</span> <span><i class="fa-solid fa-caret-down"></i></span>
                                </a>
                                <div class="collapse show" id="collapse_size">
                                    @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <div class="d-flex align-items-center mt-3">
                                            <input type="checkbox" name="size[]" value="{{ $size }}"
                                                id="size{{ $size }}"
                                                {{ in_array($size, request('size', [])) ? 'checked' : '' }}>
                                            <label for="size{{ $size }}"
                                                class="form-label ms-3 text-muted">{{ $size }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-4">
                                <a class="text-white title-menu bg-warning d-flex justify-content-between align-items-center fs-6 p-2 rounded"
                                    data-bs-toggle="collapse" href="#collapse_color" role="button"
                                    aria-expanded="false" aria-controls="collapse_color">
                                    <span>Color</span> <span><i class="fa-solid fa-caret-down"></i></span>
                                </a>
                                <div class="collapse show" id="collapse_color">
                                    @foreach (['Red', 'Blue', 'Green', 'Yellow'] as $color)
                                        <div class="d-flex align-items-center mt-3">
                                            <input type="checkbox" name="color[]" value="{{ $color }}"
                                                id="color{{ $color }}"
                                                {{ in_array($color, request('color', [])) ? 'checked' : '' }}>
                                            <label for="color{{ $color }}"
                                                class="form-label ms-3 text-muted">{{ $color }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button class="btn btn-warning mt-4 " type="submit">filter</button>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-lg-9  mt-3 mt-lg-3  flash-sale  justify-content-center align-items-start  flex-wrap gap-3">
                <div class="row gy-4">
                    @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <x-product-card :product="$product"/>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 ms-auto" style="width: fit-content">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/product_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/product_card.css') }}">
@endsection


@push('scripts')
    <!-- collapse filter divs by default form media < 992 -->
    <script>
        var titleMenu = document.querySelectorAll('.title-menu');

        if (window.innerWidth < 992) {
            titleMenu.forEach(e => {
                e.classList.add('collapsed');
                e.nextElementSibling.classList.remove('show');
            });
        }
    </script>

    <!-- fix product title length -->
    <script>
        var productTitle = document.querySelectorAll(".product-title")
        productTitle.forEach(e => {
            if (e.parentNode.clientWidth <= 280 && e.innerText.toString().length >= 20) {
                e.innerText = e.innerText.slice(0, 20) + '...'
            }
        })
    </script>

@endpush


@endsection
