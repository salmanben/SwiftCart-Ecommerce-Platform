@extends('vendor.layout.master')
@section('title', 'shop profile')
@section('content')
    <section>
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-shop me-2"></i>Shop Profile</h3>
        <div class="section-body container-fluid my-4">
            <div class="card col-12 col-md-7">
                <div class="card-header">
                    <h5 class="fw-normal">Update Vendor Shop Profile</h5>
                </div>

                <div class="card-body">
                    <div class="col-5 col-md-3 mb-2">
                        <img class="img-fluid" src="{{ asset('storage/upload/' . $vendor->banner) }}" alt="banner">
                    </div>
                    <form action="{{ route('vendor.shop_profile.update', $vendor->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="">Banner</label>
                            <div>
                                <input class="form-control shadow-none"type="file" name="banner" id="">
                            </div>
                            @error('banner')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Email</label>
                            <input class="form-control shadow-none"type="text" name="email" value = "{{ $vendor->email }}"
                                placeholder="email" id="">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Phone</label>
                            <input class="form-control shadow-none"type="text" name="phone" value = "{{ $vendor->phone }}"
                                placeholder="phone" id="">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Address</label>
                            <input class="form-control shadow-none"type="text" name="address"
                                value = "{{ $vendor->address }}" placeholder="address" id="">
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Description</label>
                            <textarea name="description" placeholder = 'description' class="form-control shadow-none summernote">{{ $vendor->description }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Shop Name</label>
                            <input class="form-control shadow-none"type="text" name="shop_name" placeholder = 'shop name'
                                value="{{ $vendor->shop_name }}" />
                            @error('shop_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Facebook Link</label>
                            <input class="form-control shadow-none"type="text" name="fb_link"
                                value = "{{ $vendor->fb_link }}" placeholder="facebook link" id="">
                            @error('fb_link')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Twitter Link</label>
                            <input class="form-control shadow-none"type="text" name="tw_link"
                                value = "{{ $vendor->tw_link }}" placeholder="twitter link" id="">
                            @error('tw_link')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Instagram Link</label>
                            <input class="form-control shadow-none"type="text" name="insta_link"
                                value = "{{ $vendor->insta_link }}" placeholder="instagram link" id="">
                            @error('insta_link')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>

                </div>
            </div>
        </div>
        </div>

    </section>
@endsection
