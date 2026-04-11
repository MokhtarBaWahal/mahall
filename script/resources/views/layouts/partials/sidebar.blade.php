<div class="main-sidebar">
  <aside id="sidebar-wrapper">

    {{-- ── Brand Logo ── --}}
    <div class="sidebar-brand">
      <a href="{{ Auth::user()->role_id == 1 ? route('admin.dashboard') : route('seller.dashboard') }}"
         style="display:flex;align-items:center;gap:12px;text-decoration:none;">
        <span style="background:var(--m-primary);color:#fff;font-weight:900;font-size:20px;
                     width:40px;height:40px;border-radius:10px;display:flex;align-items:center;
                     justify-content:center;">م</span>
        <div>
          <span style="color:var(--m-primary);font-size:24px;font-weight:800;font-family:'Cairo',sans-serif!important;line-height:1;">محل</span>
          <div style="font-size:10px;color:var(--m-text-body);font-weight:500;letter-spacing:1px;text-transform:uppercase;">{{ Auth::user()->name }}</div>
        </div>
      </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="#" style="color:var(--m-primary);font-weight:900;font-size:20px;">م</a>
    </div>

    <ul class="sidebar-menu">

      {{-- ════════════════════════════════
           ADMIN ROLE (role_id == 1)
           ════════════════════════════════ --}}
      @if(Auth::user()->role_id == 1)

        @can('dashboard')
        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-th-large"></i>
            <span>{{ __('Dashboard') }}</span>
          </a>
        </li>
        @endcan

        @can('order.list')
        @if(Route::has('admin.order.index'))
        <li class="{{ Request::is('admin/order*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.order.index') }}">
            <i class="fas fa-shopping-bag"></i>
            <span>{{ __('Orders') }}</span>
          </a>
        </li>
        @endif
        @endcan

        @php $plan = false; @endphp
        @can('plan.create') @php $plan = true; @endphp @endcan
        @can('plan.list')   @php $plan = true; @endphp @endcan
        @if($plan && Route::has('admin.plan.index'))
        <li class="dropdown {{ Request::is('admin/plan*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-layer-group"></i>
            <span>{{ __('Plans') }}</span>
          </a>
          <ul class="dropdown-menu">
            @can('plan.create')
            <li><a class="nav-link {{ Request::is('admin/plan/create') ? 'active' : '' }}" href="{{ route('admin.plan.create') }}">{{ __('Create') }}</a></li>
            @endcan
            @can('plan.list')
            <li><a class="nav-link {{ Request::is('admin/plan') ? 'active' : '' }}" href="{{ route('admin.plan.index') }}">{{ __('All Plans') }}</a></li>
            @endcan
          </ul>
        </li>
        @endif

        @if(Route::has('admin.plan.index'))
        @can('report.view')
        <li class="{{ Request::is('admin/report*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.report') }}">
            <i class="fas fa-chart-bar"></i>
            <span>{{ __('Reports') }}</span>
          </a>
        </li>
        @endcan
        @endif

        @if(Route::has('admin.customer.index'))
        @can('customer.create','customer.list','customer.request','customer.list')
        <li class="dropdown {{ Request::is('admin/customer*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-users"></i>
            <span>{{ __('Customers') }}</span>
          </a>
          <ul class="dropdown-menu">
            @can('customer.create')
            <li><a class="nav-link" href="{{ route('admin.customer.create') }}">{{ __('Create Customer') }}</a></li>
            @endcan
            @can('customer.list')
            <li><a class="nav-link" href="{{ route('admin.customer.index') }}">{{ __('All Customers') }}</a></li>
            @endcan
            @can('customer.request')
            <li><a class="nav-link" href="{{ route('admin.customer.index','type=3') }}">{{ __('Customer Request') }}</a></li>
            @endcan
            @can('customer.list')
            <li><a class="nav-link" href="{{ route('admin.customer.index','type=2') }}">{{ __('Suspended Customers') }}</a></li>
            @endcan
          </ul>
        </li>
        @endcan
        @endif

        @can('domain.create','domain.list')
        <li class="dropdown {{ Request::is('admin/domain*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-globe"></i>
            <span>{{ __('Domains') }}</span>
          </a>
          <ul class="dropdown-menu">
            @can('domain.create')
            <li><a class="nav-link" href="{{ route('admin.domain.create') }}">{{ __('Create Domain') }}</a></li>
            @endcan
            @can('domain.list')
            <li><a class="nav-link" href="{{ route('admin.domain.index') }}">{{ __('All Domains') }}</a></li>
            <li><a class="nav-link" href="{{ route('admin.customdomain.index') }}">{{ __('Custom Domains Requests') }}</a></li>
            @endcan
          </ul>
        </li>
        @endcan

        @can('cron_job')
        <li class="{{ Request::is('admin/cron') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.cron.index') }}">
            <i class="fas fa-clock"></i>
            <span>{{ __('Cron Jobs') }}</span>
          </a>
        </li>
        @endcan

        @if(Route::has('admin.payment-geteway.index'))
        @can('payment_gateway.config')
        <li class="{{ Request::is('admin/payment-geteway*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.payment-geteway.index') }}">
            <i class="fas fa-credit-card"></i>
            <span>{{ __('Payment Gateways') }}</span>
          </a>
        </li>
        @endcan
        @endif

        @can('template.list')
        <li class="{{ Request::is('admin/template') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.template.index') }}">
            <i class="fas fa-paint-brush"></i>
            <span>{{ __('Templates') }}</span>
          </a>
        </li>
        @endcan

        @can('page.create','page.list')
        <li class="dropdown {{ Request::is('admin/page*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-file-alt"></i>
            <span>{{ __('Pages') }}</span>
          </a>
          <ul class="dropdown-menu">
            @can('page.create')
            <li><a class="nav-link" href="{{ route('admin.page.create') }}">{{ __('Create Pages') }}</a></li>
            @endcan
            @can('page.list')
            <li><a class="nav-link" href="{{ route('admin.page.index') }}">{{ __('All Pages') }}</a></li>
            @endcan
          </ul>
        </li>
        @endcan

        @can('language_edit')
        <li class="dropdown {{ Request::is('admin/language*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-language"></i>
            <span>{{ __('Language') }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.language.create') }}">{{ __('Create language') }}</a></li>
            <li><a class="nav-link" href="{{ route('admin.language.index') }}">{{ __('Manage language') }}</a></li>
          </ul>
        </li>
        @endcan

        @can('site.settings')
        <li class="dropdown {{ Request::is('admin/appearance*') || Request::is('admin/gallery*') || Request::is('admin/menu*') || Request::is('admin/seo*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-sliders-h"></i>
            <span>{{ __('Appearance') }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.appearance.show','header') }}">{{ __('Frontend Settings') }}</a></li>
            <li><a class="nav-link" href="{{ route('admin.gallery.index') }}">{{ __('Gallery') }}</a></li>
            <li><a class="nav-link" href="{{ route('admin.menu.index') }}">{{ __('Menu') }}</a></li>
            <li><a class="nav-link" href="{{ route('admin.seo.index') }}">{{ __('SEO') }}</a></li>
          </ul>
        </li>
        @endcan

        @can('marketing.tools')
        <li class="{{ Request::is('admin/marketing') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.marketing.index') }}">
            <i class="fas fa-rocket"></i>
            <span>{{ __('Marketing Tools') }}</span>
          </a>
        </li>
        @endcan

        @can('site.settings','environment.settings')
        <li class="dropdown {{ Request::is('admin/site-settings*') || Request::is('admin/system-environment*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-cog"></i>
            <span>{{ __('Settings') }}</span>
          </a>
          <ul class="dropdown-menu">
            @can('site.settings')
            <li><a class="nav-link" href="{{ route('admin.site.settings') }}">{{ __('Site Settings') }}</a></li>
            @endcan
            @can('environment.settings')
            <li><a class="nav-link" href="{{ route('admin.site.environment') }}">{{ __('System Environment') }}</a></li>
            @endcan
          </ul>
        </li>
        @endcan

        @can('admin.list','role.list')
        <li class="dropdown {{ Request::is('admin/role*') || Request::is('admin/users*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-user-shield"></i>
            <span>{{ __('Admins & Roles') }}</span>
          </a>
          <ul class="dropdown-menu">
            @can('role.list')
            <li><a class="nav-link" href="{{ route('admin.role.index') }}">{{ __('Roles') }}</a></li>
            @endcan
            @can('admin.list')
            <li><a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('Admins') }}</a></li>
            @endcan
          </ul>
        </li>
        @endcan

      @endif {{-- end admin --}}


      {{-- ════════════════════════════════
           SELLER ROLE (role_id == 3)
           ════════════════════════════════ --}}
      @if(Auth::user()->role_id == 3)
      @php $plan_limit = user_limit(); @endphp

        {{-- Dashboard --}}
        <li class="{{ Request::is('seller/dashboard*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('seller.dashboard') }}">
            <i class="fas fa-th-large"></i>
            <span>{{ __('Dashboard') }}</span>
          </a>
        </li>

        {{-- Orders --}}
        <li class="{{ Request::is('seller/order*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/seller/orders/all') }}">
            <i class="fas fa-shopping-bag"></i>
            <span>{{ __('Orders') }}</span>
          </a>
        </li>

        {{-- Products --}}
        <li class="dropdown {{ Request::is('seller/product*') || Request::is('seller/inventory*') || Request::is('seller/category*') || Request::is('seller/attribute*') || Request::is('seller/brand*') || Request::is('seller/coupon*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-box-open"></i>
            <span>{{ __('Products') }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('seller.product.index') }}">{{ __('All Products') }}</a></li>
            <li><a class="nav-link" @if(filter_var($plan_limit['inventory']) == true) href="{{ route('seller.inventory.index') }}" @endif>
              {{ __('Inventory') }} @if(filter_var($plan_limit['inventory']) != true) <i class="fa fa-lock text-warning ms-1"></i> @endif
            </a></li>
            <li><a class="nav-link" href="{{ route('seller.category.index') }}">{{ __('Categories') }}</a></li>
            <li><a class="nav-link" href="{{ route('seller.attribute.index') }}">{{ __('Attributes') }}</a></li>
            <li><a class="nav-link" href="{{ route('seller.brand.index') }}">{{ __('Brands') }}</a></li>
            <li><a class="nav-link" href="{{ route('seller.coupon.index') }}">{{ __('Coupons') }}</a></li>
          </ul>
        </li>

        {{-- Transactions --}}
        <li class="{{ Request::is('seller/transection*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('seller.transection.index') }}">
            <i class="fas fa-wallet"></i>
            <span>{{ __('Transactions') }}</span>
          </a>
        </li>

        {{-- Reports --}}
        <li class="{{ Request::is('seller/report*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('seller.report.index') }}">
            <i class="fas fa-chart-line"></i>
            <span>{{ __('Reports') }}</span>
          </a>
        </li>

        {{-- Reviews & Ratings --}}
        <li class="{{ Request::is('seller/review*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('seller.review.index') }}">
            <i class="fas fa-star"></i>
            <span>{{ __('Reviews & Ratings') }}</span>
          </a>
        </li>

        {{-- Shipping --}}
        <li class="dropdown {{ Request::is('seller/location*') || Request::is('seller/shipping*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-truck"></i>
            <span>{{ __('Shipping') }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('seller.location.index') }}">{{ __('Locations') }}</a></li>
            <li><a class="nav-link" href="{{ route('seller.shipping.index') }}">{{ __('Shipping Price') }}</a></li>
          </ul>
        </li>

        {{-- Offers & Ads --}}
        <li class="dropdown {{ Request::is('seller/ads*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-bullhorn"></i>
            <span>{{ __('Offers & Ads') }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('seller.ads.index') }}">{{ __('Bump Ads') }}</a></li>
            <li><a class="nav-link" href="{{ route('seller.ads.show','banner') }}">{{ __('Banner Ads') }}</a></li>
          </ul>
        </li>

        {{-- Marketing Tools --}}
        <li class="dropdown {{ Request::is('seller/marketing*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-rocket"></i>
            <span>{{ __('Marketing Tools') }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('seller.marketing.show','tag-manager') }}">{{ __('Google Tag Manager') }}</a></li>
            <li><a class="nav-link" href="{{ route('seller.marketing.show','facebook-pixel') }}">{{ __('Facebook Pixel') }}</a></li>
            <li><a class="nav-link" href="{{ route('seller.marketing.show','whatsapp') }}">{{ __('Whatsapp API') }}</a></li>
          </ul>
        </li>

        {{-- Technical Support --}}
        <li class="{{ Request::is('seller/support*') ? 'active' : '' }}">
          <a class="nav-link" @if(filter_var($plan_limit['live_support']) == true) href="{{ route('seller.support') }}" @endif>
            <i class="fas fa-headset"></i>
            <span>
              {{ __('Technical Support') }}
              @if(filter_var($plan_limit['live_support']) != true)
                <i class="fa fa-lock text-warning" style="font-size:11px;margin-right:4px;"></i>
              @endif
            </span>
          </a>
        </li>

        {{-- Settings --}}
        <li class="dropdown {{ Request::is('seller/setting*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-cog"></i>
            <span>{{ __('Settings') }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('seller.settings.show','shop-settings') }}">{{ __('Shop Settings') }}</a></li>
            @if(Route::has('admin.payment-geteway.index'))
            <li><a class="nav-link" href="{{ route('seller.settings.show','payment') }}">{{ __('Payment Options') }}</a></li>
            <li><a class="nav-link" href="{{ route('seller.settings.show','plan') }}">{{ __('Subscriptions') }}</a></li>
            @endif
            <li><a class="nav-link" href="{{ route('seller.domain.index') }}">{{ __('Domain Settings') }}</a></li>
          </ul>
        </li>

        {{-- ── Sales Channels Divider ── --}}
        <li class="menu-header">{{ __('SALES CHANNELS') }}</li>

        {{-- Online Store --}}
        <li class="dropdown {{ Request::is('seller/theme*') || Request::is('seller/menu*') || Request::is('seller/page*') || Request::is('seller/slider*') || Request::is('seller/seo*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-store"></i>
            <span>{{ __('Online Store') }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('seller.theme.index') }}">{{ __('Themes') }}</a></li>
            <li><a href="{{ route('seller.menu.index') }}">{{ __('Menus') }}</a></li>
            <li><a href="{{ route('seller.page.index') }}">{{ __('Pages') }}</a></li>
            <li><a href="{{ route('seller.slider.index') }}">{{ __('Sliders') }}</a></li>
            <li><a href="{{ route('seller.seo.index') }}">{{ __('SEO') }}</a></li>
          </ul>
        </li>

      @endif {{-- end seller --}}

    </ul>

    {{-- ── Sidebar footer: Help card + Logout ── --}}
    <div style="padding:16px 24px;margin-top:auto;">
      <div class="mahal-help-card">
        <h5>{{ __('Need Help?') }}</h5>
        <p>{{ __('Our team is ready to help you at any time.') }}</p>
        @if(Auth::user()->role_id == 3)
        <a href="{{ filter_var(user_limit()['live_support'] ?? false) ? route('seller.support') : '#' }}"
           class="btn btn-primary btn-sm w-100" style="font-size:13px;">
          {{ __('Contact Us') }}
        </a>
        @endif
      </div>

      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();"
         style="display:flex;align-items:center;gap:8px;padding:12px 0 0;margin-top:12px;
                font-size:16px;font-weight:500;color:#ba1a1a!important;text-decoration:none;">
        <i class="fas fa-sign-out-alt" style="color:#ba1a1a;"></i>
        {{ __('Logout') }}
      </a>
      <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>

  </aside>
</div>
