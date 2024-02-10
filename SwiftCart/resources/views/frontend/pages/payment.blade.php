@extends('frontend.layout.master')
@section('title', 'payment')
@section('content')
    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay">
        </div>
        <div class="container">
            <h1 class="text-white">Checkout</h1>
            <div class="d-flex align-items-center">
                <a href="/" class="fs-4">Home</a>
                <a href="{{ route('user.checkout') }}" class="fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2 "></i>
                    Checkout
                </a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i>
                    Payment
                </a>
            </div>
        </div>
    </div>

    <div class="container payment-container my-3">
        <div class="row justify-content-center px-2">
            <div class="col-12 col-md-3 bg-white shadow-sm p-3 rounded border">
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                    @if (!empty($paypal_settings) && $paypal_settings->status)
                        <button
                            class="nav-link w-100  active  bg-primary text-white mb-3"style="font-size: 18px ;font-weight:bold"
                            id="nav-paypal" data-bs-toggle="tab" data-bs-target="#paypal" type="button">PayPal</button>
                    @endif
                    @if (!empty($stripe_settings) && $stripe_settings->status)
                        <button class="nav-link w-100 bg-primary text-white" style="font-size: 18px ;font-weight:bold"
                            id="nav-stripe" data-bs-toggle="tab" data-bs-target="#stripe" type="button">Stripe</button>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-5 bg-white p-3 ms-0 ms-md-3  rounded border shadow-sm  mt-3 mt-md-0">
                <div class="tab-content mt-2" id="nav-tabContent">
                    @if (!empty($paypal_settings) && $paypal_settings->status)
                        <div class="tab-pane fade show active" id="paypal" role="tabpanel">
                            <a class="btn btn-primary text-white rounded-pill w-100" type="button"
                                href="{{ route('user.payment.paypal') }}">PayPal</a>
                        </div>
                    @endif
                    @if (!empty($stripe_settings) && $stripe_settings->status)
                        <div class="tab-pane" id="stripe" role="tabpanel">
                            <form action="{{ route('user.payment.stripe') }}" method="post" id="stripe-form">
                                @csrf
                                <!-- A card element will be added here by Stripe -->
                                <input type="hidden" name="stripe_token" id="stripe-token-id">
                                <div id="card-element" class="form-control mb-3"></div>
                                <button onclick="createToken()" id="pay-btn" type="button"
                                    class="btn btn-primary text-white rounded-pill w-100 active"
                                    id="submit-button">Stripe</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection

@push('styles')
    <style>
        .payment-container {
            min-height: calc(100vh - 610.67px)
        }

        .nav-pills button {
            border-radius: 20px !important
        }

        .nav-pills button.active {
            background-color: black !important;
            border-radius: 20px !important
        }
    </style>
@endpush
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe("{{ @$stripe_settings->client_id }}");
        if (stripe) {
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');

            function createToken() {

                document.getElementById("pay-btn").disabled = true;
                stripe.createToken(cardElement).then(function(result) {


                    if (typeof result.error != 'undefined') {
                        document.getElementById("pay-btn").disabled = false;
                        alert(result.error.message);
                    }

                    // creating token success
                    if (typeof result.token != 'undefined') {
                        document.getElementById("stripe-token-id").value = result.token.id;
                        document.getElementById('stripe-form').submit();
                    }
                });
            }
        }
    </script>
    <script>
        var navPaypal = document.getElementById('nav-paypal')
        if (!navPaypal) {
            var navStripe = document.getElementById('nav-stripe')
            var stripeElement = document.getElementById('stripe')
            navStripe.classList.add('active')
            stripeElement.classList.add('active', 'show')
        }
    </script>
@endpush
@endsection
