@extends('admin.layout.master')
@section('title', 'payment settings')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Payment Settings</h1>
    <div class="section-body my-4 container-fluid">
      <div class="col-12">
        <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action {{!session()->has('gateway') || session('gateway') == 'paypal' ? 'active' : ''}}" id="list-home-list" data-bs-toggle="tab" href="#list-paypal" role="tab">PayPal</a>
                    <a class="list-group-item list-group-item-action {{session()->has('gateway') &&  session('gateway') == 'stripe' ? 'active' : ''}}" id="list-profile-list" data-bs-toggle="tab" href="#list-stripe" role="tab">Stripe</a>
                  </div>
                </div>
                <div class="col-12 col-sm-8 mt-3 mt-sm-0">
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade {{!session()->has('gateway') || session('gateway') == 'paypal' ? 'active show' : ''}}" id="list-paypal" role="tabpanel">
                        @include('admin.payment.paypal_settings_section')
                    </div>
                    <div class="tab-pane fade {{session()->has('gateway') && session('gateway') == 'stripe' ? 'active show' : ''}}" id="list-stripe" role="tabpanel">
                        @include('admin.payment.stripe_settings_section')
                    </div>

                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>

</section>
@endsection
