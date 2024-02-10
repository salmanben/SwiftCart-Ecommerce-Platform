@extends('vendor.layout.master')
@section('title', 'product variant | create')
@section('content')
    <section class="section">
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-cart-shopping me-2"></i>Product Variant</h3>
        <div class="section-body container-fluid my-4">
            <a href="{{ route('vendor.product_variant.index', ['id' => $id]) }}" class="btn btn-info mb-3 ml-3">
                <i class="fa-solid fa-left-long"></i>
            </a>
            <div class="card col-12 col-md-6">
                <div class="card-header">
                    <h5 class="fw-normal">Create Variant</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendor.product_variant.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="">Name</label>
                            <input type="text" class="form-control shadow-none" name="name"
                                value = "{{ old('name') }}" placeholder="name" id="">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="hidden" name="product_id" value={{ $id }}>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-control shadow-none" name="status"
                                aria-label="Default select example">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>

                </div>
            </div>
        </div>

    </section>
@endsection
