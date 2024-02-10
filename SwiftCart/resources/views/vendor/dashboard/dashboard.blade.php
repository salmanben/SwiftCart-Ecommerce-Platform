@extends('vendor.layout.master')
@section('title', 'dashboard')
@section('content')
<section>
    <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fas fa-tachometer me-2"></i>Dashboard</h3>
    <div class="section-body container-fluid my-4">
        <div class="row gy-4">
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background:#4361ee ">
                    <i class="fa-solid fa-cart-shopping fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">TOTAL ORDERS</span>
                    <br>
                    <h5>{{$total_orders}}</h5>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background: #0ABF30">
                    <i class="fa-solid fa-check fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">COMPLETED ORDERS</span>
                    <br>
                    <h5>{{$completed_orders}}</h5>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background: #F58026">
                    <i class="fa-solid fa-spinner fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">PENDING ORDERS</span>
                    <br>
                    <h5>{{$pending_orders}}</h5>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background: gold">
                    <i class="fa-solid fa-star fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">REVIEWS RATING</span>
                    <br>
                    <h5>{{$avg_reviews}}</h5>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background:#9CA3A9">
                    <i class="fa-brands fa-product-hunt fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">PRODUCTS</span>
                    <br>
                    <h5>{{$products}}</h5>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background:#E24D4C">
                    <i class="fa-solid fa-money-bill fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">TOTAL EARNINGS</span>
                    <br>
                    <h5>{{$currency_icon}}{{$total_earnings}}</h5>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background:#E24D4C">
                    <i class="fa-solid fa-money-bill fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">THIS YEAR EARNINGS</span>
                    <br>
                    <h5>{{$currency_icon}}{{$current_year_earnings}}</h5>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background:#E24D4C">
                    <i class="fa-solid fa-money-bill fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">THIS MONTH EARNINGS</span>
                    <br>
                    <h5>{{$currency_icon}}{{$current_month_earnings}}</h5>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card-body text-center text-white px-2  rounded border" style="background:#E24D4C">
                    <i class="fa-solid fa-money-bill fs-3"></i>
                    <br>
                    <span style="font-weight: 500; font-size:14px">TODAY'S EARNINGS</span>
                    <br>
                    <h5>{{$currency_icon}}{{$today_earnings}}</h5>
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
            <div class="col-12 col-md-6">
                <div class="cart-body rounded border bg-white">
                    <select name="statistic_year" class="statistic-year" class="from-control shadow-none"
                        id="">
                    </select>
                    <canvas id="canvas-earning" class="chart-earning"></canvas>
                </div>
            </div>

        </div>
    </div>
</section>
@push('scripts')
    @include('vendor.dashboard.charts')
@endpush
@endsection
