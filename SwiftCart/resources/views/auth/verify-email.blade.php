@extends('frontend.layout.master')
@section('title', 'verify-email')
@section('content')

    @php
        $general_setting = \App\Models\GeneralSetting::first();
    @endphp
    <section>
        <div class="section-body verify-email-section container-fluid my-3">
            <div class="card mx-auto mt-4">

                <div class="card-body">
                    <img src="{{ $general_setting != null ? asset('storage/upload/' . $general_setting->logo) : asset('site_image/site_logo.png') }}"
                        class="d-block mx-auto" alt="logo">
                    <?php if (session('status') == 'verification-link-sent'): ?>
                    <div class="mb-4 mt-2 text-success">
                        <p>A new verification link has been sent to the email address you provided during registration.</p>
                    </div>
                    <?php endif; ?>
                    <div class="d-flex flex-wrap gap-2 align-items-center mt-4 justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}" class="resend-verification-email-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div>
                                <button type="submit " class="btn btn-success text-white">
                                    Resend Verification Email
                                </button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-sm btn-dark text-white">
                                Log Out
                            </button>
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

            .verify-email-section {
                font-size: 14px;
                max-width: 350px;

            }

            .verify-email-section img {
                width: 80px;

            }


            .verify-email-section p {
                font-size: 15px;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            var resendVerificationEmailForm = document.querySelector(".resend-verification-email-form")
            if (resendVerificationEmailForm) {
                resendVerificationEmailForm.onsubmit = () => {
                    var button = resendVerificationEmailForm.querySelector("button")
                    button.innerText = 'Loading...'
                }
            }
        </script>
    @endpush
@endsection
