<nav class="navbar navbar-expand-lg main-navbar"
     style="background:rgba(254,248,243,.8);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);
            border-bottom:none;box-shadow:none;height:64px;padding:0 32px;">

  {{-- ── Toggle sidebar (mobile) ── --}}
  <ul class="navbar-nav mr-3">
    <li>
      <a href="#" data-toggle="sidebar"
         class="nav-link nav-link-lg"
         style="color:var(--m-text);font-size:18px;padding:0 8px;">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  {{-- ── Search bar ── --}}
  <form class="form-inline mr-auto" style="flex:1;max-width:448px;">
    <div class="input-group" style="width:100%;">
      <input type="text"
             class="form-control"
             placeholder="{{ __('Search...') }}"
             style="border:none!important;border-radius:var(--m-radius-sm)!important;
                    background:var(--m-sidebar-bg)!important;
                    font-size:14px!important;height:40px;padding:10px 16px!important;
                    color:var(--m-text)!important;">
      <div class="input-group-append">
        <span class="input-group-text"
              style="background:var(--m-sidebar-bg);border:none;
                     border-radius:0 var(--m-radius-sm) var(--m-radius-sm) 0;
                     padding:0 14px;color:var(--m-text-body);">
          <i class="fas fa-search" style="font-size:14px;"></i>
        </span>
      </div>
    </div>
  </form>

  {{-- ── Right-side icons ── --}}
  <ul class="navbar-nav navbar-right" style="align-items:center;gap:6px;">

    {{-- Language switcher --}}
    <li class="dropdown nav-item d-none d-md-block">
      <a href="#" data-toggle="dropdown"
         class="nav-link dropdown-toggle"
         style="display:flex;align-items:center;gap:6px;padding:6px 12px;
                border-radius:var(--m-radius-sm);font-size:14px;font-weight:600;
                color:var(--m-text)!important;text-decoration:none;">
        <i class="fas fa-globe" style="font-size:14px;color:var(--m-text-body);"></i>
        {{ strtoupper(app()->getLocale()) }}
      </a>
      <div class="dropdown-menu dropdown-menu-right" style="min-width:140px;padding:6px 0;">
        <form id="lang-form" action="{{ route('translate') }}" method="POST" class="d-none">
          @csrf
          <input type="hidden" name="local" id="lang-input" value="">
        </form>
        @php
          $availableLangs = [
            'ar' => 'العربية',
            'en' => 'English',
          ];
        @endphp
        @foreach($availableLangs as $code => $label)
          <a href="#" class="dropdown-item{{ app()->getLocale() === $code ? ' active' : '' }}"
             style="font-size:14px;padding:8px 16px;{{ app()->getLocale() === $code ? 'font-weight:700;color:var(--m-primary)!important;background:var(--m-sidebar-bg)!important;' : '' }}"
             onclick="event.preventDefault();document.getElementById('lang-input').value='{{ $code }}';document.getElementById('lang-form').submit();">
            {{ $label }}
          </a>
        @endforeach
      </div>
    </li>

    {{-- Help --}}
    <li class="nav-item d-none d-md-block">
      <a href="#" style="display:flex;align-items:center;gap:4px;padding:8px;
                         color:var(--m-text-body)!important;text-decoration:none;font-size:14px;">
        <i class="fas fa-question-circle" style="font-size:16px;"></i>
        <span>{{ __('Help') }}</span>
      </a>
    </li>

    {{-- Notifications --}}
    <li class="nav-item">
      <a href="#" class="nav-link"
         style="color:var(--m-text);padding:8px;position:relative;">
        <i class="fas fa-bell" style="font-size:17px;"></i>
      </a>
    </li>

    {{-- User dropdown --}}
    <li class="dropdown nav-item">
      <a href="#"
         data-toggle="dropdown"
         class="nav-link dropdown-toggle"
         style="display:flex;align-items:center;gap:8px;padding:4px 8px;
                border-radius:var(--m-radius-sm);color:var(--m-text);text-decoration:none;">
        <img alt="{{ Auth::user()->name }}"
             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=79582f&color=fff&size=64"
             style="width:36px;height:36px;border-radius:50%;border:2px solid var(--m-accent);">
      </a>

      <div class="dropdown-menu dropdown-menu-right"
           style="min-width:220px;padding:8px 0;border-radius:var(--m-radius-md);
                  border:1px solid var(--m-border-light);
                  box-shadow:0 8px 24px rgba(54,31,26,.12);">

        {{-- Profile header --}}
        <div style="padding:14px 16px 12px;border-bottom:1px solid var(--m-border-light);">
          <div style="font-size:14px;font-weight:700;color:var(--m-text);">
            {{ Auth::user()->name }}
          </div>
          <div style="font-size:12px;color:var(--m-text-body);">
            {{ Auth::user()->email }}
          </div>
        </div>

        {{-- Profile settings link --}}
        @if(Auth::user()->role_id == 3)
          @if(Auth::user()->status == 1)
          <a href="{{ route('seller.seller.settings') }}"
             class="dropdown-item"
             style="font-size:14px;padding:10px 16px;color:var(--m-text);">
            <i class="far fa-user mr-2" style="color:var(--m-accent);width:16px;"></i>
            {{ __('Profile Settings') }}
          </a>
          @else
          <a href="{{ route('merchant.profile.settings') }}"
             class="dropdown-item"
             style="font-size:14px;padding:10px 16px;color:var(--m-text);">
            <i class="far fa-user mr-2" style="color:var(--m-accent);width:16px;"></i>
            {{ __('Profile Settings') }}
          </a>
          @endif
        @else
        <a href="{{ route('admin.profile.settings') }}"
           class="dropdown-item"
           style="font-size:14px;padding:10px 16px;color:var(--m-text);">
          <i class="far fa-user mr-2" style="color:var(--m-accent);width:16px;"></i>
          {{ __('Profile Settings') }}
        </a>
        @endif

        <div class="dropdown-divider" style="margin:6px 0;border-color:var(--m-border-light);"></div>

        {{-- Logout --}}
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="dropdown-item"
           style="font-size:14px;padding:10px 16px;color:#ba1a1a;">
          <i class="fas fa-sign-out-alt mr-2" style="width:16px;"></i>
          {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </li>

  </ul>
</nav>
