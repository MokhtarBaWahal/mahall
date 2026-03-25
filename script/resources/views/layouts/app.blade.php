<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ isRtl(str_replace('_', '-', app()->getLocale())) ? 'rtl' : 'ltr'}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
  <!-- INCLUDE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/all.min.css') }}">
  <!-- CSS Libraries -->
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/font/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  @if(isRtl(str_replace('_', '-', app()->getLocale())))
  <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
  @endif
  <!-- Mahal Platform Theme -->
  <link rel="stylesheet" href="{{ asset('assets/css/mahal-theme.css') }}">
  
  @stack('style')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('layouts/partials/header')
      @include('layouts/partials/sidebar')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
         @yield('head')
         <div class="section-body">
         </div>
       </section>
       @yield('content')
     </div>
     <footer class="main-footer">
      <div class="footer-left">
        Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Powered By <a href="{{ url('/') }}">{{ env('APP_NAME') }} v3.9.2</a>
      </div>
      
    </footer>
  </div>
</div>
<!-- General JS Scripts -->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{ asset('assets/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{ asset('assets/js/moment.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
@stack('js')
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>

</body>
</html>
