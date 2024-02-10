@extends('frontend.layout.master')
@section('title', 'wish product')
@section('content')
    <div class="box"
        style="background-image: url('{{ !empty($box_background) ? asset('storage/upload/' . $box_background) : asset('site_image/box.jpg') }}');">
        <div class="overlay">
        </div>
        <div class="container">
            <h1 class="text-white">Wish Product</h1>
            <div class="d-flex">
                <a href="/" class="fs-4">Home</a>
                <a href="" class="text-warning fs-4 ms-4">
                    <i class="fa-solid fa-angle-right text-body bg-white  p-1 me-2"></i>
                    Wish Product
                </a>
            </div>
        </div>
    </div>
    <div class="container wish-product cart my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="table-responsive bg-white  py-4 rounded px-2">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="">Product</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Add to cart</th>
                                <th><a class="btn btn-danger btn-sm clear-all" href="">Clear All</a></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($wish_products as $item)
                                <tr class="item-{{ $item->id }}">

                                    <td><a href="{{ route('product_details', $item->product_id) }}"><img
                                                src="{{ asset('storage/upload/' . $item->product->image) }}" alt="product"
                                                class="rounded"></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('product_details', $item->product_id) }}"
                                            class="text-body">{{ $item->product->name }}</a>
                                    </td>
                                    <td>
                                        <h6 class="total-item fw-bold">
                                            {{ $currency_icon }}{{ $item->product->price }}
                                        </h6>
                                    </td>
                                    <td>
                                        <form action="" method="post" onsubmit="addToCart(event)"
                                            class=" cart-form w-100">
                                            @csrf
                                            <input type="hidden" value = "{{ $item->product_id }}" name="id">
                                            @if (count($item->product->product_variants) > 0)
                                                <div class="row mt-3 d-none">
                                                    @foreach ($item->product->product_variants as $product_variant)
                                                        @if (count($product_variant->product_variant_items) > 0)
                                                            <div class="col-md-4">
                                                                <div class="mb-2">
                                                                    <label
                                                                        for="">{{ $product_variant->name }}</label>
                                                                    <select name="variants_items[]"
                                                                        class="form_select select-variant-items"
                                                                        id="">
                                                                        <option value="">Select</option>
                                                                        @foreach ($product_variant->product_variant_items as $variant_item)
                                                                            <option @selected($variant_item->is_default == 1)
                                                                                value="{{ $variant_item->id }}">
                                                                                {{ $variant_item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                            <input type="hidden" name="qty" value=1>
                                            <button type="submit"
                                                class="btn btn-sm text-white btn-info add-to-cart d-block rounded mx-auto">Add
                                                to cart</button>
                                        </form>
                                    </td>
                                    <td>

                                        <a data-id="{{ $item->id }}"
                                            href="{{ route('user.wish_product.remove', $item->id) }}"
                                            class="wish-delete-item"><i class="fa-solid fa-xmark text-danger fs-4"></i></a>
                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/box.css') }}">
@endsection
@push('styles')
    <style>
        .wish-product {
            min-height: calc(100vh - 610.67px);
        }

        .wish-product table {
            min-width: 600px !important;
            overflow-x: auto;
        }

        .wish-product th,
        .wish-product td {
            vertical-align: middle;
            text-align: center;

        }

        .wish-product table td img {
            max-width: 100px;
        }

        .wish-product a {
            transition: 0.2s
        }

        .wish-product a:not(.clear-all):hover {
            color: #FFCF17 !important;
        }

        .wish-product .fa-xmark {
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')
    <script>
        /* clear wish list */
        var clearAll = document.querySelector(".clear-all")
        clearAll.onclick = (e) => {
            e.preventDefault()
            url = "{{ route('user.wish_product.destroy') }}"
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
    </script>

    <script>
        /* remove product from wish list */
        var wishdeleteButtons = document.querySelectorAll('.wish-delete-item');
        wishdeleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var url = this.getAttribute('href');
                var id = this.getAttribute('data-id')
                fetch(url, {
                        method: 'DELETE',
                        body: JSON.stringify({
                            id: id
                        }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json'
                        }
                    }).then(res => res.json())
                    .then(data => {
                        if (data.status == 'success') {
                            button.parentNode.parentNode.remove()
                            var wishCount = document.querySelectorAll(".wish-count");
                            wishCount[0].setAttribute('data-count', Number(wishCount[0]
                                .getAttribute('data-count')) - 1)
                            wishCount[1].setAttribute('data-count', Number(wishCount[1]
                                .getAttribute('data-count')) - 1)
                            if (Number(wishCount[0].getAttribute('data-count')) == 0) {
                                window.location.href = "/"
                            }
                        }
                    }).catch(function(error) {
                        console.log(error)
                    });
            });
        });
    </script>
@endpush
@endsection
