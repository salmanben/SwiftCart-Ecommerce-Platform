@extends('admin.layout.master')
@section('title', 'product variant | edit')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Product Variant</h1>
    <div class="section-body my-4 container-fluid">
        <a href="{{route('admin.product_variant.index', ['id'=>$product_variant->product_id])}}"  class="btn btn-info mb-3 ml-3">
            <i class="fa-solid fa-left-long"></i>
        </a>
        <div class="card col-12 col-md-6">
          <div class="card-header">
            <h5 class="fw-normal">Update Variant</h5>
          </div>
           <div class="card-body">
            <form action="{{ route('admin.product_variant.update', $product_variant->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="">Name</label>
                    <input type="text" class="form-control shadow-none"  name="name" value = "{{$product_variant->name}}"
                    placeholder="name" id="">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="product_id" value={{$product_variant->product_id}}>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option @selected($product_variant->status == 1) value="1">Active</option>
                        <option @selected($product_variant->status == 0) value="0">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
        </div>
    </div>

  </section>




@endsection
