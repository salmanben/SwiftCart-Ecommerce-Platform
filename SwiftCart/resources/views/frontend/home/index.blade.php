@extends('frontend.layout.master')
@section('title', 'home')
@section('content')
<div class="container my-3">



    <!--*************************
        SLIDER START
    *************************-->
    @include('frontend.home.sections.slider')
    <!--*************************
        SLIDER END
    *************************-->

   <!--*************************
        FLASH SELL START
    *************************-->
    @include('frontend.home.sections.flash-sale')
    <!--*************************
        FLASH SELL END
    *************************-->

    <!--*************************
       POPULAR PRODUCTS  START
    *************************-->
    @include('frontend.home.sections.popular_products')
    <!--*************************
       POPULAR PRODUCTS  END
    *************************-->

    <!--*************************
        PRODUCT TYPES START
    *************************-->
    @include('frontend.home.sections.product-type')
    <!--*************************
       PRODUCT TYPES END
    *************************-->

    <!--*************************
        BRAND START
    *************************-->
    @include('frontend.home.sections.brand')
    <!--*************************
        BRAND END
    *************************-->

    <!--*************************
       TOP CATEGORIES START
    *************************-->
    @include('frontend.home.sections.top-categories')
    <!--*************************
        TOP CATEGORIES END
    *************************-->


    <!--*************************
        SINGLE CATEGORIES START
    *************************-->
    @include('frontend.home.sections.single-category')
    <!--*************************
        SINGLE CATEGORIES END
    *************************-->

    @section('styles')
       <link rel="stylesheet" href="{{asset("frontend/assets/css/home.css")}}">
       <link rel="stylesheet" href="{{asset("frontend/assets/css/product_card.css")}}">
    @endsection
    @section('scripts')
       <script src="{{asset('frontend/assets/js/home.js')}}"></script>
    @endsection
</div>
@endsection

