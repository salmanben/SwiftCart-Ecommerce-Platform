@extends('admin.layout.master')
@section('title', 'brand | create')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Brand</h1>
        <div class="section-body my-4 container-fluid">
            <div class="card col-12 col-md-6">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-normal">Create Brand</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                                value="{{ old('name') }}" placeholder="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Is Featured</label>
                            <select class="form-select form-control shadow-none" name="is_featured"
                                aria-label="Default select example">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('is_featured')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
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
