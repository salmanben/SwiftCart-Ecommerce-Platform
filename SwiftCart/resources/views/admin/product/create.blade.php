@extends('admin.layout.master')
@section('title', 'product | create')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Product</h1>
        <div class="section-body my-4 container-fluid">
            <div class="card col-12 col-md-7">
                <div class="card-header">
                    <h5 class="fw-normal">Create Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="">Image</label>
                            <input type="file" class="form-control shadow-none shadow-none" name="image"
                                id="">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Name</label>
                            <input type="text" class="form-control shadow-none shadow-none" name="name"
                                value="{{ old('name') }}" placeholder="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Quantity</label>
                            <input type="number" min=1 class="form-control shadow-none shadow-none" name="quantity"
                                value="{{ old('quantity') }}" placeholder="quantity">
                            @error('quantity')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Category</label>
                                    <select name="category" class="form-control shadow-none shadow-none category"
                                        id="">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Sub Category</label>
                                    <select name="sub_category" class="form-control shadow-none shadow-none sub-category"
                                        id="">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Child Category</label>
                                    <select name="child_category"
                                        class="form-control shadow-none shadow-none child-category" id="">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="">Brand</label>
                            <select name="brand" class="form-control shadow-none shadow-none" id="">
                                <option value="">Select</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Product Type</label>
                            <select class="form-select form-control shadow-none shadow-none" name="product_type"
                                aria-label="Default select example">
                                <option value="">Select</option>
                                <option value="New Arrival">New Arrival</option>
                                <option value="Featured">Featured</option>
                                <option value="Top Product">Top Product</option>
                                <option value="Best Product">Best Product</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="">Price({{$currency_icon}})</label>
                            <input type="text" class="form-control shadow-none shadow-none" name="price"
                                value="{{ old('price') }}" placeholder="price">
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Offer Price({{$currency_icon}})</label>
                                    <input type="text" class="form-control shadow-none shadow-none" name="offer_price"
                                        value="{{ old('offer_price') }}" placeholder="offer price">
                                    @error('offer_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Offer Start Date</label>
                                    <input type="date" class="form-control shadow-none shadow-none"
                                        name="offer_start_date" value="{{ old('offer_start_date') }}"
                                        placeholder="offer start date">
                                    @error('offer_start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Offer End Date</label>
                                    <input type="date" class="form-control shadow-none shadow-none"
                                        name="offer_end_date" value="{{ old('offer_end_date') }}"
                                        placeholder="offer end date">
                                    @error('offer_end_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="">SKU</label>
                            <input type="text" class="form-control shadow-none shadow-none" name="sku"
                                value="{{ old('sku') }}" placeholder="sky">
                            @error('sku')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Video Link</label>
                            <input type="url" class="form-control shadow-none shadow-none" name="video_link"
                                value="{{ old('video_link') }}" placeholder="video link">
                            @error('video_link')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Short Description</label>
                            <input type="text" class="form-control shadow-none shadow-none"
                                placeholder="short description" value="{!! old('short_description') !!}" name="short_description"
                                id="">
                            @error('short_description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Long Description</label>
                            <textarea class="form-control shadow-none summernote" placeholder="long description" name="long_description"
                                id="">
                                {!! old('long_description') !!}
                            </textarea>
                            @error('long_description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-control shadow-none shadow-none" name="status"
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
    @push('scripts')
        <script>
            var category = document.querySelector(".category");
            var sub_category = document.querySelector(".sub-category");
            var child_category = document.querySelector(".child-category");

            var category = document.querySelector(".category");
            var sub_category = document.querySelector(".sub-category");
            var child_category = document.querySelector(".child-category");

            category.onchange = () => {
                sub_category.innerHTML = `<option value="">Select</option>`;
                child_category.innerHTML = `<option value="">Select</option>`;
                var id = category.value;
                fetch('{{ route('admin.product.sub_category') }}?id=' + id, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        data.forEach((e) => {

                            sub_category.innerHTML += `<option value="${e.id}">${e.name}</option>`;
                        });
                    });
            };

            sub_category.onchange = () => {
                child_category.innerHTML = `<option value="">Select</option>`;
                var id = sub_category.value;
                fetch('{{ route('admin.product.child_category') }}?id=' + id, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        data.forEach((e) => {
                            child_category.innerHTML += `<option value="${e.id}">${e.name}</option>`;
                        });
                    });
            };
        </script>
    @endpush
@endsection
