@extends('admin.layout.master')
@section('title', 'child category | edit')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Child Category</h1>
    <div class="section-body my-4 container-fluid">
        <div class="card col-12 col-md-6">
          <div class="card-header d-flex justify-content-between">
            <h5 class="fw-normal">Update Child Category</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.child_category.update', $child_category->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Category</label>
                    <select class="form-select form-control shadow-none select-category"  name="category" aria-label="Default select example">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option @selected($child_category->category_id == $category->id) value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Sub Category</label>
                    <select class="form-select form-control shadow-none select-sub-category" name="sub_category" aria-label="Default select example">
                        <option value="">Select</option>
                        @foreach ($sub_categories as $sub_category)
                           <option @selected($child_category->sub_category_id == $sub_category->id) value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                        @endforeach
                    </select>
                    @error('sub_category')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Name</label>
                    <input type="text" class="form-control shadow-none"  name="name" value = "{{$child_category->name}}"
                    placeholder="name" id="">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option @selected($child_category->status == 1) value="1">Active</option>
                        <option @selected($child_category->status == 0) value="0">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>

          </div>
        </div>
    </div>

</section>
<script>
    var selectCategory = document.querySelector(".select-category");
    var selectSubCategory = document.querySelector(".select-sub-category");

    selectCategory.onchange = () => {
        selectSubCategory.innerHTML = '<option value="">Select</option>';
        id = selectCategory.value;
        if (!id)
            return;

        var url = "{{ route('admin.child_category.sub_category') }}";

        fetch(url, {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            for (var i = 0; i < data.length; i++) {

                selectSubCategory.innerHTML += `<option value="${data[i].id}">${data[i].name}</option>`;
            }
        });
    }
</script>

@endsection
