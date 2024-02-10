@extends('frontend.layout.master')
@section('title', 'signup')
@section('content')
    @php
        $general_setting = \App\Models\GeneralSetting::first();
    @endphp
    <section>
        <div class="section-body signup-section container-fluid my-3">
            <div>
                <img src="{{ $general_setting != null ? asset('storage/upload/' . $general_setting->logo) : asset('site_image/site_logo.png') }}"
                    class="d-block mx-auto" alt="logo">
                <div class="card mx-auto mt-4">
                    <div class="card-header text-white bg-warning">Sign up</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" class="needs-validation register-form"
                            novalidate="">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class=" text-muted">Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" id="name"
                                    class="form-control shadow-none">
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="email" class=" text-muted">Email</label>
                                <input type="text" value="{{ old('email') }}" name="email" id="email"
                                    class="form-control shadow-none">
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="phone" class=" text-muted">Phone</label>
                                <input type="text" value="{{ old('phone') }}" name="phone" id="phone"
                                    class="form-control shadow-none">
                                @if ($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">

                                <div class="position-relative">
                                    <label for="password" class=" text-muted">Password</label>
                                    <input type="password" name="password" id="password" class="form-control shadow-none">
                                    <i class="fa-sharp fa-solid fa-eye text-muted"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <div class="position-relative">
                                    <label for="password_confirmation" class=" text-muted">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control shadow-none">
                                    <i class="fa-sharp fa-solid fa-eye text-muted"></i>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </div>
                            <button class="btn btn-warning d-block w-100" type="submit">Sign up</button>
                        </form>
                        <p class="text-muted text-center my-3" style="font-size:12px">SIGN UP WITH SOCIAL</p>
                        <div class="d-flex signup-social gap-3">
                            <a href="{{ route('google.auth.redirect') }}" class="btn text-white  d-block w-100"
                                style="background: #4285f4">
                                <i class="fa-brands fa-google"></i> <span>Google</span> </a>
                            <a href="{{ route('github.auth.redirect') }}" class="btn text-white flex-1 d-block w-100"
                                style="background:#333">
                                <i class="fa-brands fa-github"></i> <span>Github</span> </a>

                        </div>
                        <p class="mb-0 mt-3">You already have an account?<a href="{{ route('login') }}"> Login here.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            section{
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: calc(100vh - 358.67px)
            }
            .signup-section {
                font-size: 14px;
                max-width: 350px;
            }

            .signup-section img {
                width: 80px;

            }



            .signup-section input:focus {
                border: solid 1px #FFCF17 !important;
                transition: 0.2s;
            }

            .signup-section p {
                font-size: 15px;
            }

            .signup-section .signup-social a:hover {
                box-shadow: 0px 0px 2px #444444
            }

            .signup-section .fa-eye {
                position: absolute;
                top: 57%;
                cursor: pointer;
                right: 8px;
            }

            @media (max-width:357px) {
                .signup-section .signup-social a span {
                    display: none;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            var registerForm = document.querySelector(".register-form")
            var faEye = registerForm.querySelectorAll(".fa-eye")
            faEye.forEach(element => {
                element.onclick = () => {
                    var passwodInput = element.previousElementSibling;
                    if (passwodInput.type == 'password') {
                        passwodInput.type = 'text'
                        element.classList.remove('text-muted')
                        element.classList.add('text-warning')
                    } else {
                        passwodInput.type = 'password'
                        element.classList.remove('text-warning')
                        element.classList.add('text-muted')
                    }
                }

            });
            registerForm.onsubmit = () => {
                var button = registerForm.querySelector("button")
                button.innerText = 'Loading...'
            }
        </script>
    @endpush
@endsection
