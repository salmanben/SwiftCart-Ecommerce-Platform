<section class="product-types my-4">
    <div class="">
        @if ($home_banner_section_two && $home_banner_section_two->banner1->status)
            <div class="banner mb-3">
                <a href="{{ $home_banner_section_two->banner1->url }}" class="d-block">
                    <img src="{{ asset('storage/upload/' . $home_banner_section_two->banner1->image) }}" class="rounded"
                        style="display:block;height: 160px; width:100%;" alt="banner">
                </a>
            </div>
        @endif
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <h4 class="section-title position-relative"><span></span>Popular Products</h4>
            <a href="{{ route('popular_products') }}" class="btn btn-sm btn-warning text-white">more</a>
        </div>

        <div class="row gy-4 mt-1">
            @foreach ($popular_products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
</section>
