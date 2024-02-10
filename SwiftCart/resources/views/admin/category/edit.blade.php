@extends('admin.layout.master')
@section('title', 'category | edit')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Category</h1>
    <div class="section-body my-4 container-fluid">
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="fw-normal">Update Category</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="">Icon</label>
                    <div>
                        <button class="btn btn-primary iconpicker" data-placement="top" data-unselected-class="btn-info" name="icon" data-icon="{{$category->icon}}" role="iconpicker"></button>
                    </div>
                    @error('icon')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Name</label>
                    <input type="text" class="form-control shadow-none"  name="name" value = "{{$category->name}}"
                    placeholder="name" id="">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option value="1" @selected($category->status == 1)>Active</option>
                        <option value="0" @selected($category->status == 0)>Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>

          </div>
        </div>
      </div>
    </div>

  </section>




@endsection
