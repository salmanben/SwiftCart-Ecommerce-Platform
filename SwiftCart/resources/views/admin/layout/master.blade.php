@php
    $general_setting = \App\Models\GeneralSetting::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <!-- csrf  -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>@yield('title')</title>
  @if ($general_setting)
      <link rel="icon" href="{{ asset('storage/upload/' . $general_setting->logo) }}">
  @else
      <link rel="icon" href="{{ asset('site_image/site_logo.png') }}">
  @endif


  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- font family -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,500;0,600;1,300;1,600&display=swap" rel="stylesheet">

  <!-- css file -->
  <link rel="stylesheet" href="{{asset("backend/assets/css/admin.css")}}">

  <!-- csrf token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Datatables css -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <!-- Bootstrap icon picker -->
  <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-iconpicker.min.css')}}"/>

  <!-- toastr css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

  <!-- summernote css -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <!-- Select2  -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body>
    <div class="wrapper d-flex">
        @include('admin.layout.sidebar')
        <div class="site-content ms-auto">
            @include('admin.layout.navbar')
            @yield('content')
            <footer class="px-3 py-3 border-top border-solid border-secondary">
                 <div class="container-fluid text-muted">
                   Copyright &copy; 2024 Design By <a href="https://www.linkedin.com/in/salman-ben-omar-19b283250" class="text-decoration-none">Salman Ben Omar</a>
                 </div>
            </footer>
        </div>
    </div>

   <!-- js files -->
   <script defer src="{{asset("backend/assets/js/admin.js")}}"></script>

   <!-- jquery -->
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

   <!-- Bootstrap 5 -->
   <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <!-- Datatables js -->
   <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

   <!-- Bootstrap-Iconpicker Bundle -->
   <script src="{{asset("backend/assets/js/bootstrap-iconpicker.bundle.min.js")}}"></script>

   <!-- toastr js -->
   <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

   <!-- summernote js -->
   <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

   <!-- alert -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!-- Select2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <script>
    $(document).ready(function() {
        // Initialize Select2 for country_name and currency_name fields
        $('.select2').select2();
    });
  </script>

  <script>
    @if ($errors->any())
        toastr.error("Error")
    @endif
  </script>


  <script>
    $(document).ready(function() {
      $('.summernote').summernote();
      $('.iconpicker').iconpicker()
    });
  </script>
  @stack('scripts')
  @stack('styles')
</body>
</html>
