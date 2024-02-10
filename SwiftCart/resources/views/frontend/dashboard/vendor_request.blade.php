@extends('frontend.dashboard.layout.master')
@section('title', 'vendor request')
@section('content')
    <section>
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-shuffle me-2"></i>Vendor Request</h3>
        <div class="section-body container-fluid my-4">
            @if (auth()->user()->vendor)
                @if (auth()->user()->vendor->status == 1)
                    @php
                        abort(404);
                    @endphp
                @else
                    <div class="card-body rounded bg-white border">
                        <h5 class="text-info"><i class="fa-solid fa-info me-2 rounded bg-info text-white"></i>Your request
                            will be processed by the administrator. Thank you for your submission.</h5>
                    </div>
                @endif
            @else
                <div class="card mb-4 mt-4 col-12 col-md-8">
                    <div class="card-header">
                        <h5 class="fw-normal">Send Request</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.vendor_request.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="">Banner</label>
                                <div>
                                    <input class="form-control shadow-none" type="file" name="banner" id="">
                                </div>
                                @error('banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Email</label>
                                <input class="form-control shadow-none" type="text" name="email"
                                    value="{{ old('email') }}" placeholder="email" id="">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Phone</label>
                                <input class="form-control shadow-none" type="text" name="phone"
                                    value="{{ old('phone') }}" placeholder="phone" id="">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Address</label>
                                <input class="form-control shadow-none" type="text" name="address"
                                    value="{{ old('address') }}" placeholder="address" id="">
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Description</label>
                                <textarea name="description" placeholder='description' class="form-control shadow-none summernote">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Shop Name</label>
                                <input class="form-control shadow-none" type="text" name="shop_name"
                                    placeholder='shop name' value="{{ old('shop_name') }}" />
                                @error('shop_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Facebook Link</label>
                                <input class="form-control shadow-none" type="text" name="fb_link"
                                    value="{{ old('fb_link') }}" placeholder="facebook link" id="">
                                @error('fb_link')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Twitter Link</label>
                                <input class="form-control shadow-none" type="text" name="tw_link"
                                    value="{{ old('tw_link') }}" placeholder="twitter link" id="">
                                @error('tw_link')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Instagram Link</label>
                                <input class="form-control shadow-none" type="text" name="insta_link"
                                    value="{{ old('insta_link') }}" placeholder="instagram link" id="">
                                @error('insta_link')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>

                    </div>
                </div>
            @endif

        </div>
    </section>
    @push('styles')
        <style>
            .fa-info {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 30px;
                height: 30px;
                border-radius: 50% !important
            }
        </style>
    @endpush
@endsection
