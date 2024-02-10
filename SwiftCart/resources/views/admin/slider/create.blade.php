@extends('admin.layout.master')
@section('title', 'slider | create')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Slider</h1>
    <div class="section-body my-4 container-fluid">
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h5 class="fw-normal">Create Slider</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="">Banner</label>
                    <input type="file" class="form-control shadow-none" name="banner" id="">
                    @error('banner')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Type</label>
                    <input type="text" class="form-control shadow-none" name="type" value="{{ old('type') }}" placeholder="type">
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Title</label>
                    <input type="text" class="form-control shadow-none" name="title" value="{{ old('title') }}" placeholder="title">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Starting Price</label>
                    <input type="text" class="form-control shadow-none" name="starting_price" value="{{ old('starting_price') }}" placeholder="starting price">
                    @error('starting_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Button Url</label>
                    <input type="url" class="form-control shadow-none" placeholder="button url" value="{{ old('btn_url') }}" name="btn_url" id="">
                    @error('btn_url')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Order</label>
                    <input type="number" class="form-control shadow-none" min=1 name="order" value="{{ old('order') }}" placeholder="write the order number of the slide">
                    @error('order')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>

          </div>
        </div>
      </div>
    </div>

  </section>

@endsection




