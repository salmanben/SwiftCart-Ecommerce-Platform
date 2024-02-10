@php
    $address = json_decode($order->order_address);
    $shipping_method = json_decode($order->shipping_method);
    $order_products = $order->order_products->filter(function ($orderProduct) {
        return $orderProduct->product->vendor_id === auth()->user()->vendor->id;
    });
    $total = 0;
@endphp
@extends('vendor.layout.master')
@section('title', 'order | details')
@section('content')

    <section class="section">
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-bag-shopping me-2"></i>Order</h3>
        <div class="section-body container-fluid my-4">
            <div class="px-sm-3 py-3 px-1 w-100 shadow-sm rounded border">
                <div class="content-print">
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
                                    @foreach ($order_products as $order_product)
                                        @php
                                            $total += ($order_product->order_product_price + $order_product->variant_total) * $order_product->qty;
                                        @endphp
                                        <tr>
                                            <td>{{ $order_product->id }}</td>
                                            <td style="width:100px; height:100px">
                                                <a class="text-body "
                                                    href="{{ route('product_details', $order_product->product_id) }}">
                                                    <img src="{{ asset('storage/upload/' . $order_product->product->image) }}"
                                                        class="rounded img-fluid" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                @foreach (json_decode($order_product->variants) as $key => $value)
                                                    <span class="fw-bold">{{ $key }}</span>:
                                                    <span>{{ $value }}</span>
                                                    <br>
                                                @endforeach
                                            </td>
                                            <td>{{ $order->currency_icon }}{{ $order_product->order_product_price + $order_product->variant_total }}
                                            </td>
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
                        <div class="card-body rounded border d-flex align-items-center">
                            <h5 class="text-secondary">Total:</h5>
                            <h5 class="text-body ms-2">{{ $order->currency_icon }}{{ $total }}</h5>
                        </div>

                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-3">
                    <div class="me-2">
                        <label for="" class="fw-bold fs-6">Order Status</label>
                        <select {{ $disabled }} name="" id="" class="select form-control">
                            @foreach (config('order_status.order_status_vendor') as $key => $value)
                                <option @selected($key == $order_product->status) value="{{ $key }}">{{ $value['status'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-warning text-white print" style="position:relative;top:10px"><i
                            class="fa-solid fa-print me-2 text-white"></i>print</button>
                </div>
            </div>
        </div>

    </section>
    @push('scripts')
        <!-- Switch Status -->
        <script>
            var select = document.querySelector('select');
            select.addEventListener('change', function(event) {
                var value = select.value
                var url = "{{ route('vendor.order.switch_status') }}";
                var id = "{{ $order->id }}"
                fetch(url, {
                        method: 'PUT',
                        body: JSON.stringify({
                            value: value,
                            id: id
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status == 'success') {

                            Swal.fire(
                                'Changed',
                                data.message

                            )

                        }

                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Error',
                            "Can't be changed!"
                        )
                        console.log(error)
                    });

            });
        </script>
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
