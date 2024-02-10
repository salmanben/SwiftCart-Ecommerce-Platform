@extends('frontend.layout.master')
@section('title', 'reset-password')
@section('content')
    @php
        $general_setting = \App\Models\GeneralSetting::first();
    @endphp
    <section>
        <div class="section-body reset-password-section container-fluid my-3">
            <div>
                <img src="{{ $general_setting != null ? asset('storage/upload/' . $general_setting->logo) : asset('site_image/site_logo.png') }}"
                    class="d-block mx-auto" alt="logo">
                <div class="card mx-auto mt-4">
                    <div class="card-header text-white bg-warning">Reset Password</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.store') }}" class="needs-validation" novalidate="">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="mb-3">
                                <label for="email" class=" text-muted">Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" id="email"
                                    class="form-control shadow-none">
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
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

                            <button class="btn btn-warning d-block w-100" type="submit">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            section {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: calc(100vh - 358.67px)
            }

            .reset-password-section {
                font-size: 14px;
                max-width: 350px;
            }

            .reset-password-section img {
                width: 80px;

            }

            .reset-password-section input:focus {
                border: solid 1px #FFCF17 !important;
                transition: 0.2s;
            }

            .reset-password-section p {
                font-size: 15px;
            }


            .reset-password-section .fa-eye {
                position: absolute;
                top: 57%;
                cursor: pointer;
                right: 8px;
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Show Password-->
        <script>
            var faEye = document.querySelectorAll(".reset-password-section .fa-eye")
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
        </script>
    @endpush

@endsection
