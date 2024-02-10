@extends('admin.layout.master')
@section('title', 'brand | edit')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Brand</h1>
        <div class="section-body my-4 container-fluid">
            <div class="card col-12 col-md-6">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-normal">Update Brand</h5>
                </div>
                <div class="card-body">
                    <div class="col-5 col-md-3 mb-3">
                        <img class="img-fluid" src="{{ asset('upload/' . $brand->logo) }}" alt="">
                    </div>
                    <form action="{{ route('admin.brand.update', $brand->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="">Logo</label>
                            <input type="file" class="form-control shadow-none" name="logo" id="">
                            @error('logo')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Name</label>
                            <input type="text" class="form-control shadow-none" name="name"
                                value="{{ $brand->name }}" placeholder="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Is Featured</label>
                            <select class="form-select form-control shadow-none" name="is_featured"
                                aria-label="Default select example">
                                <option value="1" @selected($brand->is_featured == 1)>Yes</option>
                                <option value="0" @selected($brand->is_featured == 0)>No</option>
                            </select>
                            @error('is_featured')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-control shadow-none" name="status"
                                aria-label="Default select example">
                                <option value="1" @selected($brand->status == 1)>Active</option>
                                <option value="0" @selected($brand->status == 0)>Inactive</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>

                </div>
            </div>
        </div>

    </section>




@endsection
