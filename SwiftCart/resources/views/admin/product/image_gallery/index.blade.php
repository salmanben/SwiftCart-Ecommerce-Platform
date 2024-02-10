@extends('admin.layout.master')
@section('title', 'product image gallery')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Product Image Gallery</h1>
    <div class="section-body my-4 container-fluid">
      <div class="card">
        <div class="card-header">
            <h6 class="text-body">Product: {{$product->name}}</h6>
        </div>
        <div class="card-body">
            <form action="{{route('admin.product_image_gallery.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="">Image <span class="text-info">(You can select multiple images)</span></label>
                    <input type="file" class="form-control shadow-none" required name="images[]" multiple id="">
                    @error('images.*')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="product_id" value = "{{$product->id}}" >
                <button class="btn btn-primary" type="submit">Upload</button>

            </form>
        </div>
      </div>
      <div class="section-body mt-5">
      <h5 class="section-title">Product Images Gallery</h5>
      <div class="col-12">
        <div class="card">

          <div class="card-body overflow-auto">
            {{ $dataTable->table() }}
          </div>
        </div>
      </div>
      </div>
    </div>

</section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

