<div class="product   bg-white position-relative shadow-sm rounded border pb-2">
    <p class="feature-badge">{!! set_product_type($product->product_type) !!}</p>
    <p class="discount-badge">{!! set_discount_percentage($product) !!}</p>
    <div class="options">
        <a href="{{ route('product_details', $product->id) }}" class="d-block text-center"><i
                class="fa-solid fa-eye text-white"></i></a>
        <a href="" data-product-id = "{{ $product->id }}" onclick = "addToWish(event)"
            class="d-block mt-2 text-center add-to-wish"><i class="fa-solid fa-heart text-white"></i></a>
    </div>
    <div class="">
        <a href="{{ route('product_details', $product->id) }}" class="a-image">
            <img src="{{ asset('storage/upload/' . $product->image) }}" alt="product" class="img-fluid">
            @if ($product->product_images_gallery->count())
                <img src="{{ asset('storage/upload/' . $product->product_images_gallery->first()->image) }}"
                    alt="image">
            @endif
        </a>
    </div>
    <form action="" method="post" onsubmit="addToCart(event)" class=" cart-form w-100">
        @csrf
        <input type="hidden" value = "{{ $product->id }}" name="id">
        @if (count($product->product_variants) > 0)
            <div class="row mt-3 d-none">
                @foreach ($product->product_variants as $product_variant)
                    @if (count($product_variant->product_variant_items) > 0)
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label for="">{{ $product_variant->name }}</label>
                                <select name="variants_items[]" class="form_select select-variant-items" id="">
                                    <option value="">Select</option>
                                    @foreach ($product_variant->product_variant_items as $item)
                                        <option @selected($item->is_default == 1) value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
        <input type="hidden" name="qty" value=1>
        <button type="submit" class="text-body fw-bold add-to-cart d-block w-100">ADD
            TO CART</button>
    </form>
    <span class="fw-bold text-muted d-block mt-1 ps-3" class="category">{{ $product->category->name }}</span>
    <div class="review px-3">
        @for ($i = 0; $i < round($product->reviews_avg_rating); $i++)
            <i class="fas fa-star"></i>
        @endfor
        @for ($i = round($product->reviews_avg_rating); $i < 5; $i++)
            <i class="far fa-star"></i>
        @endfor
        <span class="ms-2 text-muted">({{ $product->reviews_count }})</span>
    </div>
    <p class="px-3 py-1"><a href="{{ route('product_details', $product->id) }}"
            class="text-body product-title">{{ $product->name }}</a>
    </p>
    <div class="d-flex price px-3">
        @if (has_discount($product))
            <p class="">
                <span style="font-size:20px">{{ $currency_icon }}{{ $product->offer_price }}</span>
                <del
                    class="text-danger ms-4"style="text-decoration:line-through">{{ $currency_icon }}{{ $product->price }}</del>
            </p>
        @else
            <p class=""><span style="font-size:20px">{{ $currency_icon }}{{ $product->price }}</span>
            </p>
        @endif
    </div>
</div>
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
