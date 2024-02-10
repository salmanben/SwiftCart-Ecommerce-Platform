@extends('admin.layout.master')
@section('title', 'profile')
@section('content')
<section>
    <h1 class="fw-normal bg-white ps-4 py-3">Profile</h1>
    <div class="section-body my-4 container-fluid">
      <h4 class="section-title">Hi, {{auth()->user()->name}}!</h4>
      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7 mb-5">
          <div class="card">
            <form method="post" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
                @csrf
              <div class="card-header">
                <h5>Edit Profile</h5>
              </div>
              <div class="card-body">
                  @if (auth()->user()->image)
                   <div class="col-6 col-md-4 mb-4">
                    <img src="{{asset('storage/upload/'.auth()->user()->image)}}"
                    class="img-fluid" alt="">
                   </div>
                  @endif
                  <div class="row">
                    <div class=" col-md-6 col-12 mb-3">
                      <label  for="name">Name</label>
                      <input type="text" name="name"  id = "name" placeholder="name"
                      class="form-control shadow-none" value="{{auth()->user()->name}}" >
                      @if ($errors->has('name'))
                        <p class="text-danger">{{$errors->first('name')}}</p>
                      @endif
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <label  for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="email"
                         class="form-control shadow-none" value="{{auth()->user()->email}}" >
                        @if ($errors->has('email'))
                          <p class="text-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <label  for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" placeholder="Phone"
                         class="form-control shadow-none" value="{{auth()->user()->phone}}">
                        @if ($errors->has('phone'))
                          <p class="text-danger">{{$errors->first('phone')}}</p>
                        @endif
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                         <label for="image" >Image</label>
                         <input type="file" name="image" id="image" class="form-control shadow-none">
                         @if ($errors->has('image'))
                           <p class="text-danger">{{$errors->first('image')}}</p>
                         @endif
                    </div>
                  </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
            <form method="post" action="{{route('admin.password.update')}}" enctype="multipart/form-data">
              @csrf
              <div class="card-header">
                <h5>Edit Password</h5>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class=" col-md-6 col-12 mb-2">
                        <label  for="current_password">Current Password</label>
                        <input type="password" name="current_password" id="current_password"
                         placeholder="current password"
                         class="form-control shadow-none"  >
                        @if ($errors->has('current_password'))
                          <p class="text-danger">{{$errors->first('current_password')}}</p>
                        @endif
                    </div>
                    <div class=" col-md-6 col-12 mb-2">
                        <label  for="password">New Password</label>
                        <input type="password" name="password" id="password" placeholder="new password"
                         class="form-control shadow-none"  >
                        @if ($errors->has('password'))
                          <p class="text-danger">{{$errors->first('password')}}</p>
                        @endif
                    </div>
                    <div class=" col-md-6 col-12 mb-2">
                        <label  for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="confirm your  password"
                         class="form-control shadow-none"  >
                        @if ($errors->has('password_confirmation'))
                          <p class="text-danger">{{$errors->first('password_confirmation')}}</p>
                        @endif
                    </div>
                  </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
