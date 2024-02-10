@extends('admin.layout.master')
@section('title', 'sub category | edit')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Sub Category</h1>
    <div class="section-body my-4 container-fluid">
        <div class="card col-12 col-md-6">
          <div class="card-header">
            <h5 class="fw-normal">Update Sub Category</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.sub_category.update', $sub_category->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Category</label>
                    <select class="form-select form-control shadow-none" name="category_id" aria-label="Default select example">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option @selected($category->id == $sub_category->category_id) value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Name</label>
                    <input type="text" class="form-control shadow-none"  name="name" value = "{{$sub_category->name}}"
                    placeholder="name" id="">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option value="1" @selected($sub_category->status == 1)>Active</option>
                        <option value="0" @selected($sub_category->status == 0)>Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>

          </div>
        </div>
    </div>

  </section>




@endsection
