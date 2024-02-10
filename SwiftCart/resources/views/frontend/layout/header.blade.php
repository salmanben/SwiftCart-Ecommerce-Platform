<header class="py-3 border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-2 col-sm-4 d-block d-lg-none">
                <i class="fa-solid fa-bars fs-4 open-mobile-menu"></i>
            </div>
            <div class="col-8 col-sm-4 col-lg-2 ">
                <div>
                    <a href="/" class="d-flex align-items-center justify-content-center text-warning">
                        @if ($general_setting)
                            <img src="{{ asset('storage/upload/' . $general_setting->logo) }}" class="me-2 img-fluid logo"
                                alt="logo">
                        @else
                            <img src="{{ asset('site_image/site_logo.png') }}" class="img-fluid me-2 logo"
                                alt="logo">
                        @endif
                        <h5 class="fw-normal me-4" style = "position: relative;top:6px">
                            <span>
                                @if ($general_setting)
                                    {{ $general_setting->site_name }}
                                @else
                                    SwiftCart
                                @endif
                            </span>
                        </h5>
                    </a>

                </div>
            </div>
            <div class="col-lg-4 col-xl-5  d-none  d-lg-block">
                <form action="{{ route('product.filter') }}">
                    <div class="input-group">
                        <select name="category" class="shadow-none category-search bg-warning" id="">
                            <option value="all">
                                All Categories
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="search" placeholder="Search"
                            class="form-control search-input shadow-none" id="">
                        <button type="submit" class="input-group-text"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-2 col-sm-4  col-lg-6 col-xl-5">
                <div class="d-flex align-items-center  justify-content-between">
                    <div class="d-none d-lg-flex align-items-center">
                        <i class="fa-solid fa-headset fs-4 me-2"></i>
                        <div>
                            <span>
                                @if ($general_setting == null)
                                    salmanbenomar250@gmail.com
                                @else
                                    {{ $general_setting->contact_email }}
                                @endif
                            </span>
                            <br>
                            <span>
                                @if ($general_setting == null)
                                    0767331339
                                @else
                                    {{ $general_setting->contact_phone }}
                                @endif
                            </span>
                            <br>
                        </div>
                    </div>
                    <div class="ms-auto d-flex align-items-center">
                        @if (auth()->check())
                            @if (auth()->user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-body d-none d-sm-inline-block"><i
                                        class="fa-regular fa-user fs-3"></i></a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="text-body d-none d-sm-inline-block"><i
                                        class="fa-regular fa-user fs-3"></i></a>
                            @endif
                        @else
                            <a href="{{ route('user.dashboard') }}" class="text-body d-none d-sm-inline-block"><i
                                    class="fa-regular fa-user fs-3"></i></a>
                        @endif
                        <a href="{{ route('user.wish_product.index') }}"
                            class="wish-count text-body mx-3 position-relative heart-icon d-none d-sm-inline-block"
                            data-count="{{ $wish_count }}"><i class="fa-regular fa-heart fs-3"></i></a>
                        <span data-count="{{ Cart::content()->count() }}"
                            class="position-relative  cart-count  shopping-cart-icon"><img
                                src="{{ asset('site_image/shopping-cart.png') }}" class=""
                                alt="shopping-cart"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mini-cart position-fixed top-0  bg-white shadow-sm py-3 px-2">
        <h4 class="d-flex justify-content-between border-bottom pb-2"><span class="text-warning">Shopping Cart
            </span><span><i
                    class="fa-solid fa-x text-white bg-danger d-flex align-items-center justify-content-center close-min-cart"></i></span>
        </h4>
        <ul class="shopping-cart-list list-unstyled pt-2">
            @foreach (Cart::content()->reverse() as $item)
                <li class="item-{{ $item->rowId }} d-flex mb-3 lh-sm">
                    <div class="mini_cart_product_img position-relative">
                        <a href="{{ route('product_details', $item->id) }}">
                            <img src="{{ asset('storage/upload/' . $item->options->image) }}" alt="product"
                                class="img-fluid w-100">
                        </a>
                        <a href="javascript:;" onclick="deleteItemCart('{{ $item->rowId }}')"
                            class="delete-item-mini-cart bg-danger rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                            data-rowId="{{ $item->rowId }}">
                            <span class="fs-4">-</span>
                        </a>
                    </div>
                    <div class="mini_cart_product_text ms-3">
                        <a href="{{ route('product_details', $item->id) }}">{{ $item->name }}</a>
                        <p class="fw-bold mb-0 mt-1">{{ $currency_icon }}{{ $item->price }}</p>
                        <small>Variants Total: {{ $currency_icon }}<span
                                class="variants-total">{{ $item->options->total_variants }}</span>
                        </small>
                        <br>
                        <small>Qty: <span class="qty">{{ $item->qty }}</span>
                        </small>
                    </div>
                </li>
            @endforeach
        </ul>
        <h5 class="mt-2 d-flex justify-content-between">Subtotal <span
                class="sub-total">{{ $currency_icon }}{{ calc_sub_total() }}</span>
        </h5>
        <div class="{{ Cart::content()->count() == 0 ? 'd-none' : '' }} mt-3 mini-cart-btn">
            <a class="btn btn-primary" href="{{ route('user.cart_view') }}">view cart</a>
            <a class="btn btn-warning ms-3" href="{{ route('user.checkout') }}">checkout</a>
        </div>
</header>
