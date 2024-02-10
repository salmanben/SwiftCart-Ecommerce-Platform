@php
    $general_setting = \App\Models\GeneralSetting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css file -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/user.css') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,500;0,600;1,300;1,600&display=swap"
        rel="stylesheet">

    <title>@yield('title')</title>
    <!-- csrf  -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- toastr css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Datatables css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


    @if ($general_setting)
        <link rel="icon" href="{{ asset('storage/upload/' . $general_setting->logo) }}">
    @else
        <link rel="icon" href="{{ asset('site_image/site_logo.png') }}">
    @endif
</head>

<body>

    <div class="wrapper d-flex">
        <aside class="py-4 shadow-sm">
            <div class="aside-header mb-4">
                <a href="/" class="d-flex align-items-center justify-content-center">
                    @if ($general_setting)
                        <img src="{{ asset('storage/upload/' . $general_setting->logo) }}" class="me-2 img-fluid"
                            alt="logo">
                    @else
                        <img src="{{ asset('site_image/site_logo.png') }}" class="img-fluid me-2" alt="logo">
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
            <ul class="nav">
                <li class="nav-item mb-3 position-relative {{ setActive(['user.dashboard']) }}"><a class="nav-link "
                        href="{{ route('user.dashboard') }}"><i class="fa-solid fa-gauge me-2"></i>Dashboard</a></li>
                <li class="nav-item mb-3 position-relative {{ setActive(['user.profile']) }}"><a class="nav-link "
                        href="{{ route('user.profile') }}"><i class="fa-solid fa-user me-2"></i>Profile</a></li>
                <li class="nav-item mb-3 position-relative {{ setActive(['user.address.*']) }}"><a class="nav-link "
                        href="{{ route('user.address.index') }}"><i
                            class="fa-solid fa-address-book me-2"></i>Addresses</a></li>
                <li class="nav-item mb-3 position-relative {{ setActive(['user.order.*']) }}"><a class="nav-link "
                        href="{{ route('user.order.index') }}"><i class="fa-solid fa-bag-shopping me-2"></i>Orders</a>
                </li>
                <li class="nav-item mb-3 position-relative {{ setActive(['user.review.*']) }}"><a class="nav-link "
                        href="{{ route('user.review.index') }}"><i class="fas fa-star me-2"></i>Reviews</a>
                </li>
                @if (!auth()->user()->vendor || auth()->user()->vendor->status == 0)
                    <li class="nav-item mb-3 position-relative {{ setActive(['user.vendor_request.create']) }}"><a
                            class="nav-link " href="{{ route('user.vendor_request.create') }}"><i
                                class="fa-solid fa-shuffle me-2"></i>Vendor Request</a>
                    </li>
                @endif
                @if (auth()->user()->role == 'vendor')
                    <li class="nav-item mb-3 position-relative {{ setActive(['vendor.dashboard']) }}"><a
                            class="nav-link " href="{{ route('vendor.dashboard') }}"><i
                                class="fa-solid fa-shuffle me-2"></i>Switch To Vendor</a>
                    </li>
                @endif
                <li class="nav-item  mb-3 position-relative">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="logout nav-link"><i
                                class="fas fa-sign-out-alt me-2"></i>
                            Log out
                        </a>
                    </form>
                </li>
            </ul>
        </aside>
        <i class="fa-solid fa-bars control-icon fs-4 mx-2 mx-md-4"></i>
        <div class="content">
            <div class="navbar d-flex align-items-center justify-content-between px-2 px-md-4">

                <div class="d-flex align-items-center ms-auto">
                    <div class="d-flex align-items-center">
                        <img src="{{ auth()->user()->image ? asset('storage/upload/' . auth()->user()->image) : asset('site_image/alt_img_profile.png') }}"
                            class="me-2" alt="image">
                        <h6 class="fw-normal text-white user-name">{{ auth()->user()->name }}</h6>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>


    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Js file -->
    <script src="{{ asset('frontend/assets/js/user.js') }}"></script>

    <!-- toastr js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Datatables js -->
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        @if ($errors->any())
            toastr.error("Error")
        @endif
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
    @stack('scripts')
    @stack('styles')

</body>

</html>
