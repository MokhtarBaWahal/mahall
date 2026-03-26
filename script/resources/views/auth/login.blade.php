<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ isRtl(str_replace('_', '-', app()->getLocale())) ? 'rtl' : 'ltr'}}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ __('Login') }} - {{ env('APP_NAME') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon.ico') }}">
  @if(isRtl(str_replace('_', '-', app()->getLocale())))
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
  @else
  <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
  @endif
  <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/all.min.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --mahal-accent: #C8933A;
      --mahal-accent-dark: #9E7020;
      --mahal-accent-light: #F0D9A8;
      --mahal-page-bg: #F5F0E8;
      --mahal-card-bg: #FFFFFF;
      --mahal-text-primary: #1A1A1A;
      --mahal-text-muted: #7B7B7B;
      --mahal-border: #E8E0D0;
      --mahal-sidebar-bg: #2C1A0E;
    }
    body, body * { font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif !important; }
    body {
      background: linear-gradient(135deg, #F5F0E8 0%, #EDD9A3 50%, #F5E6CC 100%) !important;
      min-height: 100vh;
    }
    .login-brand img {
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(44, 26, 14, 0.15) !important;
    }
    .card {
      border: 1px solid var(--mahal-border) !important;
      border-radius: 16px !important;
      box-shadow: 0 8px 32px rgba(44, 26, 14, 0.12) !important;
      overflow: hidden;
    }
    .card-header {
      background: var(--mahal-sidebar-bg) !important;
      border-bottom: none !important;
      padding: 20px 24px !important;
      border-radius: 16px 16px 0 0 !important;
    }
    .card-header h4 {
      color: #fff !important;
      font-weight: 700 !important;
      font-size: 18px !important;
      margin: 0 !important;
    }
    .card-body {
      padding: 28px 24px !important;
    }
    .form-group label {
      font-size: 13px !important;
      font-weight: 600 !important;
      color: var(--mahal-text-primary) !important;
    }
    .form-control {
      border: 1px solid var(--mahal-border) !important;
      border-radius: 10px !important;
      padding: 10px 14px !important;
      font-size: 14px !important;
      background: var(--mahal-card-bg) !important;
      color: var(--mahal-text-primary) !important;
    }
    .form-control:focus {
      border-color: var(--mahal-accent) !important;
      box-shadow: 0 0 0 3px rgba(200, 147, 58, 0.15) !important;
    }
    .btn-primary {
      background-color: var(--mahal-accent) !important;
      border-color: var(--mahal-accent) !important;
      border-radius: 10px !important;
      font-weight: 700 !important;
      font-size: 15px !important;
      padding: 12px !important;
      transition: all 0.2s ease !important;
    }
    .btn-primary:hover {
      background-color: var(--mahal-accent-dark) !important;
      border-color: var(--mahal-accent-dark) !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(200, 147, 58, 0.3) !important;
    }
    a { color: var(--mahal-accent) !important; }
    a:hover { color: var(--mahal-accent-dark) !important; }
    .custom-control-input:checked ~ .custom-control-label::before {
      background-color: var(--mahal-accent) !important;
      border-color: var(--mahal-accent) !important;
    }
    .simple-footer {
      color: var(--mahal-text-muted) !important;
      font-size: 12px !important;
    }
    .login-brand {
      margin-bottom: 24px !important;
    }
    .mahal-login-logo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 24px;
    }
    .mahal-login-logo .logo-icon {
      width: 48px;
      height: 48px;
      background: var(--mahal-sidebar-bg);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      color: var(--mahal-accent);
    }
    .mahal-login-logo .logo-text {
      font-size: 28px;
      font-weight: 800;
      color: var(--mahal-sidebar-bg);
    }
  </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="mahal-login-logo">
              <div class="logo-icon">
                <i class="fas fa-store"></i>
              </div>
              <span class="logo-text">{{ env('APP_NAME') }}</span>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>{{ __('Login') }}</h4></div>

              <div class="card-body">

               <form method="POST" class="loginform" class="needs-validation" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <label for="email">{{ __('E-Mail Address') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="form-group">
                  <div class="d-block">
                    <label for="password" class="control-label">{{ __('Password') }}</label>
                    @if (Route::has('password.request'))
                    <div class="float-right">
                      <a href="{{ route('password.request') }}" class="text-small">
                       {{ __(' Forgot Password?') }}
                      </a>
                    </div>
                    @endif
                  </div>
                  <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                  <div class="form-group mt-3">
                    <div class="custom-control custom-checkbox">
                     <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                     <label class="custom-control-label" for="remember-me">{{ __('Remember Me') }}</label>
                   </div>
                 </div>

                 <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block basicbtn" tabindex="4">
                    {{ __('Login') }}
                  </button>
                </div>
              </form>

          <div class="simple-footer mt-4 text-center">
            {{ __('Copyright') }} &copy; {{ env('APP_NAME') }} {{ date('Y') }}
          </div>

      </div>
    </div>
  </section>
</div>

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
</body>
</html>
