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
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/all.min.css') }}">
  <!-- CSS Libraries -->
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/font/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  @if(isRtl(str_replace('_', '-', app()->getLocale())))
  <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
  @endif
  <!-- Mahal Platform Theme — Figma v2 -->
  <style>
:root{
  --m-primary:#361f1a;--m-accent:#79582f;--m-accent-light:#fdcf9c;
  --m-page-bg:#fef8f3;--m-sidebar-bg:#f8f3ee;--m-card-bg:#ffffff;--m-card-alt:#f8f3ee;
  --m-border:#e6e2dd;--m-border-light:#f2ede8;
  --m-text:#361f1a;--m-text-body:#504442;--m-text-muted:#79582f;
  --m-success:#16a34a;--m-success-bg:#dcfce7;--m-warning:#f59e0b;--m-warning-bg:#fef3c7;
  --m-danger:#ef4444;--m-danger-bg:#fef2f2;--m-info:#3b82f6;
  --m-sidebar-w:280px;
  --m-radius-sm:8px;--m-radius-md:16px;--m-radius-lg:24px;--m-radius-xl:32px
}

/* ── Base — font applied to text elements only, NOT icons ── */
body{font-family:'Tajawal','Cairo','Segoe UI',sans-serif!important;background:var(--m-page-bg)!important;color:var(--m-text)!important}
p,span,div,li,td,th,input,select,textarea,button,label,a{font-family:inherit!important}
h1,h2,h3,h4,h5,h6,.stat-value,.welcome-title{font-family:'Cairo','Tajawal',sans-serif!important}
/* Restore icon font families */
.fa,.fab,.fad,.fal,.far,.fas{font-family:'Font Awesome 5 Free'!important}
.fab{font-family:'Font Awesome 5 Brands'!important}
[class*="flaticon-"]{font-family:'flaticon'!important}
a{color:var(--m-accent)}a:hover{color:var(--m-primary)}

/* ── Header / Navbar ── */
.navbar-bg,.main-navbar{background:rgba(254,248,243,.8)!important;backdrop-filter:blur(12px)!important;-webkit-backdrop-filter:blur(12px)!important;border-bottom:none!important;box-shadow:none!important;height:64px}
.main-navbar .navbar-nav .nav-link{color:var(--m-text)!important}
.main-navbar .form-inline .form-control{background:var(--m-sidebar-bg)!important;border:none!important;border-radius:var(--m-radius-sm)!important;padding:10px 16px!important;font-size:14px!important;min-width:280px;color:var(--m-text)!important}
.main-navbar .form-inline .form-control::placeholder{color:var(--m-text-body)!important;opacity:.6}

/* ── Sidebar ── */
.main-sidebar{background:var(--m-sidebar-bg)!important;width:var(--m-sidebar-w)!important;box-shadow:none!important;border-left:none!important;border-right:none!important}
#sidebar-wrapper{background:var(--m-sidebar-bg)!important;width:var(--m-sidebar-w)!important}
.sidebar-brand{background:var(--m-sidebar-bg)!important;border-bottom:none!important;padding:16px 20px!important;height:72px!important;display:flex!important;align-items:center!important;line-height:normal!important;text-align:start!important}
.sidebar-brand a{color:var(--m-primary)!important;text-decoration:none!important;display:flex!important;align-items:center!important;gap:12px;width:100%;letter-spacing:0!important;text-transform:none!important}
.sidebar-brand-sm a{color:var(--m-primary)!important;text-decoration:none!important}
.sidebar-menu{padding:8px 12px!important}
.sidebar-menu>li>a{color:var(--m-text-body)!important;padding:10px 16px!important;font-size:14px!important;font-weight:500!important;border-radius:var(--m-radius-sm)!important;transition:all .2s ease!important;display:flex!important;align-items:center!important;gap:10px;margin-bottom:2px!important;border:none!important}
.sidebar-menu>li>a:hover{background:var(--m-card-bg)!important;color:var(--m-primary)!important}
.sidebar-menu>li.active>a,.sidebar-menu>li>a.active{background:var(--m-card-bg)!important;color:var(--m-primary)!important;font-weight:700!important;box-shadow:0 1px 2px rgba(0,0,0,.05)!important}
.sidebar-menu>li>a i,.sidebar-menu>li>a .fas,.sidebar-menu>li>a .far,.sidebar-menu>li>a .fa{color:var(--m-accent)!important;font-size:16px!important;width:20px!important;text-align:center!important}
.sidebar-menu>li.active>a i,.sidebar-menu>li>a:hover i{color:var(--m-primary)!important}
.sidebar-menu .dropdown-menu{background:var(--m-sidebar-bg)!important;border:none!important;box-shadow:none!important;padding:2px 0!important}
.sidebar-menu .dropdown-menu li a{color:var(--m-text-body)!important;font-size:13px!important;border-radius:var(--m-radius-sm)!important}
.sidebar-menu .dropdown-menu li a:hover,.sidebar-menu .dropdown-menu li a.active{color:var(--m-primary)!important;background:rgba(121,88,47,.08)!important}
.sidebar-menu .menu-header{color:var(--m-text-body)!important;font-size:10px!important;font-weight:700!important;letter-spacing:1px!important;text-transform:uppercase!important;padding:20px 16px 6px!important}
.main-sidebar .btn-primary{background:var(--m-primary)!important;border-color:var(--m-primary)!important;color:#fff!important;border-radius:var(--m-radius-sm)!important;font-weight:600!important}
/* RTL: active indicator on left side */
[dir="rtl"] .sidebar-menu>li.active>a,[dir="rtl"] .sidebar-menu>li>a.active{border-left:4px solid var(--m-accent)!important}
[dir="ltr"] .sidebar-menu>li.active>a,[dir="ltr"] .sidebar-menu>li>a.active{border-right:4px solid var(--m-accent)!important}

/* ── Main Content — sidebar offset ── */
.main-content,.main-wrapper{background:var(--m-page-bg)!important}
.main-content{padding-top:100px!important;padding-bottom:32px!important;width:100%;position:relative}
[dir="ltr"] .main-content{padding-left:calc(var(--m-sidebar-w) + 20px)!important;padding-right:32px!important}
[dir="rtl"] .main-content{padding-right:calc(var(--m-sidebar-w) + 20px)!important;padding-left:32px!important}
/* Footer offset */
.main-footer{display:inline-block;width:100%}
[dir="ltr"] .main-footer{padding-left:calc(var(--m-sidebar-w) + 20px)!important;padding-right:32px!important}
[dir="rtl"] .main-footer{padding-right:calc(var(--m-sidebar-w) + 20px)!important;padding-left:32px!important}
/* Navbar offset — override the 250px default to match our sidebar width */
[dir="ltr"] .navbar{left:var(--m-sidebar-w)!important;right:0!important}
[dir="rtl"] .navbar{right:var(--m-sidebar-w)!important;left:0!important}
/* sidebar-mini overrides */
body.sidebar-mini .main-content,body.sidebar-mini .main-footer{padding-left:90px!important;padding-right:30px!important}
[dir="rtl"] body.sidebar-mini .main-content,[dir="rtl"] body.sidebar-mini .main-footer{padding-right:90px!important;padding-left:30px!important}
body.sidebar-mini .navbar{left:65px!important;right:0!important}
[dir="rtl"] body.sidebar-mini .navbar{right:65px!important;left:0!important}

/* ── Cards ── */
.card{background:var(--m-card-bg)!important;border:none!important;border-radius:var(--m-radius-xl)!important;box-shadow:0 1px 2px rgba(0,0,0,.05)!important}
.card.card-alt{background:var(--m-card-alt)!important}
.card-header{background:transparent!important;border-bottom:1px solid var(--m-border-light)!important;border-radius:var(--m-radius-xl) var(--m-radius-xl) 0 0!important;padding:24px 32px!important}
.card-header h4{font-size:20px!important;font-weight:700!important;color:var(--m-text)!important;margin:0!important}
.card-body{padding:24px 32px!important}

/* ── Stat Cards ── */
.mahal-stat-card{background:var(--m-card-bg);border:none;border-radius:var(--m-radius-lg);padding:24px;position:relative;overflow:hidden;box-shadow:0 1px 2px rgba(0,0,0,.05)}
.mahal-stat-card.dark-card{background:var(--m-primary);border-color:transparent}
.mahal-stat-card.dark-card .stat-value,.mahal-stat-card.dark-card .stat-label,.mahal-stat-card.dark-card span,.mahal-stat-card.dark-card div{color:#fff!important}
.mahal-stat-card .stat-icon{width:48px;height:48px;border-radius:var(--m-radius-md);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:16px}
.mahal-stat-card .stat-icon.icon-accent{background:rgba(253,207,156,.3);color:var(--m-accent)!important}
.mahal-stat-card .stat-icon.icon-success{background:rgba(22,163,74,.12);color:var(--m-success)!important}
.mahal-stat-card .stat-icon.icon-info{background:rgba(59,130,246,.12);color:var(--m-info)!important}
.mahal-stat-card .stat-icon.icon-warning{background:rgba(245,158,11,.12);color:var(--m-warning)!important}
.mahal-stat-card .stat-icon.icon-danger{background:rgba(250,220,210,.6);color:var(--m-danger)!important}
.mahal-stat-card .stat-value{font-size:28px;font-weight:800;color:var(--m-text);line-height:1.2;margin-bottom:4px}
.mahal-stat-card .stat-label{font-size:13px;color:var(--m-text-body);margin-bottom:12px;font-weight:500}
.mahal-stat-card .stat-badge{display:inline-flex;align-items:center;gap:3px;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px}
.stat-badge.up{background:var(--m-success-bg);color:var(--m-success)!important}
.stat-badge.down{background:var(--m-danger-bg);color:var(--m-danger)!important}
.mahal-stat-card .stat-mini-chart{display:flex;align-items:flex-end;gap:4px;height:40px;margin-top:12px}
.mahal-stat-card .stat-mini-chart .bar{width:8px;border-radius:4px;background:var(--m-border)}
.mahal-stat-card .stat-mini-chart .bar.active{background:var(--m-accent)}

/* ── Table ── */
.table{color:var(--m-text)!important}
.table thead th{border-top:none!important;border-bottom:1px solid var(--m-sidebar-bg)!important;font-size:12px!important;font-weight:700!important;color:var(--m-text-body)!important;text-transform:uppercase!important;letter-spacing:.6px!important;padding:16px 24px!important;background:transparent!important}
.table tbody td{border-bottom:1px solid var(--m-sidebar-bg)!important;padding:16px 24px!important;font-size:14px!important;vertical-align:middle!important;color:var(--m-text)!important}
.table tbody tr:hover{background:rgba(121,88,47,.03)!important}

/* ── Badges ── */
.badge{font-size:10px!important;font-weight:700!important;padding:4px 12px!important;border-radius:12px!important}
.badge-success{background:var(--m-success-bg)!important;color:#15803d!important}
.badge-warning{background:var(--m-warning-bg)!important;color:#b45309!important}
.badge-danger{background:var(--m-danger-bg)!important;color:var(--m-danger)!important}
.badge-info{background:rgba(59,130,246,.12)!important;color:var(--m-info)!important}

/* ── Buttons ── */
.btn{border-radius:var(--m-radius-sm)!important;font-weight:600!important;font-size:14px!important}
.btn-primary{background:var(--m-primary)!important;border-color:var(--m-primary)!important;color:#fff!important;box-shadow:0 20px 25px -5px rgba(54,31,26,.1)!important}
.btn-primary:hover{background:#4e342e!important;border-color:#4e342e!important}
.btn-secondary{background:var(--m-border)!important;border-color:var(--m-border)!important;color:var(--m-text)!important;box-shadow:none!important}
.bg-primary,.card-icon.bg-primary,.shadow-primary{background-color:var(--m-accent)!important;border-color:var(--m-accent)!important}
.text-primary{color:var(--m-accent)!important}

/* ── Forms ── */
.form-control{border:1px solid var(--m-border)!important;border-radius:var(--m-radius-sm)!important;background:var(--m-card-bg)!important;color:var(--m-text)!important;font-size:14px!important}
.form-control:focus{border-color:var(--m-accent)!important;box-shadow:0 0 0 3px rgba(121,88,47,.12)!important}

/* ── Progress Bars ── */
.mahal-progress{height:6px;border-radius:12px;background:var(--m-border);overflow:hidden;position:relative}
.mahal-progress .bar{height:100%;border-radius:12px;transition:width .6s ease}
.mahal-progress .bar.success{background:var(--m-success)}
.mahal-progress .bar.warning{background:var(--m-warning)}
.mahal-progress .bar.danger{background:var(--m-danger)}

/* ── Chart toggle tabs ── */
.chart-tabs{display:inline-flex;background:var(--m-border);border-radius:var(--m-radius-sm);padding:4px;gap:2px}
.chart-tabs .tab{padding:6px 16px;border-radius:6px;font-size:12px;font-weight:500;color:var(--m-text-body);cursor:pointer;border:none;background:transparent;transition:all .2s}
.chart-tabs .tab.active{background:var(--m-card-bg);color:var(--m-text);box-shadow:0 1px 2px rgba(0,0,0,.05);font-weight:700}

/* ── Footer ── */
.main-footer{background:var(--m-card-bg)!important;border-top:1px solid var(--m-border-light)!important;color:var(--m-text-body)!important;font-size:13px!important}

/* ── Misc ── */
.dropdown-menu{border:1px solid var(--m-border-light)!important;border-radius:var(--m-radius-md)!important;box-shadow:0 8px 24px rgba(54,31,26,.12)!important}
.dropdown-item:hover,.dropdown-item:focus{background:var(--m-sidebar-bg)!important;color:var(--m-accent)!important}
.alert-warning{background:rgba(245,158,11,.08)!important;border-color:var(--m-warning)!important;color:#92400E!important;border-radius:var(--m-radius-md)!important}

/* ── FAB ── */
[dir="rtl"] .mahal-fab{position:fixed;bottom:32px;right:32px;left:auto}
[dir="ltr"] .mahal-fab{position:fixed;bottom:32px;left:32px;right:auto}
.mahal-fab{width:56px;height:56px;background:var(--m-accent);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff!important;font-size:24px;box-shadow:0 25px 50px -12px rgba(121,88,47,.4);z-index:999;text-decoration:none!important;transition:transform .2s}
.mahal-fab:hover{transform:scale(1.05);color:#fff!important}

/* ── Help widget ── */
.mahal-help-card{background:var(--m-border-light);border-radius:var(--m-radius-md);padding:20px}
.mahal-help-card h5{font-size:14px;font-weight:700;color:var(--m-text);margin-bottom:6px}
.mahal-help-card p{font-size:12px;color:var(--m-text-body);margin-bottom:14px}

/* ── RTL overrides ── */
[dir="rtl"] .main-sidebar .sidebar-menu li a.has-dropdown::after{left:16px;right:auto}
[dir="rtl"] .mr-1{margin-right:0!important;margin-left:.25rem!important}
[dir="rtl"] .mr-2{margin-right:0!important;margin-left:.5rem!important}
[dir="rtl"] .mr-3{margin-right:0!important;margin-left:1rem!important}
[dir="rtl"] .ml-1{margin-left:0!important;margin-right:.25rem!important}
[dir="rtl"] .ml-2{margin-left:0!important;margin-right:.5rem!important}

/* ── Sidebar-gone (mobile toggle) ── */
body.sidebar-gone .main-content,body.sidebar-gone .main-footer{padding-left:30px!important;padding-right:30px!important}
body.sidebar-gone .navbar{left:0!important;right:0!important}

/* ── Responsive ── */
@media(max-width:991px){
  .main-content{padding-left:20px!important;padding-right:20px!important;padding-top:80px!important}
  .main-footer{padding-left:20px!important;padding-right:20px!important}
  .navbar{left:0!important;right:0!important}
}
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
