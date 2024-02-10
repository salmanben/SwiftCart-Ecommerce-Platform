@extends('admin.layout.master')
@section('title', 'vendor profile | update')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Vendor Profile</h1>
    <div class="section-body my-4 container-fluid ">
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="fw-normal">Update Vendor Profile</h5>
          </div>
          <div class="card-body">
            <div class="col-5 col-md-3 mb-3">
                <img class="img-fluid rounded" src="{{asset('storage/upload/'.$vendor->banner)}}" alt="">
            </div>
            <form action="{{ route('admin.vendor_profile.update', $vendor->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label >Banner</label>
                    <div>
                        <input type="file" name="banner" id="">
                    </div>
                    @error('banner')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Email</label>
                    <input type="text" class="form-control shadow-none"  name="email" value = "{{$vendor->email}}"
                    placeholder="email" id="">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Phone</label>
                    <input type="text" class="form-control shadow-none"  name="phone" value = "{{$vendor->phone}}"
                    placeholder="phone" id="">
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Address</label>
                    <input type="text" class="form-control shadow-none"  name="address" value = "{{$vendor->address}}"
                    placeholder="address" id="">
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Description</label>
                    <textarea name="description" placeholder = 'description' class="form-control shadow-none summernote">{!! $vendor->description !!}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Shop Name</label>
                    <input type="text" class="form-control shadow-none" name="shop_name" placeholder = 'shop name'
                    value="{{$vendor->shop_name}}"/>
                    @error('shop_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Facebook Link</label>
                    <input type="url" class="form-control shadow-none"  name="fb_link" value = "{{$vendor->fb_link}}"
                    placeholder="facebook link" id="">
                    @error('fb_link')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Twitter Link</label>
                    <input type="url" class="form-control shadow-none"  name="tw_link" value = "{{$vendor->tw_link}}"
                    placeholder="twitter link" id="">
                    @error('tw_link')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Instagram Link</label>
                    <input type="url" class="form-control shadow-none"  name="insta_link" value = "{{$vendor->insta_link}}"
                    placeholder="instagram link" id="">
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
