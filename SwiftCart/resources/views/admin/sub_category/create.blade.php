@extends('admin.layout.master')
@section('title', 'sub category | create')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3 ">Sub Category</h1>
    <div class="section-body my-4 container-fluid">
        <div class="card col-12 col-md-6">
          <div class="card-header">
            <h5 class="fw-normal">Create Sub Category</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.sub_category.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="">Category</label>
                    <select class="form-select form-control shadow-none" name="category_id" aria-label="Default select example">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Name</label>
                    <input type="text" class="form-control shadow-none"  name="name" value = "{{old('name')}}"
                    placeholder="name" id="">
                    @error('name')
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

  </section>




@endsection
