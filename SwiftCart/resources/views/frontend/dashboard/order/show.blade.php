@php
    $address = json_decode($order->order_address);
    $shipping_method = json_decode($order->shipping_method);
    $shipping_cost = $order->shipping_method != null ? json_decode($order->shipping_method)->cost : 0;
    $subtotal = $order->sub_total;
    if ($order->coupon != 'null')
    {
        $coupon = json_decode($order->coupon);
        if ($coupon->discount_type == 'percentage')
        {
            $discount = ($coupon->discount * $subtotal) / 100;
        }
        else {
            $discount = $coupon->discount;
        }
    }
    else {
        $discount = 0;
    }

@endphp
@extends('frontend.dashboard.layout.master')
@section('title', 'order | details')
@section('content')
    <section class="section">
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-bag-shopping me-2"></i>Order</h3>
        <div class="section-body container-fluid my-4">
            <div class="w-100 px-sm-3 py-3 px-1 shadow-sm rounded border content-print">
                <div>
                    <h5 class="d-flex flex-wrap justify-content-between"><span class="me-2 mb-1">Invoice ID: </span>
                        <span>{{ $order->invoice_id }}</span>
                    </h5>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <h6 class="text-secondary">Shipped to</h6>
                        <p>{{ $order->user->name }}</p>
                        <p>{{ $address->email }}</p>
                        <p>{{ $address->phone }}</p>
                        <h6 class="mt-2 text-secondary">Address</h6>
                        <p>{{ $address->address }}</p>
                    </div>
                    <div class="col-12 col-md-6 text-start text-md-end">
                        <h6 class="text-secondary">Shipping method</h6>
                        <p>{{ $shipping_method->name }}</p>
                        <h6 class="mt-2 text-secondary">Order date</h6>
                        <p>{{ $order->created_at }}</p>
                    </div>
                </div>
                <div class="mt-5">
                    <h5 class=""><span class="me-2 mb-1">Order Products
                    </h5>
                    <div class="table table-responsive-md">
                        <table class="table table-striped mt-3 text-center table-bordered">
                            <thead>
                                <th>Id</th>
                                <th>Product</th>
                                <th>Variants</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                @foreach ($order->order_products as $order_product)
                                    <tr>
                                        <td>{{ $order_product->id }}</td>
                                        <td style="width:100px; height:100px">
                                            <a class="text-body "
                                                href="{{ route('product_details', $order_product->product_id) }}">
                                                <img src="{{ asset('storage/upload/'.$order_product->product->image) }}" class="rounded img-fluid" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            @foreach (json_decode($order_product->variants) as $key => $value)
                                                <span class="fw-bold">{{ $key }}</span>:
                                                <span>{{ $value }}</span>
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $order->currency_icon }}{{ $order_product->order_product_price + $order_product->variant_total}}</td>
                                        <td>{{ $order_product->qty }}</td>
                                        <td>{{ $order->currency_icon }}{{ ($order_product->order_product_price + $order_product->variant_total) * $order_product->qty }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div>
                    <div class="mt-5  row py-2"style="background: #F7F7F7">
                        <div class="col-6 col-sm-3">
                            <h6 class="text-secondary">Subtotal</h6>
                            <h6 class="text-body mb-3">{{ $order->currency_icon }}{{ $subtotal }}</h6>
                            <h6 class="text-secondary">Shipping</h6>
                            <h6 class="text-body mb-3">{{ $order->currency_icon }}{{ $shipping_cost }}</h6>
                        </div>
                        <div class="col-6 col-sm-3">
                            <h6 class="text-secondary">Discount</h6>
                            <h6 class="text-body mb-3">{{ $order->currency_icon }}{{ $discount }}</h6>
                            <h6 class="text-secondary">Total</h6>
                            <h6 class="text-body mb-3">{{ $order->currency_icon }}{{ $order->amount }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-warning text-white print mt-3" style="position:relative;top:10px"><i
                class="fa-solid fa-print me-2 text-white"></i>print</button>
        </div>
    </section>
    @push('scripts')
        <!-- print -->
        <script>
            var printBtn = document.querySelector(".print");
            var content = document.querySelector(".content-print");

            printBtn.onclick = () => {
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = content.innerHTML;
                window.print();
                document.body.innerHTML = originalContent;
            };
        </script>
    @endpush
@endsection
