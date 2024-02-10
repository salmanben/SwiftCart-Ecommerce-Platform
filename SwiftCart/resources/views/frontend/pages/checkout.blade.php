@extends('frontend.layout.master')
@section('title', 'checkout')
@section('content')
    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay">
        </div>
        <div class="container">
            <h1 class="text-white">Checkout</h1>
            <div class="d-flex align-items-center">
                <a href="/" class="fs-4">Home</a>
                <a href="{{ route('user.cart_view') }}" class="fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2 "></i>
                    Cart View
                </a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i>
                    Checkout
                </a>
            </div>
        </div>
    </div>
    <div class="container checkout-container my-3">
        <div class="row">
            <div class="col-12 col-lg-8 mb-md-3 row flex-wrap">
                @if (count($addresses) == 0)
                    <a style="width:fit-content;height:fit-content" href="{{ route('user.address.create') }}"
                        class="btn btn-primary mb-2 ms-3"><i class="far fa-plus"></i>
                        add new address
                    </a>
                @else
                    @foreach ($addresses as $address)
                        <div class="mb-3 col-12 col-md-6">
                            <div class="card" style="min-height: 400px">
                                <div class="card-header bg-warning">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="select-{{ $address->id }}" class="text-white fs-5">select</label>
                                        <input data-address-id="{{ $address->id }}" class="address" type="radio"
                                            name="select_address" id="select-{{ $address->id }}">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="mb-2 "><span class="text-body fs-5">name :</span> {{ $address->name }}
                                        </li>
                                        <li class="mb-2 "><span class="text-body fs-5"> Phone :</span>
                                            {{ $address->phone }}
                                        </li>
                                        <li class="mb-2 "><span class="text-body fs-5">email :</span> {{ $address->email }}
                                        </li>
                                        <li class="mb-2 "><span class="text-body fs-5">country :</span>
                                            {{ $address->country }}
                                        </li>
                                        <li class="mb-2 "><span class="text-body fs-5">city :</span> {{ $address->city }}
                                        </li>
                                        <li class="mb-2 "><span class="text-body fs-5">zip code :</span>
                                            {{ $address->zip }}
                                        </li>
                                        <li class="mb-2 "><span class="text-body fs-5">address :</span>
                                            {{ $address->address }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-12 col-lg-4">
                <div class='bg-white py-4 rounded px-3' style="box-shadow: 0px 0px 5px #ddd;">
                    <h5>Shipping Method</h5>
                    <ul class="list-unstyled">
                        @foreach ($shipping_methods as $shipping_method)
                            @if ($shipping_method->type == 'min_cost')
                                @if ($sub_total >= $shipping_method->min_cost)
                                    <li class="mb-2">
                                        <input data-cost="{{ $shipping_method->cost }}"
                                            data-shipping-id="{{ $shipping_method->id }}" type="radio"
                                            class='shipping-method' name="shipping_method"
                                            id="shipping-method-{{ $shipping_method->id }}">
                                        <label class="ms-2"
                                            for="shipping-method-{{ $shipping_method->id }}">{{ $shipping_method->name }}
                                            <span class="text-secondary"
                                                style="font-size: 14px">({{ $currency_icon }}{{ $shipping_method->cost }})</span></label>
                                    </li>
                                @endif
                            @else
                                <li class="mb-2 d-flex align-items-center">
                                    <input data-cost="{{ $shipping_method->cost }}"
                                        data-shipping-id="{{ $shipping_method->id }}" type="radio" name="shipping_method"
                                        class="shipping-method" id="shipping-method-{{ $shipping_method->id }}">
                                    <label class="ms-2"
                                        for="shipping-method-{{ $shipping_method->id }}">{{ $shipping_method->name }}
                                        <span class="text-secondary"
                                            style="font-size: 14px">({{ $currency_icon }}{{ $shipping_method->cost }})</span></label>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <ul class="list-unstyled my-3 border-top border-bottom pt-2">
                        <li class="d-flex  fw-bold">
                            <p>Subtotal:</p>
                            <p class="ms-auto d-inline-block sub-total">{{ $currency_icon }}{{ calc_sub_total() }}</p>
                        </li>
                        <li class="d-flex fw-bold">
                            <p>Shipping fee:</p>
                            <p class="ms-auto d-inline-block shipping-fee">{{ $currency_icon }}0</p>
                        </li>
                        <li class="d-flex fw-bold">
                            <p>Discount:</p>
                            <p class="ms-auto d-inline-block discount">
                                {{ $currency_icon }}{{ get_discount_coupon() }}
                            </p>
                        </li>
                        <li class="d-flex total-line  fs-5 fw-bold">
                            <p class="">Total:</p>
                            <p class="ms-auto d-inline-block total ">
                                {{ $currency_icon }}{{ calc_sub_total() - get_discount_coupon() }}</p>
                        </li>
                    </ul>
                    <div class="my-2">
                        <input type="checkbox" class="terms-checkbox" name="" id="">
                        <span class="ms-1 fs-6">I have read and agree to the <a href="{{ route('terms.index') }}">terms and
                                conditions
                                *</a></span>
                    </div>
                    <form action="{{ route('user.checkout.stock_shipping_info') }}" method="post" class="placeOrderForm">
                        @csrf
                        <input type="hidden" name="shipping_method_id" class="hidden-shipping-method">
                        <input type="hidden" name="address_id" class="hidden-address">
                        <button class="btn w-100 btn-warning text-white rounded-pill ms-auto"><i
                                class="fa-solid fa-check me-2  text-white"></i>Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection
@push('styles')
    <style>
        .checkout-container {
            min-height: calc(100vh - 610.67px)
        }
    </style>
@endpush
@push('scripts')
    <script>
        var subTotal = document.querySelector(".sub-total")
        var discount = document.querySelector(".discount")
        var shippingFee = document.querySelector(".shipping-fee")
        var total = document.querySelector(".total")
        var shippingMethod = document.querySelectorAll(".shipping-method")

        shippingMethod.forEach(e => {
            e.onchange = () => {
                shippingFee.innerHTML = "{{ $currency_icon }}" + e.getAttribute('data-cost')
                total.innerHTML = "{{ $currency_icon }}" + (Number("{{ calc_sub_total() }}") + Number(e
                    .getAttribute('data-cost')) - Number("{{ get_discount_coupon() }}"))
            }

        })

        window.addEventListener('beforeunload', function() {
            shippingMethod.forEach(function(radio) {
                radio.checked = false;
            });
        });

        var addresses = document.querySelectorAll(".address")
        var termsCheckbox = document.querySelector(".terms-checkbox")
        var placeOrderForm = document.querySelector(".placeOrderForm")
        var hiddenShippingMethod = placeOrderForm.querySelector(".hidden-shipping-method")
        var hiddenAddress = placeOrderForm.querySelector(".hidden-address")
        placeOrderForm.onsubmit = (e) => {
            e.preventDefault()
            if (termsCheckbox.checked == false) {
                toastr.error("You must accecpt webiste terms!")
                return
            }
            var select_addr = 0
            for (let i = 0; i < [...addresses].length; i++) {
                if (addresses[i].checked == true) {
                    hiddenAddress.value = addresses[i].getAttribute('data-address-id')
                    select_addr = 1
                    break
                }
            }
            if (!select_addr) {
                toastr.error("You must select an address!")
                return
            }
            var shipping_meth = 0
            for (let i = 0; i < [...shippingMethod].length; i++) {
                if (shippingMethod[i].checked == true) {
                    shipping_meth = 1
                    hiddenShippingMethod.value = shippingMethod[i].getAttribute('data-shipping-id')
                    break
                }

            }
            if (!shipping_meth) {
                toastr.error("You must select a shipping method!")
                return
            }

            placeOrderForm.submit()
        }
    </script>
@endpush
@endsection
