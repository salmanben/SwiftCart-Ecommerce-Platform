@extends('frontend.layout.master')
@section('title', 'login')
@section('content')
    @php
        $general_setting = \App\Models\GeneralSetting::first();
    @endphp
    <section>
        <div class="section-body login-section container-fluid my-3">
            <div>
                <img src="{{ $general_setting != null ? asset('storage/upload/' . $general_setting->logo) : asset('site_image/site_logo.png') }}"
                    class="d-block mx-auto" alt="logo">
                <div class="card mx-auto mt-4">
                    <div class="card-header text-white bg-warning">Login</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class=" text-muted">Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" id="email"
                                    class="form-control shadow-none">
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class=" text-muted">Password</label>
                                    <a href="{{ route('password.request') }}" class="text-decoration-none ms-auto">Forgot
                                        Password?</a>
                                </div>
                                <div class="position-relative">
                                    <input type="password" name="password" id="password" class="form-control shadow-none">
                                    <i class="fa-sharp fa-solid fa-eye text-muted"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" name="remember" class="form-check-input shadow-none"
                                    id="remember-me">
                                <label for="remember-me" class="form-check-label text-muted">Remember Me</label>
                            </div>
                            <button class="btn btn-warning d-block w-100" type="submit">Login</button>
                        </form>
                        <p class="text-muted text-center my-3" style="font-size:12px">LOGIN WITH SOCIAL</p>
                        <div class="d-flex login-social gap-3">
                            <a href="{{ route('google.auth.redirect') }}" class="btn text-white  d-block w-100"
                                style="background: #4285f4">
                                <i class="fa-brands fa-google"></i> <span>Google</span> </a>
                            <a href="{{ route('github.auth.redirect') }}" class="btn text-white flex-1 d-block w-100"
                                style="background:#333">
                                <i class="fa-brands fa-github"></i> <span>Github</span> </a>

                        </div>
                        <p class="mb-0 mt-3">You don't have an account?<a href="{{ route('register') }}"> Sign up here.</a>
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
            .login-section {
                font-size: 14px;
                max-width: 350px;
            }

            .login-section img {
                width: 80px;

            }
            .login-section input:focus {
                border: solid 1px #FFCF17 !important;
                transition: 0.2s;
            }

            .login-section p {
                font-size: 15px;
            }

            .login-section .login-social a:hover {
                box-shadow: 0px 0px 2px #444444
            }

            .login-section .fa-eye {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                right: 8px;
            }

            @media (max-width:357px) {
                .login-section .login-social a span {
                    display: none;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Show Password-->
        <script>
            var faEye = document.querySelector(".login-section .fa-eye")
            faEye.onclick = () => {
                var passwodInput = faEye.previousElementSibling;
                if (passwodInput.type == 'password') {
                    passwodInput.type = 'text'
                    faEye.classList.remove('text-muted')
                    faEye.classList.add('text-warning')
                } else {
                    passwodInput.type = 'password'
                    faEye.classList.remove('text-warning')
                    faEye.classList.add('text-muted')
                }
            }
        </script>
    @endpush
@endsection
