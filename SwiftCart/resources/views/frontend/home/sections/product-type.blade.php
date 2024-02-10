<section class="product-types my-4">

    <div class="">
        <div class="banner mb-3 row">
            @if ($home_banner_section_three && $home_banner_section_three->banner1->status)
                <div class="col-12 col-lg-6">
                    <a href="{{ $home_banner_section_three->banner1->url }}" class="d-block">
                        <img src="{{ asset('storage/upload/' . $home_banner_section_three->banner1->image) }}"
                            class="rounded" style="display:block;height: 300px; width:100%;" alt="">
                    </a>
                </div>
            @endif
            @if ($home_banner_section_three && $home_banner_section_three->banner2->status)
                <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                    <a href="{{ $home_banner_section_three->banner2->url }}" class="d-block">
                        <img src="{{ asset('storage/upload/' . $home_banner_section_three->banner2->image) }}"
                            class="rounded" style="display:block;height: 300px; width:100%" alt="">
                    </a>
                </div>
            @endif
        </div>
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <h4 class="ms-2 section-title position-relative"><span></span>Product Collections</h4>
            <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item mb-1 " role="presentation">
                    <button class="nav-link text-white bg-warning ms-2 px-1 py-1 active" id=""
                        data-bs-toggle="tab" data-bs-target="#new-arrival" type="button" role="tab"
                        aria-controls="home" aria-selected="true">New Arrival</button>
                </li>
                <li class="nav-item mb-1" role="presentation">
                    <button class="nav-link text-white bg-warning ms-2 px-1 py-1" id="" data-bs-toggle="tab"
                        data-bs-target="#featured" type="button" role="tab" aria-controls="home"
                        aria-selected="true">Featured</button>
                </li>
                <li class="nav-item mb-1" role="presentation">
                    <button class="nav-link text-white bg-warning ms-2 px-1 py-1" id="" data-bs-toggle="tab"
                        data-bs-target="#top-product" type="button" role="tab" aria-controls="home"
                        aria-selected="true">Top Product</button>
                </li>
                <li class="nav-item mb-1" role="presentation">
                    <button class="nav-link text-white bg-warning ms-2 px-1 py-1" id="" data-bs-toggle="tab"
                        data-bs-target="#best-product" type="button" role="tab" aria-controls="home"
                        aria-selected="true">Best Product</button>
                </li>
            </ul>
        </div>
        <div>
            <div class="tab-content tab-content-product-types mt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="new-arrival" role="tabpanel" aria-labelledby="home-tab">
                    @php
                        $products = \App\Models\Product::where('product_type', 'New Arrival')
                            ->where('status', 1)
                            ->where('is_approved', 1)
                            ->where('quantity', '>', 0)
                            ->withCount('reviews')
                            ->withAvg('reviews', 'rating')
                            ->limit(10)
                            ->get();
                    @endphp
                    <div class="row gy-3 mt-1">
                        @foreach ($products as $product)
                            <div class="col-6 px-1 px-sm-2 col-sm-4 col-lg-3 col-xl-2">
                                <div class="product   bg-white position-relative shadow-sm rounded border pb-2">
                                    <div class="">
                                        <a href="{{ route('product_details', $product->id) }}" class="a-image">
                                            <img src="{{ asset('storage/upload/' . $product->image) }}" alt="product"
                                                class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="review px-2">
                                        @for ($i = 0; $i < round($product->reviews_avg_rating); $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i = round($product->reviews_avg_rating); $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                        <span class="ms-2 text-muted">({{ $product->reviews_count }})</span>
                                    </div>
                                    <p class="px-2 py-1" style="font-size:14px !important"><a
                                            href="{{ route('product_details', $product->id) }}"
                                            class="text-body product-title product-types">{{ $product->name }}</a>
                                    </p>
                                    <div class="d-flex price px-2">
                                        @if (has_discount($product))
                                            <p class="">
                                                <span
                                                    style="font-size:14px">{{ $currency_icon }}{{ $product->offer_price }}</span>
                                                <del
                                                    class="text-danger ms-2"style="text-decoration:line-through">{{ $currency_icon }}{{ $product->price }}</del>
                                            </p>
                                        @else
                                            <p class=""><span
                                                    style="font-size:14px">{{ $currency_icon }}{{ $product->price }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="home-tab">
                    @php
                        $products = \App\Models\Product::where('product_type', 'Featured')
                            ->limit(10)
                            ->where('status', 1)
                            ->where('is_approved', 1)
                            ->where('quantity', '>', 0)
                            ->withCount('reviews')
                            ->withAvg('reviews', 'rating')
                            ->get();
                    @endphp
                    <div class="row gy-4 mt-3">
                        @foreach ($products as $product)
                            <div class="col-6 px-1 px-sm-2 col-sm-4 col-lg-3 col-xl-2">
                                <div class="product   bg-white position-relative shadow-sm rounded border pb-2">
                                    <div class="">
                                        <a href="{{ route('product_details', $product->id) }}" class="a-image">
                                            <img src="{{ asset('storage/upload/' . $product->image) }}"
                                                alt="product" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="review px-2">
                                        @for ($i = 0; $i < round($product->reviews_avg_rating); $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i = round($product->reviews_avg_rating); $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                        <span class="ms-2 text-muted">({{ $product->reviews_count }})</span>
                                    </div>
                                    <p class="px-2 py-1" style="font-size:14px !important"><a
                                            href="{{ route('product_details', $product->id) }}"
                                            class="text-body product-title product-types">{{ $product->name }}</a>
                                    </p>
                                    <div class="d-flex price px-2">
                                        @if (has_discount($product))
                                            <p class="">
                                                <span
                                                    style="font-size:14px">{{ $currency_icon }}{{ $product->offer_price }}</span>
                                                <del
                                                    class="text-danger ms-2"style="text-decoration:line-through">{{ $currency_icon }}{{ $product->price }}</del>
                                            </p>
                                        @else
                                            <p class=""><span
                                                    style="font-size:14px">{{ $currency_icon }}{{ $product->price }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="top-product" role="tabpanel" aria-labelledby="home-tab">
                    @php
                        $products = \App\Models\Product::where('product_type', 'Top Product')
                            ->limit(10)
                            ->where('status', 1)
                            ->where('is_approved', 1)
                            ->where('quantity', '>', 0)
                            ->withCount('reviews')
                            ->withAvg('reviews', 'rating')
                            ->get();
                    @endphp
                    <div class="row gy-4 mt-3">
                        @foreach ($products as $product)
                            <div class="col-6 px-1 px-sm-2 col-sm-4 col-lg-3 col-xl-2">
                                <div class="product   bg-white position-relative shadow-sm rounded border pb-2">
                                    <div class="">
                                        <a href="{{ route('product_details', $product->id) }}" class="a-image">
                                            <img src="{{ asset('storage/upload/' . $product->image) }}"
                                                alt="product" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="review px-2">
                                        @for ($i = 0; $i < round($product->reviews_avg_rating); $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i = round($product->reviews_avg_rating); $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                        <span class="ms-2 text-muted">({{ $product->reviews_count }})</span>
                                    </div>
                                    <p class="px-2 py-1" style="font-size:14px !important"><a
                                            href="{{ route('product_details', $product->id) }}"
                                            class="text-body product-title product-types">{{ $product->name }}</a>
                                    </p>
                                    <div class="d-flex price px-2">
                                        @if (has_discount($product))
                                            <p class="">
                                                <span
                                                    style="font-size:14px">{{ $currency_icon }}{{ $product->offer_price }}</span>
                                                <del
                                                    class="text-danger ms-2"style="text-decoration:line-through">{{ $currency_icon }}{{ $product->price }}</del>
                                            </p>
                                        @else
                                            <p class=""><span
                                                    style="font-size:14px">{{ $currency_icon }}{{ $product->price }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="best-product" role="tabpanel" aria-labelledby="home-tab">
                    @php
                        $products = \App\Models\Product::where('product_type', 'Best Product')
                            ->limit(10)
                            ->where('status', 1)
                            ->where('is_approved', 1)
                            ->where('quantity', '>', 0)
                            ->withCount('reviews')
                            ->withAvg('reviews', 'rating')
                            ->get();
                    @endphp
                    <div class="row gy-4 mt-3">
                        @foreach ($products as $product)
                            <div class="col-6 px-1 px-sm-2 col-sm-4 col-lg-3 col-xl-2">
                                <div class="product   bg-white position-relative shadow-sm rounded border pb-2">
                                    <div class="">
                                        <a href="{{ route('product_details', $product->id) }}" class="a-image">
                                            <img src="{{ asset('storage/upload/' . $product->image) }}"
                                                alt="product" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="review px-2">
                                        @for ($i = 0; $i < round($product->reviews_avg_rating); $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i = round($product->reviews_avg_rating); $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                        <span class="ms-2 text-muted">({{ $product->reviews_count }})</span>
                                    </div>
                                    <p class="px-2 py-1" style="font-size:14px !important"><a
                                            href="{{ route('product_details', $product->id) }}"
                                            class="text-body product-title product-types">{{ $product->name }}</a>
                                    </p>
                                    <div class="d-flex price px-2">
                                        @if (has_discount($product))
                                            <p class="">
                                                <span
                                                    style="font-size:14px">{{ $currency_icon }}{{ $product->offer_price }}</span>
                                                <del
                                                    class="text-danger ms-2"style="text-decoration:line-through">{{ $currency_icon }}{{ $product->price }}</del>
                                            </p>
                                        @else
                                            <p class=""><span
                                                    style="font-size:14px">{{ $currency_icon }}{{ $product->price }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<style>
    .product-types li button.active {
        background: black !important
    }

    .product-types .tab-content-product-types>div>div:not(:last-child) {
        margin-right: 20px
    }
</style>
