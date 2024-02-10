@php
    $categories = App\Models\Category::where('status', 1)
        ->with([
            'sub_categories' => function ($query) {
                $query->where('status', 1);
            },

            'sub_categories.child_categories' => function ($query) {
                $query->where('status', 1);
            },
        ])
        ->get();

    $wish_count = auth()->check() ? App\Models\WishProduct::where('user_id', auth()->user()->id)->count() : 0;
    $general_setting = \App\Models\GeneralSetting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

    <!-- csrf  -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>
    @if ($general_setting)
        <link rel="icon" href="{{ asset('storage/upload/' . $general_setting->logo) }}">
    @else
        <link rel="icon" href="{{ asset('site_image/site_logo.png') }}">
    @endif

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,700&family=Nunito:ital,wght@0,400;0,500;0,600;1,300;1,600&display=swap"
        rel="stylesheet">

    <!-- Swiper Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- css file -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/layout.css') }}">

    <!-- toastr css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Swiper Js -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @yield('styles')
</head>

<body>
    <!--****************************
        HEADER START
    ****************************-->
    @include('frontend.layout.header')
    <!--****************************
       HEADER END
    ****************************-->

    <!--****************************
        MENU START
    ****************************-->
    @include('frontend.layout.menu')
    <!--****************************
        MENU END
    ****************************-->

    @yield('content')

    <!--****************************
        FOOTER PART START
    ****************************-->
    @include('frontend.layout.footer')
    <!--****************************
        FOOTER PART END
    ****************************-->




    <!-- Js File -->
    <script defer src="{{ asset('frontend/assets/js/layout.js') }}"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- toastr js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')


    <!-- Add To Cart-->
    <script>
        function addToCart(e) {
            e.preventDefault();
            var formBody = new FormData(e.target);
            var url_cart_add = "{{ route('cart_add') }}";
            fetch(url_cart_add, {
                    method: "POST",
                    body: formBody,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        if (data.item.old_rowId != null) {
                            var li = document.querySelector(
                                `.mini-cart li.item-${data.item.old_rowId}`);
                            li.remove()
                        } else {
                            var cartCount = document.querySelector(".cart-count");
                            cartCount.setAttribute('data-count', Number(cartCount
                                .getAttribute(
                                    'data-count')) + 1)

                            var miniCartBtn = document.querySelector(".mini-cart-btn");
                            if (miniCartBtn.classList.contains('d-none')) {
                                miniCartBtn.classList.remove('d-none');
                            }
                        }
                        var shoppingCartList = document.querySelector(
                            ".shopping-cart-list");

                        var li = `
                                <li class="item-${data.item.rowId} d-flex mb-3 lh-sm">
                                    <div class="mini_cart_product_img position-relative">
                                        <a href="/product_details/${data.item.id}">
                                            <img src="{{ asset('storage/upload/${data.item.image}') }}" alt="product" class="img-fluid w-100">
                                        </a>
                                        <a href="javascript:;" onclick="deleteItemCart('${data.item.rowId}')"  class="delete-item-mini-cart bg-danger rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" data-rowId="${data.item.rowId}">
                                            <span class="fs-4">-</span>
                                        </a>
                                    </div>
                                    <div class="mini_cart_product_text ms-3">
                                        <a href="/product_details/${data.item.id}">${data.item.name}</a>
                                        <p class="fw-bold mb-0 mt-1">{{ $currency_icon }}${data.item.price}</p>
                                        <small>Variants Total: {{ $currency_icon }}<span class="variants-total">${data.item.total_variants}</span></small><br>
                                        <small>Qty: <span class="qty">${data.item.qty}</span></small>
                                    </div>
                                </li>
                            `;
                        shoppingCartList.insertAdjacentHTML('afterbegin', li);

                        var subTotal = document.querySelector(".mini-cart .sub-total")
                        subTotal.innerHTML = "{{ $currency_icon }}" + Number(data.item
                            .sub_total)
                        toastr.success('Product added successfully to cart');
                    }

                })
                .catch(error => {
                    console.error('Error:', error);
                });

        }
    </script>



    <!-- Add To Wish -->
    <script>
        function addToWish(e) {
            e.preventDefault()
            @if (!auth()->check())

                window.location.href = "{{ route('login') }}";
            @endif
            @if (auth()->check() && auth()->user()->role == 'admin')
                toastr.error('You must be a customer')
                return
            @endif

            id = e.currentTarget.getAttribute('data-product-id')
            var url = "{{ route('user.wish_product.store') }}"
            fetch(url, {
                    method: "POST",
                    body: JSON.stringify({
                        product_id: id
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        toastr.success('Product added successfully to wish list');
                        if (data.already_added == false) {
                            var wishCount = document.querySelectorAll(".wish-count");
                            wishCount[0].setAttribute('data-count', Number(wishCount[0]
                                .getAttribute('data-count')) + 1)
                            wishCount[1].setAttribute('data-count', Number(wishCount[1]
                                .getAttribute('data-count')) + 1)
                        }
                    }

                })
                .catch(err => console.log(err))



        }
    </script>

    <!-- subscribe newsletter -->
    <script>
        var subscribeForm = document.querySelector(".subscribe-form")
        subscribeForm.onsubmit = (e) => {
            e.preventDefault()
            var email = e.target.querySelector('input')
            if (!email.value) {
                toastr.error('Vous devez remplir le champ!')
                return
            }
            var button_subscribe = e.target.querySelector('button')
            button_subscribe.innerHTML = `<div class="spinner-border" role="status" style="height:18px !important; width:18px !important">
                                          <span class="visually-hidden">Loading...</span>
                                          </div>`
            url = "{{ route('newsletter') }}"
            button_subscribe.setAttribute("type", "button")
            fetch(url, {
                    method: "POST",
                    body: JSON.stringify({
                        email: email.value
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        toastr.info(data.message);
                        button_subscribe.innerHTML = 'submit'
                        email.value = ''

                    } else {
                        toastr.error(data.message)
                        button_subscribe.innerHTML = 'submit'
                    }
                    button_subscribe.setAttribute("type", "submit")
                }).catch(err => console.log(err))

        }
    </script>

    <!--  Delete item from  cart -->
    <script>
        function deleteItemCart(rowId) {
            var url = "{{ route('cart_remove') }}";
            fetch(url, {
                method: 'DELETE',
                body: JSON.stringify({
                    rowId: rowId
                }),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json()).then(data => {
                if (data.status == 'success') {
                    var items = document.querySelectorAll(`.item-${rowId}`)
                    items.forEach(e => e.remove())
                    var cartCount = document.querySelector(".cart-count");
                    cartCount.setAttribute('data-count', Number(cartCount
                        .getAttribute('data-count')) - 1)
                    var shoppingCartList = document.querySelector(
                        ".shopping-cart-list")
                    var miniCartBtn = document.querySelector(".mini-cart-btn")
                    var currentRoute = "{{ Route::currentRouteName() }}"
                    if (Number(cartCount.getAttribute('data-count')) == 0) {
                        miniCartBtn.classList.add('d-none')

                        if (currentRoute == 'user.cart_view')
                            window.location.href = "/"
                    }
                    var subTotal = document.querySelectorAll(".sub-total")
                    subTotal.forEach(e => {
                        e.innerHTML = "{{ $currency_icon }}" + Number(data
                            .sub_total)
                    });

                    if (currentRoute == 'user.cart_view') {
                        var total = document.querySelector('.total-cart .total')
                        var discount_val = document.querySelector(".total-cart .discount")
                        discount_val.innerHTML = "{{ $currency_icon }}" + data.discount_value
                        total.innerHTML = "{{ $currency_icon }}" + (data.sub_total - data.discount_value)
                    }

                }
            }).catch(function(err) {
                console.log(err)
            });
        }
    </script>
    @stack('scripts')
    @stack('styles')
</body>


</html>
