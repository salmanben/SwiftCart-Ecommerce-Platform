@php
    $general_setting = \App\Models\GeneralSetting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    @if ($general_setting)
        <link rel="icon" href="{{ asset('storage/upload/' . $general_setting->logo) }}">
    @else
        <link rel="icon" href="{{ asset('site_image/site_logo.png') }}">
    @endif
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,500;0,600;1,300;1,600&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="container my-4 admin-login-section">
        <img src="{{ $general_setting != null ? asset('storage/upload/' . $general_setting->logo) : asset('site_image/site_logo.png') }}"
            class="d-block mx-auto" alt="logo">
        <div class="card mx-auto mt-4 rounded border">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class=" text-muted">Email</label>
                        <input type="text" name="email" value="{{old('email')}}" id="email" class="form-control shadow-none">
                        @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="password" class=" text-muted">Password</label>
                            <a href="{{route('password.request')}}" class="text-decoration-none ms-auto">Forgot Password?</a>
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
                        <input type="checkbox" name="remember" class="form-check-input shadow-none" id="remember-me">
                        <label for="remember-me" class="form-check-label text-muted">Remember Me</label>
                    </div>
                    <button class="btn btn-warning d-block w-100" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #FFC107;
            font-family: 'Nunito', sans-serif;
            display: flex;
            align-items: center;
            height: 100vh;

        }

        .admin-login-section {
            font-size: 14px;
            max-width: 350px;
            margin: 0 auto;
        }

        .admin-login-section img {
            width: 80px;

        }

        .admin-login-section .card {
            border-top: solid 2px #FFC107 !important
        }

        .admin-login-section input:focus {
            border: solid 1px #FFCF17 !important;
            transition: 0.2s;
        }

        .admin-login-section p {
            font-size: 15px;
        }


        .admin-login-section .fa-eye {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            right: 8px;
        }
    </style>


    <!-- Show Password-->
    <script>
        var faEye = document.querySelector(".fa-eye")
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
</body>

</html>
