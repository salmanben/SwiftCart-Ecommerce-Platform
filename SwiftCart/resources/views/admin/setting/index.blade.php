@extends('admin.layout.master')
@section('title', 'settings')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Settings</h1>
    <div class="section-body my-4 container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action  {{!session()->has('setting') || (session()->has('setting') && session('setting') == 'general-setting') ? 'active' : ''}}"
                                   data-bs-toggle="tab" href="#general-setting" role="tab">General Settings</a>
                                <a class="list-group-item list-group-item-action {{session()->has('setting') && session('setting') == 'email-setting' ? 'active' : ''}}"
                                data-bs-toggle="tab" href="#email-setting" role="tab">Email Settings</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 mt-3 mt-sm-0">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade {{!session()->has('setting') || (session()->has('setting') && session('setting') == 'general-setting') ? 'show active' : ''}}" id="general-setting" role="tabpanel">
                                    @include('admin.setting.general_setting')
                                </div>
                                <div class="tab-pane fade {{session()->has('setting') && session('setting') == 'email-setting' ? 'active show' : ''}}" id="email-setting" role="tabpanel">
                                    @include('admin.setting.email_setting') </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
