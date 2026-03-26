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
  <!-- Mahal Platform Theme (inlined to avoid deployment path issues) -->
  <style>
:root{--mahal-sidebar-bg:#2C1A0E;--mahal-sidebar-hover:#3D2415;--mahal-sidebar-active:#3D2415;--mahal-sidebar-border:rgba(255,255,255,.08);--mahal-accent:#C8933A;--mahal-accent-dark:#9E7020;--mahal-accent-light:#F0D9A8;--mahal-page-bg:#F5F0E8;--mahal-card-bg:#FFFFFF;--mahal-text-primary:#1A1A1A;--mahal-text-muted:#7B7B7B;--mahal-border:#E8E0D0;--mahal-success:#22C55E;--mahal-warning:#F59E0B;--mahal-danger:#EF4444;--mahal-info:#3B82F6;--mahal-sidebar-width:260px}
body,body *{font-family:'Cairo','Segoe UI',Tahoma,sans-serif!important}
body{background-color:var(--mahal-page-bg)!important;color:var(--mahal-text-primary)!important}
.bg-primary,.btn-primary,.card-icon.bg-primary,.shadow-primary{background-color:var(--mahal-accent)!important;border-color:var(--mahal-accent)!important}
.text-primary,a{color:var(--mahal-accent)!important}
a:hover{color:var(--mahal-accent-dark)!important}
.navbar-bg,.main-navbar{background-color:var(--mahal-card-bg)!important;border-bottom:1px solid var(--mahal-border)!important;box-shadow:0 2px 12px rgba(0,0,0,.06)!important;height:64px}
.main-navbar .navbar-nav .nav-link{color:var(--mahal-text-primary)!important}
.main-navbar .form-inline .form-control{background:#F5F0E8!important;border:1px solid var(--mahal-border)!important;border-radius:8px!important;padding:8px 16px!important;font-size:14px!important;min-width:280px;color:var(--mahal-text-primary)!important}
.main-navbar .form-inline .form-control::placeholder{color:var(--mahal-text-muted)!important}
.main-navbar .nav-link-user img{width:38px!important;height:38px!important;border:2px solid var(--mahal-accent)!important}
.main-sidebar{background-color:var(--mahal-sidebar-bg)!important;width:var(--mahal-sidebar-width)!important;box-shadow:-2px 0 20px rgba(0,0,0,.15)!important}
#sidebar-wrapper{background-color:var(--mahal-sidebar-bg)!important;width:var(--mahal-sidebar-width)!important}
.sidebar-brand{background-color:var(--mahal-sidebar-bg)!important;border-bottom:1px solid var(--mahal-sidebar-border)!important;padding:18px 20px!important;height:64px!important;display:flex!important;align-items:center!important}
.sidebar-brand a,.sidebar-brand-sm a{color:#fff!important;text-decoration:none!important}
.sidebar-menu{padding:12px 0!important}
.sidebar-menu>li>a{color:rgba(255,255,255,.75)!important;padding:11px 20px!important;font-size:14px!important;font-weight:500!important;border-radius:0!important;transition:all .2s ease!important;display:flex!important;align-items:center!important;gap:10px;border-left:3px solid transparent!important}
.sidebar-menu>li>a:hover{background-color:var(--mahal-sidebar-hover)!important;color:#fff!important;border-left-color:var(--mahal-accent)!important}
.sidebar-menu>li.active>a,.sidebar-menu>li>a.active{background-color:var(--mahal-sidebar-active)!important;color:#fff!important;border-left-color:var(--mahal-accent)!important;font-weight:600!important}
.sidebar-menu>li>a i,.sidebar-menu>li>a [class^=flaticon],.sidebar-menu>li>a .fas,.sidebar-menu>li>a .far,.sidebar-menu>li>a .fa{color:rgba(255,255,255,.6)!important;font-size:16px!important;width:20px!important;text-align:center!important}
.sidebar-menu>li.active>a i,.sidebar-menu>li.active>a [class^=flaticon],.sidebar-menu>li>a:hover i{color:var(--mahal-accent)!important}
.sidebar-menu .dropdown-menu{background-color:#231508!important;border:none!important;box-shadow:none!important;padding:4px 0!important}
.sidebar-menu .dropdown-menu li a{color:rgba(255,255,255,.65)!important;padding:8px 20px 8px 36px!important;font-size:13px!important}
.sidebar-menu .dropdown-menu li a:hover,.sidebar-menu .dropdown-menu li a.active{color:#fff!important;background-color:rgba(200,147,58,.15)!important}
.sidebar-menu .menu-header{color:rgba(255,255,255,.35)!important;font-size:10px!important;font-weight:700!important;letter-spacing:1.5px!important;text-transform:uppercase!important;padding:16px 20px 6px!important}
.main-sidebar .btn-primary{background-color:var(--mahal-accent)!important;border-color:var(--mahal-accent)!important;color:#fff!important;border-radius:8px!important;font-weight:600!important}
.main-content,.main-wrapper{background-color:var(--mahal-page-bg)!important}
.card{background-color:var(--mahal-card-bg)!important;border:1px solid var(--mahal-border)!important;border-radius:12px!important;box-shadow:0 2px 12px rgba(44,26,14,.07)!important}
.card-header{background-color:var(--mahal-card-bg)!important;border-bottom:1px solid var(--mahal-border)!important;border-radius:12px 12px 0 0!important;padding:16px 20px!important}
.card-header h4{font-size:15px!important;font-weight:700!important;color:var(--mahal-text-primary)!important;margin:0!important}
.card-body{padding:20px!important}
.mahal-stat-card{background:var(--mahal-card-bg);border:1px solid var(--mahal-border);border-radius:12px;padding:20px;position:relative;overflow:hidden;box-shadow:0 2px 12px rgba(44,26,14,.07)}
.mahal-stat-card.dark-card{background:var(--mahal-sidebar-bg);border-color:transparent}
.mahal-stat-card.dark-card *{color:#fff!important}
.mahal-stat-card .stat-icon{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:12px}
.mahal-stat-card .stat-icon.icon-accent{background:rgba(200,147,58,.15);color:var(--mahal-accent)!important}
.mahal-stat-card .stat-icon.icon-success{background:rgba(34,197,94,.12);color:var(--mahal-success)!important}
.mahal-stat-card .stat-icon.icon-info{background:rgba(59,130,246,.12);color:var(--mahal-info)!important}
.mahal-stat-card .stat-icon.icon-warning{background:rgba(245,158,11,.12);color:var(--mahal-warning)!important}
.mahal-stat-card .stat-value{font-size:24px;font-weight:800;color:var(--mahal-text-primary);line-height:1.2;margin-bottom:4px}
.mahal-stat-card .stat-label{font-size:13px;color:var(--mahal-text-muted);margin-bottom:10px}
.mahal-stat-card .stat-badge{display:inline-flex;align-items:center;gap:3px;font-size:12px;font-weight:600;padding:3px 8px;border-radius:20px}
.stat-badge.up{background:rgba(34,197,94,.12);color:var(--mahal-success)!important}
.stat-badge.down{background:rgba(239,68,68,.12);color:var(--mahal-danger)!important}
.mahal-welcome-card{background:linear-gradient(135deg,#F5E6CC 0%,#EDD9A3 100%);border:1px solid #E8C87A;border-radius:12px;padding:24px 28px;position:relative;overflow:hidden}
.mahal-welcome-card .welcome-title{font-size:26px;font-weight:800;color:var(--mahal-sidebar-bg)!important;margin-bottom:6px}
.mahal-welcome-card .welcome-subtitle{font-size:13px;color:#6B5530!important}
.table{color:var(--mahal-text-primary)!important}
.table thead th{border-top:none!important;border-bottom:2px solid var(--mahal-border)!important;font-size:12px!important;font-weight:700!important;color:var(--mahal-text-muted)!important;text-transform:uppercase!important;letter-spacing:.5px!important;padding:12px 16px!important;background:var(--mahal-page-bg)!important}
.table tbody td{border-bottom:1px solid var(--mahal-border)!important;padding:14px 16px!important;font-size:13.5px!important;vertical-align:middle!important}
.table tbody tr:hover{background:rgba(200,147,58,.04)!important}
.badge-success{background-color:rgba(34,197,94,.12)!important;color:var(--mahal-success)!important}
.badge-warning{background-color:rgba(245,158,11,.12)!important;color:var(--mahal-warning)!important}
.badge-danger{background-color:rgba(239,68,68,.12)!important;color:var(--mahal-danger)!important}
.badge-info{background-color:rgba(59,130,246,.12)!important;color:var(--mahal-info)!important}
.badge{font-size:11px!important;font-weight:600!important;padding:4px 10px!important;border-radius:20px!important}
.btn{border-radius:8px!important;font-weight:600!important;font-size:13px!important}
.btn-primary{background-color:var(--mahal-accent)!important;border-color:var(--mahal-accent)!important;color:#fff!important}
.btn-primary:hover{background-color:var(--mahal-accent-dark)!important;border-color:var(--mahal-accent-dark)!important}
.form-control{border:1px solid var(--mahal-border)!important;border-radius:8px!important;background:var(--mahal-card-bg)!important;color:var(--mahal-text-primary)!important;font-size:13.5px!important}
.form-control:focus{border-color:var(--mahal-accent)!important;box-shadow:0 0 0 3px rgba(200,147,58,.15)!important}
.form-group label{font-size:13px!important;font-weight:600!important;color:var(--mahal-text-primary)!important}
.main-footer{background-color:var(--mahal-card-bg)!important;border-top:1px solid var(--mahal-border)!important;color:var(--mahal-text-muted)!important;font-size:13px!important}
.dropdown-menu{border:1px solid var(--mahal-border)!important;border-radius:10px!important;box-shadow:0 8px 24px rgba(44,26,14,.12)!important}
.dropdown-item:hover,.dropdown-item:focus{background-color:var(--mahal-page-bg)!important;color:var(--mahal-accent)!important}
.page-link{color:var(--mahal-accent)!important;border-color:var(--mahal-border)!important;border-radius:6px!important}
.page-item.active .page-link{background-color:var(--mahal-accent)!important;border-color:var(--mahal-accent)!important;color:#fff!important}
.alert-warning{background-color:rgba(245,158,11,.1)!important;border-color:var(--mahal-warning)!important;color:#92400E!important;border-radius:10px!important}
@media(max-width:767px){.main-sidebar{width:260px!important}}
  </style>
  
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
