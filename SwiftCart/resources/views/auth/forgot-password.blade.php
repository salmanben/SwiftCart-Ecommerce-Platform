@extends('frontend.layout.master')
@section('title', 'forgot-password')
@section('content')
    @php
        $general_setting = \App\Models\GeneralSetting::first();
    @endphp
    <section>
        <div class="section-body forgot-password-section container-fluid my-3">
            <div>
                <img src="{{ $general_setting != null ? asset('storage/upload/' . $general_setting->logo) : asset('site_image/site_logo.png') }}"
                    class="d-block mx-auto" alt="logo">
                <div class="card mx-auto mt-4">
                    <div class="card-header text-white bg-warning">Forgot Password</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.email') }}"
                            class="needs-validation forgot-password-form" novalidate="">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class=" text-muted">Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" id="email"
                                    class="form-control shadow-none">
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <button class="btn btn-warning d-block w-100" type="submit">Submit</button>
                        </form>

                        <p class="mb-0 mt-3"><a href="{{ route('login') }}"> Go to login?</a></p>

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

            .forgot-password-section {
                font-size: 14px;
                max-width: 350px;

            }

            .forgot-password-section img {
                width: 80px;

            }



            .forgot-password-section input:focus {
                border: solid 1px #FFCF17 !important;
                transition: 0.2s;
            }

            .forgot-password-section p {
                font-size: 15px;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            var forgotPasswordForm = document.querySelector(".forgot-password-form")
            forgotPasswordForm.onsubmit = () => {

                var button = forgotPasswordForm.querySelector("button[type='submit']")
                var input = forgotPasswordForm.querySelector("input[type='text']")
                if (input.value)
                    button.innerText = 'Loading...'
            }
        </script>
    @endpush

@endsection
