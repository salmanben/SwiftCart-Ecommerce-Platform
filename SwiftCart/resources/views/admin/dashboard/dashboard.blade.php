@extends('admin.layout.master')
@section('title', 'dashboard')
@section('content')
    <section>
        <h1 class="fw-normal bg-white ps-4 py-3 ">Dashboard</h1>
        <div class="section-body my-4 container-fluid">
            <div class="row gy-4">
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#4361ee">
                        <i class="fa-solid fa-cart-shopping fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">TOTAL ORDERS</span>
                        <br>
                        <h5>{{ $total_orders }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background: #0ABF30">
                        <i class="fa-solid fa-check fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">COMPLETED ORDERS</span>
                        <br>
                        <h5>{{ $completed_orders }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background: #F58026">
                        <i class="fa-solid fa-spinner fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">PENDING ORDERS</span>
                        <br>
                        <h5>{{ $pending_orders }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background: gold">
                        <i class="fa-solid fa-star fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">REVIEWS</span>
                        <br>
                        <h5>{{ $total_reviews }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#9CA3A9">
                        <i class="fa-brands fa-product-hunt fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">PRODUCTS</span>
                        <br>
                        <h5>{{ $products }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#E24D4C">
                        <i class="fa-solid fa-money-bill fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">TOTAL EARNINGS</span>
                        <br>
                        <h5>{{ $currency_icon }}{{ $total_earnings }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#E24D4C">
                        <i class="fa-solid fa-money-bill fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">THIS YEAR EARNINGS</span>
                        <br>
                        <h5>{{ $currency_icon }}{{ $current_year_earnings }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#E24D4C">
                        <i class="fa-solid fa-money-bill fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">THIS MONTH EARNINGS</span>
                        <br>
                        <h5>{{ $currency_icon }}{{ $current_month_earnings }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#E24D4C">
                        <i class="fa-solid fa-money-bill fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">TODAY'S EARNINGS</span>
                        <br>
                        <h5>{{ $currency_icon }}{{ $today_earnings }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#7371fc">
                        <i class="fa-solid fa-building fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">BRANDS</span>
                        <br>
                        <h5>{{ $brands }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#f72585">
                        <i class="fa-solid fa-user fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">SUBSCRIBERS</span>
                        <br>
                        <h5>{{ $newsletter_subscribers }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#001d3d">
                        <i class="fa-solid fa-user fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">CUSTOMERS</span>
                        <br>
                        <h5>{{ $customers }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#001d3d">
                        <i class="fa-solid fa-user fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">VENDORS</span>
                        <br>
                        <h5>{{ $vendors }}</h5>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#001d3d">
                        <i class="fa-solid fa-user fs-3"></i>
                        <br>
                        <span style="font-weight: 500; font-size:14px">ADMINS</span>
                        <br>
                        <h5>{{ $admins }}</h5>
                    </div>
                </div>
            </div>

            <div class="row gy-4 mt-4">
                <div class="col-12 col-md-6">
                    <div class="cart-body rounded border bg-white">
                        <select name="statistic_year" class="statistic-year" class="from-control shadow-none"
                            id="">
                        </select>
                        <canvas id="canvas-orders" class="chart-orders"></canvas>
                    </div>
                </div>
                <div class="col-12 col-md-6 chart-orders-status-div">
                    <canvas id="canvas-orders-status" class="chart-orders-status"></canvas>
                </div>
                <div class="col-12 col-md-6">
                    <div class="cart-body rounded border bg-white">
                        <select name="statistic_year" class="statistic-year" class="from-control shadow-none"
                            id="">
                        </select>
                        <canvas id="canvas-earning" class="chart-earning"></canvas>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="cart-body rounded border bg-white">
                        <select name="statistic_year" class="statistic-year" class="from-control shadow-none"
                            id="">
                        </select>
                        <canvas id="canvas-subscribers" class="chart-subscribers"></canvas>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="cart-body rounded border bg-white">
                        <select name="statistic_year" class="statistic-year" class="from-control shadow-none"
                            id="">
                        </select>
                        <canvas id="canvas-customers" class="chart-customers"></canvas>
                    </div>
                </div>
            </div>

    </section>


    @push('scripts')
        @include('admin.dashboard.charts')
    @endpush
@endsection
