<nav class="navbar navbar-expand-lg main-navbar"
     style="background:#fff;border-bottom:1px solid var(--mahal-border);
            box-shadow:0 2px 12px rgba(44,26,14,0.06);height:64px;padding:0 24px;">

  {{-- ── Toggle sidebar (mobile) ── --}}
  <ul class="navbar-nav mr-3">
    <li>
      <a href="#" data-toggle="sidebar"
         class="nav-link nav-link-lg"
         style="color:var(--mahal-text-primary);font-size:18px;padding:0 8px;">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  {{-- ── Search bar ── --}}
  <form class="form-inline mr-auto" style="flex:1;max-width:380px;">
    <div class="input-group" style="width:100%;">
      <div class="input-group-prepend">
        <span class="input-group-text"
              style="background:var(--mahal-page-bg);border:1px solid var(--mahal-border);
                     border-right:none;border-radius:8px 0 0 8px;padding:0 12px;color:var(--mahal-text-muted);">
          <i class="fas fa-search" style="font-size:13px;"></i>
        </span>
      </div>
      <input type="text"
             class="form-control"
             placeholder="{{ __('Search...') }}"
             style="border-left:none!important;border-radius:0 8px 8px 0!important;
                    background:var(--mahal-page-bg)!important;
                    border:1px solid var(--mahal-border)!important;
                    font-size:13px!important;height:38px;">
    </div>
  </form>

  {{-- ── Right-side icons ── --}}
  <ul class="navbar-nav navbar-right" style="align-items:center;gap:4px;">

    {{-- Help button --}}
    <li class="nav-item d-none d-md-block">
      <a href="#" class="btn btn-help"
         style="background:var(--mahal-page-bg);border:1px solid var(--mahal-border);
                color:var(--mahal-text-primary);border-radius:8px;font-size:13px;
                font-weight:600;padding:6px 14px;text-decoration:none;">
        <i class="fas fa-question-circle mr-1" style="color:var(--mahal-accent);"></i>
        {{ __('Help') }}
      </a>
    </li>

    {{-- Language switcher --}}
    <li class="nav-item d-none d-md-block">
      <a href="#"
         style="display:flex;align-items:center;gap:4px;padding:6px 10px;
                border:1px solid var(--mahal-border);border-radius:8px;
                font-size:13px;font-weight:600;color:var(--mahal-text-primary);
                text-decoration:none;background:var(--mahal-page-bg);">
        <i class="fas fa-globe" style="color:var(--mahal-accent);font-size:13px;"></i>
        {{ strtoupper(app()->getLocale()) }}
      </a>
    </li>

    {{-- Notifications --}}
    <li class="nav-item">
      <a href="#"
         class="nav-link"
         style="color:var(--mahal-text-primary);padding:8px;position:relative;">
        <i class="fas fa-bell" style="font-size:17px;"></i>
        {{-- Unread badge can be injected here --}}
      </a>
    </li>

    {{-- User dropdown --}}
    <li class="dropdown nav-item">
      <a href="#"
         data-toggle="dropdown"
         class="nav-link dropdown-toggle"
         style="display:flex;align-items:center;gap:8px;padding:4px 8px;
                border-radius:8px;color:var(--mahal-text-primary);text-decoration:none;">
        <img alt="{{ Auth::user()->name }}"
             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=C8933A&color=fff"
             style="width:36px;height:36px;border-radius:50%;border:2px solid var(--mahal-accent);">
        <span class="d-none d-lg-inline"
              style="font-size:13px;font-weight:600;max-width:120px;
                     white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
          {{ Auth::user()->name }}
        </span>
        <i class="fas fa-chevron-down" style="font-size:11px;color:var(--mahal-text-muted);"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-right"
           style="min-width:200px;padding:8px 0;border-radius:10px;
                  border:1px solid var(--mahal-border);
                  box-shadow:0 8px 24px rgba(44,26,14,0.12);">

        {{-- Profile header --}}
        <div style="padding:12px 16px 10px;border-bottom:1px solid var(--mahal-border);">
          <div style="font-size:13px;font-weight:700;color:var(--mahal-text-primary);">
            {{ Auth::user()->name }}
          </div>
          <div style="font-size:11px;color:var(--mahal-text-muted);">
            {{ Auth::user()->email }}
          </div>
        </div>

        {{-- Profile settings link --}}
        @if(Auth::user()->role_id == 3)
          @if(Auth::user()->status == 1)
          <a href="{{ route('seller.seller.settings') }}"
             class="dropdown-item"
             style="font-size:13px;padding:10px 16px;color:var(--mahal-text-primary);">
            <i class="far fa-user mr-2" style="color:var(--mahal-accent);width:16px;"></i>
            {{ __('Profile Settings') }}
          </a>
          @else
          <a href="{{ route('merchant.profile.settings') }}"
             class="dropdown-item"
             style="font-size:13px;padding:10px 16px;color:var(--mahal-text-primary);">
            <i class="far fa-user mr-2" style="color:var(--mahal-accent);width:16px;"></i>
            {{ __('Profile Settings') }}
          </a>
          @endif
        @else
        <a href="{{ route('admin.profile.settings') }}"
           class="dropdown-item"
           style="font-size:13px;padding:10px 16px;color:var(--mahal-text-primary);">
          <i class="far fa-user mr-2" style="color:var(--mahal-accent);width:16px;"></i>
          {{ __('Profile Settings') }}
        </a>
        @endif

        <div class="dropdown-divider" style="margin:6px 0;border-color:var(--mahal-border);"></div>

        {{-- Logout --}}
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="dropdown-item"
           style="font-size:13px;padding:10px 16px;color:var(--mahal-danger);">
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
