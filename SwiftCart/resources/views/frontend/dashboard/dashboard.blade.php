@extends('frontend.dashboard.layout.master')
@section('title', 'dashboard')
@section('content')
    <section>
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-address-book me-2"></i>Dashboard</h3>
        <div class="section-body container-fluid my-4">
            <div class="row gy-4">
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card-body text-center text-white px-2  rounded border" style="background:#4361ee ">
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

            </div>
        </div>
    </section>
@endsection
