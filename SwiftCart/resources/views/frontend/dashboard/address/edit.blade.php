@extends('frontend.dashboard.layout.master')
@section('title', 'address | edit')
@section('content')
<section>
    <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-address-book me-2"></i>Address</h3>
    <div class="section-body container-fluid my-4">
        <div class="card">
          <div class="card-header"><h5 class="fw-normal"><i class="fal fa-gift-card me-1 "></i>Update Address</h5></div>
          <div class="card-body">
            <form method="post" action="{{ route('user.address.update', $address->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                            <label>Name <b>*</b></label>
                            <input type="text" class="form-control shadow-none" placeholder="Name" value="{{ $address->name }}" name="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                            <label>Email <b>*</b></label>
                            <input type="email" class="form-control shadow-none" placeholder="Email" name="email" value="{{ $address->email }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                            <label>Phone <b>*</b></label>
                            <input type="text" class="form-control shadow-none" placeholder="Phone" name="phone" value="{{ $address->phone }}">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                            <label>Zip Code <b>*</b></label>
                            <input type="text" class="form-control shadow-none" placeholder="Zip Code" name="zip" value="{{ $address->zip}}">
                            @error('zip')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                            <label>Country <b>*</b></label>
                                <select class="form-control shadow-none" name="country">
                                      <option value="">Select</option>
                                      @foreach (config('settings.country_list') as $item)
                                          <option @selected($address->country == $item) value="{{$item}}">{{$item}}</option>
                                      @endforeach
                                </select>
                            @error('country')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">

                            <label>City <b>*</b></label>
                            <input type="text" class="form-control shadow-none" placeholder="City" name="city" value="{{ $address->city}}">
                            @error('city')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                            <label>State <b>*</b></label>
                            <input type="text" class="form-control shadow-none" placeholder="State" name="state" value="{{ $address->state}}">
                            @error('state')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                            <label>Address <b>*</b></label>
                            <input type="text" class="form-control shadow-none" placeholder="Address" name="address" value="{{ $address->address}}">
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
    </div>
</section>
@endsection
