@php
    $flash_sale = App\Models\FlashSale::first();
    $exists = false;
    if ($flash_sale && $flash_sale->end_date > now()->toDateString()) {
        $exists = true;
    }
@endphp
<!--============================
        MAIN MENU START
==============================-->
<nav class="d-none d-lg-block main-menu">
    <div class="container py-2">
        <ul class="nav">
            <li class="dropdown nav-item position-relative">
                <a class="btn btn-light shadow-none dropdown-toggle bar control-cat-menu nav-link" type="button"
                    href="#menu-cat" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bars text-body fs-4"></i>
                </a>
                <ul class="dropdown-menu menu-cat" aria-labelledby="menu-cat">
                    <li class="dropdown nav-item position-static"><a
                            href="{{ route('product.filter', ['category' => 'all']) }}"
                            class="dropdown-item d-flex align-items-center justify-content-between"><span><i
                                    class="fa-regular fa-gem me-2 fw-bold"></i>View All Categories</a></span></li>
                    @foreach ($categories as $category)
                        <li class="dropdown nav-item position-static">
                            <a href="{{ route('product.filter', ['category' => $category->name]) }}"
                                class="dropdown-item d-flex align-items-center justify-content-between gap-2">
                                <span><i class="{{ $category->icon }} me-2"></i>{{ $category->name }}</span>
                                @if ($category->sub_categories->count())
                                    <i class="fa-solid fa-caret-right"></i>
                                @endif
                            </a>
                            @if ($category->sub_categories->count())
                                <ul class="dropdown-menu child-menu menu-sub-cat">
                                    @foreach ($category->sub_categories as $sub_category)
                                        <li class="nav-item position-static">
                                            <a href="{{ route('product.filter', ['category' => $category->name, 'sub_category' => $sub_category->name]) }}"
                                                class="dropdown-item d-flex align-items-center justify-content-between gap-2"><span>{{ $sub_category->name }}</span>
                                                @if ($sub_category->child_categories->count())
                                                    <i class="fa-solid fa-caret-right"></i>
                                                @endif
                                            </a>
                                            @if ($sub_category->child_categories->count())
                                                <ul class="dropdown-menu child-menu menu-child-cat">
                                                    @foreach ($sub_category->child_categories as $child_category)
                                                        <li class="nav-item"><a
                                                                href="{{ route('product.filter', ['category' => $category->name, 'sub_category' => $sub_category->name, 'child_category' => $child_category->name]) }}"
                                                                class="dropdown-item"><span>{{ $child_category->name }}</span></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend_vendor.index') }}" class="nav-link">Vendors</a>
            </li>
            @if ($exists)
                <li class="nav-item">
                    <a href="{{ route('flash_sale') }}" class="nav-link">Flash Sale</a>
                </li>
            @endif

            <li class="nav-item">
                <a href="{{ route('popular_products') }}" class="nav-link">Popular Products</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('about.index') }}" class="nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contact.create') }}" class="nav-link">Contact</a>
            </li>
            @if (auth()->check())
                <li class="nav-item ms-auto">
                    @if (auth()->user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">My Account</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="nav-link">My Account</a>
                    @endif
                </li>
            @else
                <li class="nav-item ms-auto">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
            @endif

        </ul>

    </div>
</nav>

<!--============================
        MAIN MENU END
==============================-->


<!--============================
        MOBILE MENU START
==============================-->
<div class=" mobile-menu position-fixed top-0 left-0 py-3 ">
    <div class="header d-flex align-items-center pe-2 ps-3">
        <a href="{{ route('user.wish_product.index') }}"
            class="text-body position-relative heart-icon-mobile wish-count " data-count="{{ $wish_count }}"><i
                class="fa-regular fa-heart"></i></a>
        @if (auth()->check())
            @if (auth()->user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-white ms-3"><i
                        class="fa-regular fa-user fs-3"></i></a>
            @else
                <a href="{{ route('user.dashboard') }}" class="text-white ms-3"><i
                        class="fa-regular fa-user fs-3"></i></a>
            @endif
        @else
            <a href="{{ route('user.dashboard') }}" class="text-white ms-3"><i class="fa-regular fa-user fs-3"></i></a>
        @endif

        <i class="fa-solid fa-xmark text-white bg-danger rounded d-inline-block ms-auto close-mobile-menu"></i>
    </div>
    <form action="{{ route('product.filter') }}">
        <div class="input-group px-2 my-4">
            <input type="text" name="search" placeholder="Search" class="form-control search-input shadow-none"
                id="">
            <button type="submit" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
    <div class="nav nav-pills" id="nav-tab" role="tablist">
        <button class="nav-link w-50 active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-cat"
            type="button">Ctegories</button>
        <button class="nav-link w-50 " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-main-menu"
            type="button">Main Menu</button>
    </div>
    <div class="tab-content mt-2" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-cat" role="tabpanel">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('product.filter', ['category' => 'all']) }}"
                        class="nav-link text-white collapsed"><i class="fa-regular fa-gem me-2"></i>View All
                        Categories</a></li>
                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a href="{{ route('product.filter', ['category' => $category->name]) }}"
                            class="nav-link d-flex align-items-center text-white justify-content-between collapsed"
                            data-bs-toggle="collapse" data-bs-target="#cat_{{ $category->id }}">
                            <span><i class="{{ $category->icon }} me-2"></i>{{ $category->name }}</span>
                            @if ($category->sub_categories->count())
                                <i class="fa-solid fa-caret-down "></i>
                            @endif

                        </a>
                        @if ($category->sub_categories->count())
                            <div class="collapse" id="cat_{{ $category->id }}">
                                <ul class="nav flex-column sub-cat">
                                    @foreach ($category->sub_categories as $sub_category)
                                        <li class="nav-item">
                                            <a href="{{ route('product.filter', ['category' => $category->name, 'sub_category' => $sub_category->name]) }}"
                                                class="nav-link text-white">
                                                {{ $sub_category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="tab-pane fade" id="nav-main-menu" role="tabpanel">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-white">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('frontend_vendor.index') }}" class="nav-link text-white">Vendors</a>
                </li>

                @if ($exists)
                    <li class="nav-item">
                        <a href="{{ route('flash_sale') }}" class="nav-link text-white">Flash Sale</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('popular_products') }}" class="nav-link text-white">Popular Products</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about.index') }}" class="nav-link text-white">About</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact.create') }}" class="nav-link text-white">Contact</a>
                </li>
                @if (auth()->check())
                    <li class="nav-item">
                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">My Account</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="nav-link text-white">My Account</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link text-white">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<!--============================
        MOBILE MENU END
==============================-->
