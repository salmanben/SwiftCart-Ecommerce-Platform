<section class="top-categories my-5">
    <div class="">
        <div class="banner mb-3 row">
            @if ($home_banner_section_four && $home_banner_section_four->banner1->status)
                <div class="col-12 col-lg-6">

                    <div>
                        <a href="{{ $home_banner_section_four->banner1->url }}" class="d-block">
                            <img src="{{ asset('storage/upload/' . $home_banner_section_four->banner1->image) }}"
                                class="rounded" style="display:block;height: 500px; width:100%" alt="">
                        </a>
                    </div>

                </div>
            @endif
            <div class="col-12 mt-3 mt-lg-0 col-lg-6 ">
                @if ($home_banner_section_four && $home_banner_section_four->banner2->status)
                    <div class="col-12  align-self-end">
                        <div class="text-end ms-auto">
                            <a href="{{ $home_banner_section_four->banner2->url }}" class="d-block">
                                <img src="{{ asset('storage/upload/' . $home_banner_section_four->banner2->image) }}"
                                    class="rounded" style="display:block;height: 245px; width:100%; margin-bottom:10px"
                                    alt="">
                            </a>
                        </div>
                    </div>
                @endif
                @if ($home_banner_section_four && $home_banner_section_four->banner3->status)
                    <div class="col-12">
                        <div class="">
                            <a href="{{ $home_banner_section_four->banner3->url }}" class="d-block">
                                <img src="{{ asset('storage/upload/' . $home_banner_section_four->banner3->image) }}"
                                    class="rounded" style="display:block;height: 245px; width:100%" alt="">
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <h4 class="ms-2 top-categories-title position-relative"><span></span>Top Categories</h4>
            <ul class="nav nav-pills top-categories-list-tab" id="myTab" role="tablist">
                @foreach ($top_categories as $category)
                    <li class="nav-item mb-1" role="presentation">
                        <button class="nav-link text-white bg-warning ms-2 px-1 py-1" id="{{ $category->id }} "
                            data-bs-toggle="tab"
                            data-bs-target="#{{ explode(' ', $category->name)[0] . '_' . $category->id }}"
                            type="button" role="tab" aria-controls="home"
                            aria-selected="true">{{ $category->name }}</button>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <div class="tab-content tab-content-top-categories mt-1" id="myTabContent">
                @foreach ($top_categories as $category)
                    <div class="tab-pane fade" id="{{ explode(' ', $category->name)[0] . '_' . $category->id }}"
                        role="tabpanel" aria-labelledby="home-tab">
                        @php
                            $products = \App\Models\Product::where('category_id', $category->id)
                                ->where('is_approved', 1)
                                ->where('status', 1)
                                ->where('quantity', '>', 0)
                                ->with(['category', 'product_images_gallery', 'product_variants', 'product_variants.product_variant_items'])
                                ->withCount('reviews')
                                ->withAvg('reviews', 'rating')
                                ->limit(10)
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
                @endforeach

            </div>
        </div>

    </div>
</section>
@push('scripts')
    <script>
        var topCategoriesListTab = document.querySelector('.top-categories-list-tab');
        topCategoriesListTab.children[0].querySelector('button').classList.add('active');
        var tabContentTopCategories = document.querySelector(".tab-content-top-categories")
        tabContentTopCategories.children[0].classList.add('active', 'show')
    </script>
@endpush
<style>
    .top-categories-list-tab li button.active {
        background: black !important
    }

    .top-categories .tab-content-top-categories>div>div:not(:last-child) {
        margin-right: 20px
    }

    .top-categories-title span {
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
