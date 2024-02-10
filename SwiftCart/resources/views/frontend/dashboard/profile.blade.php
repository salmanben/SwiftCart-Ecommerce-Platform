@extends('frontend.dashboard.layout.master')
@section('title', 'profile')
@section('content')
    <section>
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="far fa-user me-2"></i>Profile</h3>
        <div class="section-body  container-fluid my-4">
            <div class="card col-12 col-md-7 mb-3">
                <div class="card-header">
                    <h5 class="fw-normal">Update Profile</h5>
                </div>
                <div class="card-body">
                    <form method="Post" action="{{ route('user.update_profile') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-5 position-relative col-4">
                            <img src="{{ auth()->user()->image ? asset('storage/upload/' . auth()->user()->image) : asset('site_image/alt_img_profile.png') }}"
                            alt="image" class="img-fluid img-profile">
                        </div>
                        <div class="mb-3">
                            <input name="image" class="form-control shadow-none" type="file">
                            @if ($errors->has('image'))
                                <p class="text-danger">
                                    {{ $errors->first('image') }}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                <input type="text" class="form-control shadow-none" name="name"
                                    value="{{ auth()->user()->name }}" placeholder="Name">
                            </div>
                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                                <input type="text" name="phone" value="{{ auth()->user()->phone }}"
                                    class="form-control shadow-none" placeholder="Phone">

                            </div>
                            @if ($errors->has('phone'))
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control shadow-none" name="email"
                                    value="{{ auth()->user()->email }}" placeholder="Email">
                            </div>
                            @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="">
                            <button class="btn btn-primary mb-4 mt-2" type="submit">update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-12 col-md-7">
                <div class="card-header">
                    <h5 class="fw-normal">Update Password</h5>
                </div>
                <div class="card-body">
                    <form method="Post" action="{{ route('user.update_password') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-unlock-alt"></i>
                                </span>
                                <input type="password" name="current_password" class="form-control shadow-none"
                                    placeholder="Current Password">
                            </div>
                            @if ($errors->has('current_password'))
                                <p class="text-danger">{{ $errors->first('current_password') }}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control shadow-none"
                                    placeholder="New Password">
                            </div>
                            @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password_confirmation" class="form-control shadow-none"
                                    placeholder="Confirm Password">
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            var imgProfile = document.querySelector(".img-profile");
            var inputFile = document.querySelector("input[type='file']");
            inputFile.onchange = () => {
                var file = inputFile.files[0];
                var url = URL.createObjectURL(file);
                imgProfile.src = url;
            };
        </script>
    @endpush

@endsection
