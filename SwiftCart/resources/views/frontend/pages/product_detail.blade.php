@extends('frontend.layout.master')
@section('title', 'product')
@section('content')
    @php
        if (auth()->check()) {
            $allowed = \App\Models\OrderProduct::where('product_id', $product->id)
                ->whereHas('order', function ($query) {
                    $query->where('user_id', auth()->user()->id)
                   ->where('order_status', 'delivered');
                })
                ->first();
            if ($allowed != null) {
                $exists = \App\Models\Review::where('user_id', auth()->user()->id)
                    ->where('product_id', $product->id)
                    ->first();
                if ($exists != null) {
                    $allowed = null;
                }
            }
        } else {
            $allowed = null;
        }

    @endphp
    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <h1 class="text-white">Product Deatils</h1>
            <div class="d-flex">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-2 me-2"></i> Product Details </a>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <div class="container bg-white shadow-sm my-3 border product-details py-4 rounded">
            <div class="row">
                <div class="col-12 col-md-4 position-relative">
                    @if ($product->video_link)
                        <div class="play-video">
                            <a class="bg-warning" data-autoplay="true" data-vbtype="video" href="{{ $product->video_link }}">
                                <i class="fa-solid fa-caret-right fa-play-video text-white"></i>
                            </a>

                        </div>
                    @endif
                    <div class="main-image-container col-12">
                        <a href="">
                            <img src="{{ asset('storage/upload/' . $product->image) }}" alt="" class="rounded">
                        </a>
                    </div>
                    @if ($product->product_images_gallery->count())
                        <div class="swiper swiper-image-gallery mt-1">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/upload/' . $product->image) }}" alt="image"
                                        class="rounded">
                                </div>
                                @foreach ($product->product_images_gallery as $item)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/upload/' . $item->image) }}"
                                            alt="image "class="rounded">
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-8 mt-3 mt-md-0">
                    <div class="text">
                        <h3>
                            <a href="" class="text-body title">{{ $product->name }}</a>
                        </h3>
                        <p>
                            <span class="badge text-white bg-primary fs-6">In Stock</span>
                            <span class="ms-2 text-secondary fs-6 fw-bold">({{ $product->quantity }} Item)</span>
                        </p>
                        @if (has_discount($product))
                            <p class="fs-2">
                                {{ $currency_icon }}<span class="price">{{ $product->offer_price }}</span>
                                <del class="text-danger ms-4 fs-4 price"style="text-decoration:line-through">{{ $currency_icon }}
                                    <span class="price">{{ $product->price }}</span>
                                </del>
                            </p>
                        @else
                            <p class="fs-2">{{ $currency_icon }}<span class="price">{{ $product->price }}</span></p>
                        @endif
                        <p class="review">
                            @for ($i = 0; $i < round($product->reviews_avg_rating); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @for ($i = round($product->reviews_avg_rating); $i < 5; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                            <span class="text-muted">({{ round($product->reviews_count) }} review)</span>
                        </p>
                        <p class="fs-6 pt-2">{{ $product->short_description }}</p>
                        <form action="" method="post" onsubmit="addToCart(event)" class="mt-2 cart-form">
                            @csrf
                            <input type="hidden" value = "{{ $product->id }}" name="id">
                            @if (count($product->product_variants) > 0)
                                <div class="row mt-2">
                                    @foreach ($product->product_variants as $product_variant)
                                        @if (count($product_variant->product_variant_items) > 0)
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="">{{ $product_variant->name }}</label>
                                                    <select name="variants_items[]"
                                                        class="form-control shadow-none select-variant-items"
                                                        id="">

                                                        @foreach ($product_variant->product_variant_items as $item)
                                                            <option @selected($item->is_default == 1)
                                                                value="{{ $item->id }}">{{ $item->name }}(${{$item->price}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            <div class="d-flex flex-wrap align-items-center quantity">
                                <h5 class="me-3">Quantity:</h5>
                                <div class="select-number d-flex align-items-center justify-content-center my-1">
                                    <button class="btn-success btn add-qty shadow-none me-1" type="button">+</button>
                                    <input class="qty-input w-50 py-1" data-product-id="{{ $product->id }}" readonly
                                        name="qty" type="text" min="1" max="{{ $product->quantity }}"
                                        value="1" />
                                    <button class="btn-danger btn reduce-qty shadow-none ms-1" type="button">-</button>
                                </div>
                            </div>
                            @if ($product->brand)
                                <p class="mt-2">
                                <h5 class="d-inline-block">Brand:</h5>
                                <span class="text-secondary ms-2">{{ $product->brand->name }}</span>
                                </p>
                            @endif
                            <div class="action d-flex align-items-center mt-3">
                                <button type="submit" class="btn btn-warning  text-white">Add to cart</button>
                                <a href="" data-product-id = "{{ $product->id }}"
                                    onclick = "addToWish(event)" class="ms-3 text-center add-to-wish"><i
                                        class="fa-solid fa-heart  text-body fs-5"></i></a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-3 shadow-sm rounded border bg-white my-4 related-info">
            <ul class="nav nav-pills d-flex justify-content-between">
                <li class="nav-item me-2 mb-2">
                    <a class="nav-link active a-description" data-bs-toggle="pill" aria-current="page"
                        href="#description">Description</a>
                </li>
                <li class="nav-item me-2 mb-2">
                    <a class="nav-link" data-bs-toggle="pill" href="#vendor-info">Vendor Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-reviews" data-bs-toggle="pill" href="#reviews">Reviews</a>
                </li>
            </ul>
            <div class="tab-content pt-4 mt-3">
                <div class="tab-pane active" id="description">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="">
                                <h1>{{ $product->name }}</h1>
                                <p>{!! $product->long_description !!}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row justify-content-between boxes gap-4">
                            <div class="border rounded border-primary border-solid">
                                <div class="">
                                    <h6 class="text-white rounded-top rounded-right bg-primary py-2 ps-2">Secured Payments
                                    </h6>
                                    <p class="fs-6 px-2 pb-2">Shop with confidence knowing that your payments are securely
                                        processed, ensuring a safe and reliable shopping experience.</p>
                                </div>
                            </div>

                            <div class="border rounded border-primary border-solid">
                                <div class="">
                                    <h6 class="text-white rounded-top rounded-right bg-primary py-2 ps-2">Fast Shipping
                                    </h6>
                                    <p class="fs-6 px-2 pb-2">Experience swift and efficient shipping services, ensuring
                                        that your orders reach you quickly and hassle-free.</p>
                                </div>
                            </div>

                            <div class="border rounded border-primary border-solid">
                                <div class="">
                                    <h6 class="text-white rounded-top rounded-right bg-primary py-2 ps-2">Affordable Prices
                                    </h6>
                                    <p class="fs-6 px-2 pb-2">Enjoy great, competitive prices on our products, making
                                        quality and value accessible to every shopper.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane  fade" id="vendor-info">
                    <div class="row">
                        <div class="col-xl-6 col-xxl-5 col-md-6">
                            <div class="">
                                <img src="{{ asset('storage/upload/' . $product->vendor->banner) }}" alt="vensor"
                                    class="img-fluid w-100 rounded">
                            </div>
                        </div>
                        <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                            <div class="">
                                <h4>{{ $product->vendor->user->name }}</h4>
                                <div class="review">
                                    @for ($i = 0; $i < round($product->vendor->reviews->avg('rating')); $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for ($i = round($product->vendor->reviews->avg('rating')); $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                    <span
                                        class="ms-2 text-muted">({{ $product->vendor->reviews != null ? count($product->vendor->reviews) : 0 }})</span>
                                </div>
                                <p><span class="text-primary">Store Name: </span> {{ $product->vendor->shop_name }}</p>
                                <p><span class="text-primary">Address:</span> {{ $product->vendor->address }}</p>
                                <p><span class="text-primary">Phone:</span> {{ $product->vendor->phone }}</p>
                                <p><span class="text-primary">mail:</span> {{ $product->vendor->email }}</p>
                                <a href="{{ route('store.index', ['vendor_id' => $product->vendor_id]) }}"
                                    class="btn btn-primary btn-sm">visit store<i
                                        class="fa-solid fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="">
                                <p>{!! $product->vendor->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane  fade" id="reviews">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="shadow-sm  bg-white border rounded p-2 p-md-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3>Reviews</h3>
                                    <p><span
                                            class="badge text-white bg-warning fs-6 border px-2">{{ $product->reviews_count }}</span>
                                    </p>
                                </div>
                                <div class="swiper swiper-reviews position-relative">
                                    <div class="swiper-wrapper">
                                        @for ($i = $product->reviews_count - 1; $i >= 0; $i -= 2)
                                            <div class="swiper-slide">
                                                <div
                                                    class="border p-2 p-md-3  d-flex  justify-content-start flex-column flex-md-row position-relative  rounded mb-3 mx-1">
                                                    <div style="width: 100px; height:100px" class="mx-auto mx-md-0">
                                                        <img src="{{ $product->reviews[$i]->user->image ? asset('storage/upload/' . $product->reviews[$i]->user->image) : asset('site_image/alt_img_profile.png') }}"
                                                            class="img-fluid rounded" alt="">
                                                    </div>
                                                    <div class="ms-0 mt-2 mt-md-0 ms-md-3 text-center text-md-start">
                                                        <h5 class="mb-1">{{ $product->reviews[$i]->user->name }}</h5>
                                                        <p class="text-muted date mb-0">
                                                            {{ date('F j, Y', strtotime($product->reviews[$i]->created_at)) }}</p>
                                                        <p class="comment">
                                                            {{ $product->reviews[$i]->comment }}.
                                                        </p>
                                                        <div
                                                            class="swiper swiper-review-images position-relative  mx-auto mx-md-0">
                                                            <div class="swiper-wrapper">
                                                                @php
                                                                    $images = json_decode($product->reviews[$i]->image);

                                                                @endphp
                                                                @foreach ($images as $item)
                                                                    <div class="swiper-slide">
                                                                        <div>
                                                                            <img src="{{ asset('storage/upload/' . $item) }}"
                                                                                class="img-fluid" alt="">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="swiper-button-prev"></div>
                                                            <div class="swiper-button-next"></div>
                                                        </div>
                                                    </div>
                                                    <p class="review-rating"><span
                                                            class="badge text-warning border "><span
                                                                class="fs-6">{{ $product->reviews[$i]->rating }}</span><i
                                                                class="fa-solid fa-star ms-2 d-inline-block position-relative"></i></span>
                                                    </p>
                                                </div>
                                                @if ($i - 1 >= 0)
                                                    <div
                                                        class="border p-2 p-md-3  d-flex justify-content-start flex-column flex-md-row position-relative  rounded mb-3 mx-1">
                                                        <div style="width: 100px; height:100px" class="mx-auto mx-md-0">
                                                            <img src="{{ $product->reviews[$i - 1]->user->image ? asset('storage/upload/' . $product->reviews[$i - 1]->user->image) : asset('site_image/alt_img_profile.png')  }}"
                                                                class="img-fluid rounded" alt="">
                                                        </div>
                                                        <div class="ms-0 mt-2 mt-md-0 ms-md-3 text-center text-md-start">
                                                            <h5 class="mb-1">{{ $product->reviews[$i - 1]->user->name }}</h5>
                                                            <p class="text-muted date mb-0">
                                                                {{ date('F j, Y', strtotime($product->reviews[$i - 1]->created_at)) }}
                                                            </p>
                                                            <p class="comment">
                                                                {{ $product->reviews[$i - 1]->comment }}.
                                                            </p>
                                                            <div
                                                                class="swiper swiper-review-images position-relative mx-auto mx-md-0 ">
                                                                <div class="swiper-wrapper">
                                                                    @php
                                                                        $images = json_decode($product->reviews[$i - 1]->image);

                                                                    @endphp
                                                                    @foreach ($images as $item)
                                                                        <div class="swiper-slide">
                                                                            <div style="width: 60px; height:60px">
                                                                                <img src="{{ asset('storage/upload/' . $item) }}"
                                                                                    class="img-fluid" alt="">
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div class="swiper-button-prev"></div>
                                                                <div class="swiper-button-next"></div>
                                                            </div>
                                                        </div>
                                                        <p class="review-rating"><span
                                                                class="badge text-warning border "><span
                                                                    class="fs-6">{{ $product->reviews[$i - 1]->rating }}</span><i
                                                                    class="fa-solid fa-star ms-2 d-inline-block position-relative"></i></span>
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endfor

                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>

                            </div>
                        </div>
                        @if ($allowed != null)
                            <div class="col-12 col-md-6 col-lg-4 mb-3  md-3 mt-3 mt-lg-0 mb-lg-0 write-review">
                                <div class="rounded border shadow-none p-2 p-md-3">
                                    <h4>Write A Review</h4>
                                    <p>Select Your Rating:
                                        <span class="ms-1"><i class="far fa-star text-warning"></i></span>
                                        <span class="ms-1"><i class="far fa-star text-warning"></i></span>
                                        <span class="ms-1"><i class="far fa-star text-warning"></i></span>
                                        <span class="ms-1"><i class="far fa-star text-warning"></i></span>
                                        <span class="ms-1"><i class="far fa-star text-warning"></i></span>
                                    </p>
                                    <form action="{{ route('user.review.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="vendor_id" value="{{ $product->vendor_id }}">
                                        <input type="hidden" class="rating" name="rating" value="0">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="">
                                            <input type="text" class="form-control shadow-none" name="comment"
                                                placeholder="comment" id="">
                                        </div>
                                        <div class="my-3">
                                            <input type="file" name="image[]" multiple
                                                class="form-control shadow-none d-block" id="">
                                        </div>
                                        <button type="submit" class="btn btn-warning text-white">Add</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/product-details.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('frontend/assets/js/product-details.js') }}" defer></script>
@endsection

@push('scripts')
    <!--  Change price  -->
    <script>
        var price = document.querySelector(".price")
        var select_variant_items = document.querySelectorAll(".select-variant-items");
        select_variant_items.forEach(select => {
            select.addEventListener('change', getPrice);
        });
        var qtyInput = document.querySelector(".qty-input")
        var addQty = document.querySelector(".add-qty")
        var reduceQty = document.querySelector(".reduce-qty")
        addQty.onclick = () => {
            if (qtyInput.value == qtyInput.getAttribute('max')) return
            qtyInput.value = Number(qtyInput.value) + 1
            getPrice()
        }
        reduceQty.onclick = () => {
            if (qtyInput.value == 1) return
            qtyInput.value = Number(qtyInput.value) - 1
            getPrice()
        }

        function getPrice() {
            var variant_items_id = [];
            select_variant_items.forEach(select => {
                if (select.value)
                    variant_items_id.push(select.value)
            });
            var data = {
                variant_items_id: variant_items_id,
                qty: qtyInput.value,
                id: qtyInput.getAttribute('data-product-id')
            };
            url = "{{ route('product_details_price') }}"
            fetch(url, {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json()).then(data => {
                price.innerHTML = data.price
            }).catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @php
                    toastr()->error($error);
                @endphp
            @endforeach
            var description = document.getElementById('description')
            var review = document.getElementById('reviews')
            var aDescription = document.querySelector('.a-description')
            var aReview = document.querySelector('.a-reviews')
            description.classList.remove('active', 'show')
            aDescription.classList.remove('active')
            review.classList.add('active', 'show')
            aReview.classList.add('active')
        @endif
    </script>
@endpush
@endsection
