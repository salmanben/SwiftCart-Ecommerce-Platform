@extends('admin.layout.master')
@section('title', 'banner')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Banner</h1>
        <div class="section-body my-4 container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action  {{ !session()->has('banner') || (session()->has('banner') && session('banner') == 'home-banner-section-one') ? 'active' : '' }}"
                                        data-bs-toggle="tab" href="#home-banner-section-one" role="tab">home banner section one</a>

                                    <a class="list-group-item list-group-item-action {{ session()->has('banner') && session('banner') == 'home-banner-section-two' ? 'active' : '' }}"
                                        data-bs-toggle="tab" href="#home-banner-section-two" role="tab">home banner section two</a>

                                    <a class="list-group-item list-group-item-action {{ session()->has('banner') && session('banner') == 'home-banner-section-three' ? 'active' : '' }}"
                                        data-bs-toggle="tab" href="#home-banner-section-three" role="tab">home banner section three</a>

                                    <a class="list-group-item list-group-item-action {{ session()->has('banner') && session('banner') == 'home-banner-section-four' ? 'active' : '' }}"
                                        data-bs-toggle="tab" href="#home-banner-section-four" role="tab">home banner section four</a>

                                    <a class="list-group-item list-group-item-action {{ session()->has('banner') && session('banner') == 'home-banner-section-five' ? 'active' : '' }}"
                                        data-bs-toggle="tab" href="#home-banner-section-five" role="tab">home banner section five</a>

                                    <a class="list-group-item list-group-item-action {{ session()->has('banner') && session('banner') == 'product-filter-banner' ? 'active' : '' }}"
                                        data-bs-toggle="tab" href="#product-filter-banner" role="tab">product filter banner</a>

                                    <a class="list-group-item list-group-item-action {{ session()->has('banner') && session('banner') == 'cart-view-banner' ? 'active' : '' }}"
                                        data-bs-toggle="tab" href="#cart-view-banner" role="tab">cart view banner</a>
                                </div>

                            </div>
                            <div class="col-12 col-md-8 mt-3 mt-md-0">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade {{!session()->has('banner') || (session()->has('banner') && session('banner') == 'home-banner-section-one') ? 'show active' : ''}}" id="home-banner-section-one" role="tabpanel">
                                        @include('admin.banner.home_banner_section_one')
                                    </div>

                                    <div class="tab-pane fade {{session()->has('banner') && session('banner') == 'home-banner-section-two' ? 'show active' : ''}}" id="home-banner-section-two" role="tabpanel">
                                        @include('admin.banner.home_banner_section_two')
                                    </div>

                                    <div class="tab-pane fade {{session()->has('banner') && session('banner') == 'home-banner-section-three' ? 'show active' : ''}}" id="home-banner-section-three" role="tabpanel">
                                        @include('admin.banner.home_banner_section_three')
                                    </div>

                                    <div class="tab-pane fade {{session()->has('banner') && session('banner') == 'home-banner-section-four' ? 'show active' : ''}}" id="home-banner-section-four" role="tabpanel">
                                        @include('admin.banner.home_banner_section_four')
                                    </div>

                                    <div class="tab-pane fade {{session()->has('banner') && session('banner') == 'home-banner-section-five' ? 'show active' : ''}}" id="home-banner-section-five" role="tabpanel">
                                        @include('admin.banner.home_banner_section_five')
                                    </div>
                                    <div class="tab-pane fade {{ session()->has('banner') && session('banner') == 'product-filter-banner' ? 'active show' : '' }}"
                                        id="product-filter-banner" role="tabpanel">
                                        @include('admin.banner.product_filter_banner') </div>
                                    <div class="tab-pane fade {{ session()->has('banner') && session('banner') == 'cart-view-banner' ? 'active show' : '' }}"
                                        id="cart-view-banner" role="tabpanel">
                                        @include('admin.banner.cart_view_banner') </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
