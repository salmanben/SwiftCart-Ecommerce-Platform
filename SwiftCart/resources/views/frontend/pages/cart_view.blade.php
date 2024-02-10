@extends('frontend.layout.master')
@section('title', 'cart')
@section('content')
    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay">
        </div>
        <div class="container">
            <h1 class="text-white">Cart View</h1>
            <div class="d-flex">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i>
                    Cart View
                </a>
            </div>
        </div>
    </div>


    <div class="container cart my-3">
        <div class="row">
            @if ($cart_view_banner && $cart_view_banner->banner1->status)
                <div class="col-6 d-none d-md-block banner mb-3">
                    <a href="{{ $cart_view_banner->banner1->url }}" class="d-block">
                        <img src="{{ asset('storage/upload/' . $cart_view_banner->banner1->image) }}" class="rounded"
                            style="display:block;height: 250px; width:100%" alt="">
                    </a>
                </div>
            @endif
            @if ($cart_view_banner && $cart_view_banner->banner2->status)
                <div class="col-6 d-none d-md-block banner mb-3">
                    <a href="{{ $cart_view_banner->banner2->url }}" class="d-block">
                        <img src="{{ asset('storage/upload/' . $cart_view_banner->banner2->image) }}" class="rounded"
                            style="display:block;height: 250px; width:100%" alt="">
                    </a>
                </div>
            @endif

        </div>
        <div class="row">
            <div class="col-12 col-lg-8 col-xl-9 ">
                <div class="table-responsive bg-white rounded shadow-sm px-2  py-2 d-none d-sm-block">
                    <table class="table cart-table table-bordered table-sm mb-0">
                        <thead>
                            <tr>
                                <th class="">Product Item</th>
                                <th>Product Details</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th><a class="btn btn-danger btn-sm clear-all">Clear All</a></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cart_content as $item)
                                <tr class="item-{{ $item->rowId }}">
                                    <td><a href="{{ route('product_details', $item->id) }}"><img
                                                src="{{ asset('storage/upload/' . $item->options->image) }}"
                                                alt="product"></a>
                                    </td>
                                    <td>
                                        <p>{{ $item->name }}</p>
                                        @foreach ($item->options->variants_items as $variant => $variant_item)
                                            <p class="mb-0"><span class="fw-bold">{{ $variant }}:
                                                    {{ $variant_item }}</span></p>
                                        @endforeach
                                    </td>
                                    <td class="quantity">
                                        <div class="select-number d-flex align-items-center justify-content-center">
                                            <button class="btn-success btn add-qty shadow-none me-1"
                                                type="button">+</button>
                                            <input class="qty-input w-50" data-rowId = "{{ $item->rowId }}" readonly
                                                name="qty" type="text" min="1"
                                                max =
                                                  "{{ App\Models\Product::findOrFail($item->id)->quantity }}"
                                                value="{{ $item->qty }}" />
                                            <button class="btn-danger btn reduce-qty shadow-none ms-1"
                                                type="button">-</button>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="total-item fw-bold">
                                            {{ $currency_icon }}{{ $item->options->total_variants + $item->price }}
                                        </h6>
                                    </td>

                                    <td>
                                        <a data-rowId="{{ $item->rowId }}" href="javascript:;"
                                            onclick="deleteItemCart('{{ $item->rowId }}')" class="delete-item"><i
                                                class="fa-solid fa-xmark text-danger fs-4"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="d-block d-sm-none cart-view-mobile bg-white">
                    @foreach ($cart_content as $item)
                        <div
                            class="d-flex py-2 ps-2 pe-4 position-relative border  rounded shadow-sm item-{{ $item->rowId }}">
                            <a data-rowId="{{ $item->rowId }}" href="javascript:;"
                                onclick="deleteItemCart('{{ $item->rowId }}')" class="delete-item-cart-view-mobile"><i
                                    class="fa-solid fa-xmark text-danger fs-4"></i>
                            </a>
                            <div>
                                <a href="{{ route('product_details', $item->id) }}"><img
                                        src="{{ asset('storage/upload/' . $item->options->image) }}" alt="product"></a>
                            </div>
                            <div class="ms-2">
                                <h5>{{ $item->name }}</h5>
                                @foreach ($item->options->variants_items as $variant => $variant_item)
                                    <p class="mb-0"><span class="fw-bold">{{ $variant }}:
                                            {{ $variant_item }}</span></p>
                                @endforeach
                                <div class="select-number d-flex align-items-center my-3">
                                    <button class="btn-success btn-sm btn add-qty shadow-none me-1"
                                        type="button">+</button>
                                    <input class="qty-input" style="width:60px !important;"
                                        data-rowId = "{{ $item->rowId }}" readonly name="qty" type="text"
                                        min="1"
                                        max =
                                      "{{ App\Models\Product::findOrFail($item->id)->quantity }}"
                                        value="{{ $item->qty }}" />
                                    <button class="btn-danger btn btn-sm reduce-qty shadow-none ms-1"
                                        type="button">-</button>
                                </div>
                                <h6 class="total-item fw-bold">
                                    {{ $currency_icon }}{{ $item->options->total_variants + $item->price }}                                </h6>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-12 col-md-6 mt-3 mt-lg-0 col-lg-4 col-xl-3">
                <div class="bg-white cart-facture  py-4 rounded border  shadow-sm px-3 total-cart">
                    <h4>Total Cart</h4>
                    <ul class="list-unstyled my-3">
                        <li class=" d-flex">
                            <p>Subtotal:</p>
                            <p class="ms-auto d-inline-block sub-total">{{ $currency_icon }}{{ calc_sub_total() }}</p>
                        </li>
                        <li class=" d-flex">
                            <p>Discount:</p>
                            <p class="ms-auto d-inline-block discount">{{ $currency_icon }}{{ get_discount_coupon() }}</p>
                        </li>
                        <li class="d-flex total-line">
                            <p>Total:</p>
                            <p class="ms-auto d-inline-block total ">
                                {{ $currency_icon }}{{ calc_sub_total() - get_discount_coupon() }}</p>
                        </li>
                    </ul>
                    <form class="apply-coupon coupon d-flex" onsubmit="applyCouponFunc()">
                        <input type="text" class="coupon-code"
                            value="{{ session()->has('coupon') ? session()->get('coupon')['code'] : '' }}"
                            placeholder="Coupon Code">
                        <button type="submit" class="btn btn-warning text-white rounded-pill ms-auto">apply</button>
                    </form>
                    <a href = "{{ route('user.checkout') }}"
                        class="btn btn-warning d-block text-white mb-3 mt-4 w-100"><i
                            class="fa-solid fa-money-check-dollar me-2"></i>Checkout</a>
                    <a href = "/" class="btn btn-warning d-block text-white w-100"><i
                            class="fa-solid fa-cart-shopping me-2"></i>Go Shop</a>

                </div>
            </div>
        </div>
    </div>

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/cart-view.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection
@push('scripts')
    <script>
        var cart = document.querySelector(".cart")
        var tr = document.querySelectorAll('tbody tr')
        if (tr.length == 0) {
            cart.remove()
        }
        /* clear cart */
        var clearAll = document.querySelector(".clear-all")
        clearAll.onclick = (e) => {
            e.preventDefault()
            url = "{{ route('cart_destroy') }}"
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).then(res => res.json()).then(data => {
                        if (data.status == 'success') {
                            Swal.fire('Deleted!', data.message)
                            window.location.href = "/"
                        } else if (data.status == 'error') {
                            Swal.fire('Error', data.message)
                        }
                    }).catch(function(error) {
                        Swal.fire('Error', "Can't be deleted!")
                    });
                }
            });
        }

        var addQtyBtns = document.querySelectorAll(".add-qty")
        var reduceQtyBtns = document.querySelectorAll(".reduce-qty")

        addQtyBtns.forEach(addQtyBtn => {
            addQtyBtn.onclick = () => {
                var qtyInput = addQtyBtn.parentNode.querySelector("input")
                var rowId = qtyInput.getAttribute('data-rowId')
                if (qtyInput.value == qtyInput.getAttribute('max')) return
                qtyInput.value = ++qtyInput.value
                updateCart(rowId, Number(qtyInput.value))
            }
        })

        reduceQtyBtns.forEach(reduceQtyBtn => {
            reduceQtyBtn.onclick = () => {
                var qtyInput = reduceQtyBtn.parentNode.querySelector("input")
                var rowId = qtyInput.getAttribute('data-rowId')
                if (qtyInput.value == 1) return
                qtyInput.value = --qtyInput.value
                updateCart(rowId, Number(qtyInput.value))

            }
        })
        var discount = document.querySelector(".total-cart .discount")
        var total = document.querySelector(".total-cart .total")
        var subTotal = document.querySelectorAll(".sub-total")

        function updateCart(rowId, qty) {
            data = JSON.stringify({
                'qty': qty
            })
            const url = `/cart_update/${rowId}`;
            fetch(url, {
                    method: 'PUT',
                    body: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    }
                }).then(res => res.json())
                .then(data => {
                    subTotal.forEach(e => {
                        e.innerHTML = "{{ $currency_icon }}" + Number(data.sub_total)
                    })
                    var discount = document.querySelector(".total-cart .discount")
                    discount.innerHTML = "{{ $currency_icon }}" + data.discount_value
                    total.innerHTML = "{{ $currency_icon }}" + (data.sub_total - data.discount_value)
                    var itemQty = document.querySelector(`li.item-${rowId} .qty`);
                    itemQty.innerHTML = qty

                })
                .catch(error => console.log(error))
        }
        var couponCodeInput = document.querySelector(".coupon-code")
        function applyCouponFunc(){
            event.preventDefault()
            if (!couponCodeInput.value) {
                alert('You must enter coupon code!')
                return
            }
            url = "{{ route('user.coupon_apply') }}"
            code = couponCodeInput.value
            fetch(url, {
                method: 'POST',
                body: JSON.stringify({
                    code: code
                }),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json()).then(data => {
                if (data.status == 'error') {
                    Swal.fire('Error', data.message)
                } else {
                    var subTotal = document.querySelectorAll(".sub-total")
                    console.log(data.sub_total)
                    subTotal.forEach(e => {
                        e.innerHTML = "{{ $currency_icon }}" + Number(data.sub_total)
                    })
                    var total_val = document.querySelector('.total-cart .total')
                    var discount_val = document.querySelector(".total-cart .discount")
                    discount_val.innerHTML = "{{ $currency_icon }}" + data.discount_value
                    var x = data.sub_total - data.discount_value
                    total_val.innerHTML = "{{ $currency_icon }}" + x

                }
            })
        }
    </script>
@endpush

@endsection
