@extends('admin.layout.master')
@section('title', 'home settings')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Home Settings</h1>
        <div class="section-body my-4 container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action  {{!session()->has('home_setting') || (session()->has('home_setting') && session('home_setting') == 'top-categories') ? 'active' : ''}}"
                                       data-bs-toggle="tab" href="#list-top-categories" role="tab">Top Categories</a>
                                    <a class="list-group-item list-group-item-action {{session()->has('home_setting') && session('home_setting') == 'single-categories' ? 'active' : ''}}"
                                    data-bs-toggle="tab" href="#list-single-categories" role="tab">Single
                                        Categories</a>
                                    <a class="list-group-item list-group-item-action {{session()->has('home_setting') && session('home_setting') == 'footer' ? 'active' : ''}}"
                                        data-bs-toggle="tab" href="#footer" role="tab">Footer</a>
                                    <a class="list-group-item list-group-item-action {{session()->has('home_setting') && session('home_setting') == 'box_background' ? 'active' : ''}}"
                                        data-bs-toggle="tab" href="#box_background" role="tab">Box Background</a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 mt-3 mt-sm-0">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade {{!session()->has('home_setting') || (session()->has('home_setting') && session('home_setting') == 'top-categories') ? 'active show' : ''}}" id="list-top-categories" role="tabpanel">
                                        @include('admin.home_setting.top_categories')
                                    </div>
                                    <div class="tab-pane fade {{session()->has('home_setting') && session('home_setting') == 'single-categories' ? 'active show' : ''}}" id="list-single-categories" role="tabpanel">
                                        @include('admin.home_setting.single_categories') </div>
                                    <div class="tab-pane fade {{session()->has('home_setting') && session('home_setting') == 'footer' ? 'active show' : ''}}" id="footer" role="tabpanel">
                                        @include('admin.home_setting.footer') </div>
                                    <div class="tab-pane fade {{session()->has('home_setting') && session('home_setting') == 'box_background' ? 'active show' : ''}}" id="box_background" role="tabpanel">
                                        @include('admin.home_setting.box_background') </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
