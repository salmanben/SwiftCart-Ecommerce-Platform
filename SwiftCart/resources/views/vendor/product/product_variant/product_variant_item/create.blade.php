@extends('vendor.layout.master')
@section('title', 'product variant item | create')
@section('content')
    <section class="section">
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-cart-shopping me-2"></i>Product Variant Item</h3>
        <div class="section-body my-4 container-fluid">
            <a href="{{ route('vendor.product_variant_item.index', ['variant_id' => $product_variant->id]) }}"
                class="btn btn-info mb-3 ml-3">
                <i class="fa-solid fa-left-long"></i>
            </a>
            <div class="card col-12 col-md-6">
                <div class="card-header">
                    <h5 class="fw-normal">Create Product Variant Item</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendor.product_variant_item.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="">Variant Name</label>
                            <input type="text" readonly class=" form-control shadow-none" name="variant_name"
                                value = "{{ $product_variant->name }}" placeholder="variant name" id="">
                        </div>
                        <div class="mb-3">
                            <label class="">Variant Item</label>
                            <input type="text" class=" form-control shadow-none" name="item_name"
                                value = "{{ old('item_name') }}" placeholder="item name" id="">
                            @error('item_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Price({{$currency_icon}})</label>
                            <input type="text" class=" form-control shadow-none" name="price"
                                value = "{{ old('price') }}" placeholder="price" id="">
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Is Default</label>
                            <select class="form-select  form-control shadow-none" name="is_default"
                                aria-label="Default select example">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">Non</option>
                            </select>
                            @error('is_default')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="hidden" name="product_variant_id" value={{ $product_variant->id }}>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select class="form-select  form-control shadow-none" name="status"
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
