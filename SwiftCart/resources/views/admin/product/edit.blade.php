@extends('admin.layout.master')
@section('title', 'product | edit')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Product</h1>
        <div class="section-body my-4 container-fluid">
            <div class="card col-12 col-md-7">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-normal">Update Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
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
                                value="{{ $product->name }}" placeholder="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Quantity</label>
                            <input type="number" min=1 class="form-control shadow-none shadow-none" name="quantity"
                                value="{{ $product->quantity }}" placeholder="quantity">
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
                                            <option @selected($product->category_id == $category->id) value="{{ $category->id }}">
                                                {{ $category->name }}</option>
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
                                        @foreach ($sub_categories as $sub_category)
                                            <option @selected($product->sub_category_id == $sub_category->id) value="{{ $sub_category->id }}">
                                                {{ $sub_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Child Category</label>
                                    <select name="child_category"
                                        class="form-control shadow-none shadow-none child-category" id="">
                                        <option value="">Select</option>
                                        @foreach ($child_categories as $child_category)
                                            <option @selected($product->child_category_id == $child_category->id) value="{{ $child_category->id }}">
                                                {{ $child_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="">Brand</label>
                            <select name="brand" class="form-control shadow-none shadow-none" id="">
                                <option value="">Select</option>
                                @foreach ($brands as $brand)
                                    <option @selected($product->brand_id == $brand->id) value="{{ $brand->id }}">{{ $brand->name }}
                                    </option>
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
                                <option @selected($product->product_type == 'New Arrival') value="New Arrival">New Arrival</option>
                                <option @selected($product->product_type == 'Featured') value="Featured">Featured</option>
                                <option @selected($product->product_type == 'Top Product') value="Top Product">Top Product</option>
                                <option @selected($product->product_type == 'Best Product') value="Best Product">Best Product</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="">Price({{$currency_icon}})</label>
                            <input type="text" class="form-control shadow-none shadow-none" name="price"
                                value="{{ $product->price }}" placeholder="price">
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Offer Price({{$currency_icon}})</label>
                                    <input type="text" class="form-control shadow-none shadow-none" name="offer_price"
                                        value="{{ $product->offer_price }}" placeholder="offer price">
                                    @error('offer_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Offer Start Date</label>
                                    <input type="date" class="form-control shadow-none shadow-none"
                                        name="offer_start_date" value="{{ $product->offer_start_date }}"
                                        placeholder="offer start date">
                                    @error('offer_start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="">Offer SEnd Date</label>
                                    <input type="date" class="form-control shadow-none shadow-none"
                                        name="offer_end_date" value="{{ $product->offer_end_date }}"
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
                                value="{{ $product->sku }}" placeholder="sky">
                            @error('sku')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Video Link</label>
                            <input type="url" class="form-control shadow-none shadow-none" name="video_link"
                                value="{{ $product->video_link }}" placeholder="video link">
                            @error('video_link')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Short Description</label>
                            <input type="text" class="form-control shadow-none shadow-none"
                                placeholder="short description" value="{!! $product->short_description !!}" name="short_description"
                                id="">
                            @error('short_description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Long Description</label>
                            <textarea class="form-control shadow-none summernote" placeholder="long description" name="long_description"
                                id="">
                                {!! $product->long_description !!}
                            </textarea>
                            @error('long_description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-control shadow-none shadow-none" name="status"
                                aria-label="Default select example">
                                <option @selected($product->status == 1) value="1">Active</option>
                                <option @selected($product->status == 0) value="0">Inactive</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
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
