@extends('vendor.layout.master')
@section('title', 'product variant item | edit')
@section('content')

<section class="section">
    <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-cart-shopping me-2"></i>Product Variant Item</h3>
    <div class="section-body my-4 container-fluid">
        <a href="{{route('vendor.product_variant_item.index', ['variant_id'=>$product_variant_item->product_variant_id])}}"  class="btn btn-info mb-3 ml-3">
            <i class="fa-solid fa-left-long"></i>
        </a>
        <div class="card col-12 col-md-6">
          <div class="card-header">
            <h5 class="fw-normal">Update Product Variant Item</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('vendor.product_variant_item.update', $product_variant_item->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="">Variant Name</label>
                    <input type="text" readonly class=" form-control shadow-none"  name="variant_name" value = "{{$product_variant_item->product_variant->name}}"
                    placeholder="variant name" id="">
                </div>
                <div class="mb-3">
                    <label class="">Variant Item</label>
                    <input type="text"  class=" form-control shadow-none"  name="item_name" value = "{{$product_variant_item->name}}"
                    placeholder="item name" id="">
                    @error('item_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Price({{$currency_icon}})</label>
                    <input type="text"  class=" form-control shadow-none"  name="price" value = "{{$product_variant_item->price}}"
                    placeholder="price" id="">
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Is Default</label>
                    <select class="form-select  form-control shadow-none" name="is_default" aria-label="Default select example">
                        <option value="">Select</option>
                        <option @selected($product_variant_item->is_default == 1) value="1">Yes</option>
                        <option @selected($product_variant_item->is_default == 0) value="0">Non</option>
                    </select>
                    @error('is_default')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="product_variant_id" value={{$product_variant_item->product_variant->id}}>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select  form-control shadow-none" name="status" aria-label="Default select example">
                        <option @selected($product_variant_item->status == 1) value="1">Active</option>
                        <option @selected($product_variant_item->status == 0) value="0">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
        </div>
    </div>

  </section>




@endsection
