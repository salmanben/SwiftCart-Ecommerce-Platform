@foreach ($single_categories as $category)
    <section class="single-category my-4">
        <div class="">
            <h4 class="ms-2 section-title position-relative">
                <span></span>{{ $category->name }}
            </h4>
            <div class="" id="{{ $category->name }}" role="tabpanel" aria-labelledby="home-tab">
                @php
                    $products = \App\Models\Product::where('category_id', $category->id)
                        ->limit(10)
                        ->where('status', 1)
                        ->where('is_approved', 1)
                        ->where('quantity', '>', 0)
                        ->with(['category', 'product_images_gallery', 'product_variants', 'product_variants.product_variant_items'])
                        ->withCount('reviews')
                        ->withAvg('reviews', 'rating')
                        ->get();
                @endphp
                <div class="row gy-4 mt-1">
                    @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endforeach
@if ($home_banner_section_five && $home_banner_section_five->banner1->status)
    <div class="banner mt-3">
        <a href="{{ $home_banner_section_five->banner1->url }}" class="d-block">
            <img src="{{ asset('storage/upload/' . $home_banner_section_five->banner1->image) }}" class="rounded"
                style="display:block;height: 150px; width:100%" alt="">
        </a>
    </div>
@endif
<style>
    .single-category .product:not(:last-child) {
        margin-right: 20px
    }

    .single-category-title span {
        display: inline-block;
        height: 12px;
        ;
        width: 30px;
        position: relative;
        bottom: 3px;
        border-radius: 15px;
        background: #FFCF17;
        margin-right: 8px
    }
</style>
