@extends('layouts.app')
@section('content')
@php $plan = user_limit(); @endphp

{{-- ── Subscription / Account Status Alert ── --}}
@if(Auth::user()->status == 2 || Auth::user()->status == 3)
<div class="alert alert-warning d-flex align-items-center mb-4"
     style="border-radius:10px;border:1px solid #F59E0B;background:rgba(245,158,11,0.1);color:#92400E;">
  <i class="fas fa-exclamation-triangle mr-3" style="font-size:18px;color:#F59E0B;"></i>
  <div>
    {{ __('Dear,') }} <strong>{{ Auth::user()->name }}</strong>
    {{ __(' Your Account Currently') }}
    <strong class="text-danger">
      @if(Auth::user()->status == 2) {{ __('Suspended') }}
      @elseif(Auth::user()->status == 3) {{ __('Pending') }}
      @endif
    </strong>
    {{ __('Mode. Please complete your payment from') }}
    @if(Route::has('merchant.plan'))
      <a href="{{ route('merchant.plan') }}" style="color:var(--mahal-accent);font-weight:700;">{{ __('here') }}</a>
    @endif
    {{ __('or contact the support team.') }}
  </div>
</div>
@endif

{{-- ── Subscription Expiry Warning ── --}}
@php $expireDate = \Carbon\Carbon::now()->addDays(7)->format('Y-m-d'); @endphp
@if(Auth::user()->user_domain->will_expire <= $expireDate)
<div class="alert d-flex align-items-center mb-4"
     style="border-radius:10px;border:1px solid #F59E0B;background:rgba(245,158,11,0.1);color:#92400E;">
  <i class="fas fa-clock mr-3" style="font-size:18px;color:#F59E0B;"></i>
  <div>
    {{ __('Your subscription is ending') }} <strong>{{ \Carbon\Carbon::parse(Auth::user()->user_domain->will_expire)->diffForHumans() }}</strong>.
    {{ __('Please') }}
    <a href="{{ Auth::user()->user_domain->is_trial == 1 ? url('/seller/settings/plan') : url('/seller/plan-renew') }}"
       style="color:var(--mahal-accent);font-weight:700;text-decoration:underline;">
      {{ Auth::user()->user_domain->is_trial == 1 ? __('Enroll in a plan') : __('Renew the plan') }}
    </a>.
  </div>
</div>
@endif

{{-- ════════════════════════════════════════════════
     ROW 1: Welcome Banner + Quick Stats
     ════════════════════════════════════════════════ --}}
<div class="row mb-4">

  {{-- Welcome Card --}}
  <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
    <div class="mahal-welcome-card h-100"
         style="background:linear-gradient(135deg,#F5E6CC 0%,#EDD9A3 100%);
                border:1px solid #E8C87A;border-radius:14px;padding:28px;position:relative;overflow:hidden;">
      <div style="position:absolute;top:-20px;left:-20px;width:120px;height:120px;
                  background:rgba(200,147,58,0.12);border-radius:50%;"></div>
      <div class="welcome-title" style="font-size:26px;font-weight:800;color:#2C1A0E;margin-bottom:6px;">
        🌟 {{ __('Welcome,') }} {{ Auth::user()->name }}
      </div>
      <p class="welcome-subtitle" style="font-size:13px;color:#6B5530;margin-bottom:20px;">
        {{ __('Track your store performance and manage everything from here.') }}
      </p>
      <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('seller.product.create') }}"
           style="background:#2C1A0E;color:#fff;border-radius:8px;font-size:13px;
                  font-weight:700;padding:9px 18px;text-decoration:none;display:inline-flex;
                  align-items:center;gap:6px;">
          <i class="fas fa-plus-circle"></i> {{ __('New Product') }}
        </a>
        <a href="{{ route('seller.report.index') }}"
           style="background:transparent;color:#2C1A0E;border:1.5px solid #2C1A0E;
                  border-radius:8px;font-size:13px;font-weight:700;padding:9px 18px;
                  text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
          <i class="fas fa-chart-bar"></i> {{ __('View Reports') }}
        </a>
      </div>
    </div>
  </div>

  {{-- Quick Stats: 3 mini cards --}}
  <div class="col-lg-6 col-md-12">
    <div class="row h-100">

      {{-- Total Revenue --}}
      <div class="col-4">
        <div class="mahal-stat-card h-100 dark-card"
             style="background:#2C1A0E;border-radius:12px;padding:18px;text-align:center;">
          <div style="font-size:11px;color:rgba(255,255,255,0.6);margin-bottom:8px;font-weight:600;">
            {{ __('Total Revenue') }}
          </div>
          <div style="font-size:20px;font-weight:800;color:#FFFFFF;margin-bottom:4px;" id="total_revenue_quick">
            <img src="{{ asset('uploads/loader.gif') }}" height="18">
          </div>
          <div style="font-size:11px;color:rgba(255,255,255,0.5);">{{ __('SAR') }}</div>
        </div>
      </div>

      {{-- Total Orders --}}
      <div class="col-4">
        <div class="mahal-stat-card h-100"
             style="border-radius:12px;padding:18px;text-align:center;border:1px solid var(--mahal-border);">
          <div style="font-size:11px;color:var(--mahal-text-muted);margin-bottom:8px;font-weight:600;">
            {{ __('Total Orders') }}
          </div>
          <div style="font-size:20px;font-weight:800;color:var(--mahal-text-primary);margin-bottom:4px;" id="orders_quick">
            <img src="{{ asset('uploads/loader.gif') }}" height="18">
          </div>
          <div style="font-size:11px;color:var(--mahal-text-muted);">{{ __('Orders') }}</div>
        </div>
      </div>

      {{-- Avg. Order Value --}}
      <div class="col-4">
        <div class="mahal-stat-card h-100"
             style="border-radius:12px;padding:18px;text-align:center;border:1px solid var(--mahal-border);">
          <div style="font-size:11px;color:var(--mahal-text-muted);margin-bottom:8px;font-weight:600;">
            {{ __('Today\'s Sales') }}
          </div>
          <div style="font-size:20px;font-weight:800;color:var(--mahal-accent);margin-bottom:4px;" id="today_total_sales">
            <img src="{{ asset('uploads/loader.gif') }}" height="18">
          </div>
          <div style="font-size:11px;color:var(--mahal-text-muted);">{{ __('SAR') }}</div>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- ════════════════════════════════════════════════
     ROW 2: Stat Cards (4 cards)
     ════════════════════════════════════════════════ --}}
<div class="row mb-4">

  {{-- Total Sales of Earnings --}}
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card">
      <div class="stat-icon icon-accent">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="stat-label">{{ __('Total Sales of Earnings') }} – {{ date('Y') }}</div>
      <div class="stat-value" id="sales_of_earnings">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
    </div>
  </div>

  {{-- Total Sales --}}
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card">
      <div class="stat-icon icon-success">
        <i class="fas fa-shopping-cart"></i>
      </div>
      <div class="stat-label">{{ __('Total Sales') }} – {{ date('Y') }}</div>
      <div class="stat-value" id="total_sales">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
    </div>
  </div>

  {{-- Yesterday --}}
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card">
      <div class="stat-icon icon-info">
        <i class="fas fa-calendar-day"></i>
      </div>
      <div class="stat-label">{{ __('Yesterday') }}</div>
      <div class="stat-value" id="yesterday_total_sales">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
    </div>
  </div>

  {{-- This Month --}}
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card">
      <div class="stat-icon icon-warning">
        <i class="fas fa-calendar-alt"></i>
      </div>
      <div class="stat-label">{{ __('This Month') }}</div>
      <div class="stat-value" id="monthly_total_sales">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
    </div>
  </div>
</div>

{{-- ════════════════════════════════════════════════
     ROW 3: Earnings Chart + Storage + Order Stats
     ════════════════════════════════════════════════ --}}
<div class="row mb-4">

  {{-- Earnings Performance Chart --}}
  <div class="col-lg-7 col-md-12 mb-3">
    <div class="card mahal-chart-card h-100" style="border-radius:14px;">
      <div class="card-header d-flex justify-content-between align-items-center" style="border-bottom:1px solid var(--mahal-border);padding:16px 20px;">
        <div>
          <h4 style="font-size:15px;font-weight:700;margin:0;color:var(--mahal-text-primary);">
            {{ __('Earnings Performance') }}
            <img src="{{ asset('uploads/loader.gif') }}" height="16" id="earning_performance" class="ml-2">
          </h4>
          <p style="font-size:12px;color:var(--mahal-text-muted);margin:2px 0 0;">
            {{ __('Annual revenue analysis') }}
          </p>
        </div>
        <div class="chart-period-tabs">
          <select class="form-control selectric"
                  id="perfomace"
                  style="font-size:12px;height:34px;border-radius:8px;border:1px solid var(--mahal-border);padding:4px 10px;">
            <option value="7">{{ __('Last 7 Days') }}</option>
            <option value="15">{{ __('Last 15 Days') }}</option>
            <option value="30">{{ __('Last 30 Days') }}</option>
            <option value="365">{{ __('Last 365 Days') }}</option>
          </select>
        </div>
      </div>
      <div class="card-body" style="padding:16px 20px;">
        <canvas id="myChart" height="160"></canvas>
      </div>
    </div>
  </div>

  {{-- Right column: Storage + Order Stats --}}
  <div class="col-lg-5 col-md-12 mb-3">
    <div class="d-flex flex-column h-100" style="gap:16px;">

      {{-- Storage Card --}}
      <div class="card" style="border-radius:14px;flex:1;">
        <div class="card-header" style="border-bottom:1px solid var(--mahal-border);padding:14px 18px;">
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <h4 style="font-size:14px;font-weight:700;margin:0;color:var(--mahal-text-primary);">
              <i class="fas fa-hdd mr-2" style="color:var(--mahal-accent);"></i>
              {{ __('Storage Usage') }}
            </h4>
            <span class="badge" id="storage_used"
                  style="background:rgba(200,147,58,0.12);color:var(--mahal-accent);
                         font-size:11px;padding:4px 10px;border-radius:20px;">
              <img src="{{ asset('uploads/loader.gif') }}" height="12" class="storrage_used">
            </span>
          </div>
        </div>
        <div class="card-body" style="padding:14px 18px;">
          <div class="row">
            <div class="col-5 text-center">
              <div class="sparkline-pie-storage d-inline" style="font-size:13px;"></div>
            </div>
            <div class="col-7">
              <div style="margin-bottom:10px;">
                <div style="font-size:12px;color:var(--mahal-text-muted);margin-bottom:2px;">{{ __('Products') }}</div>
                <div style="display:flex;justify-content:space-between;">
                  <span class="posts_used" style="font-size:13px;font-weight:700;color:var(--mahal-accent);">
                    <img src="{{ asset('uploads/loader.gif') }}" height="12" class="product_used">
                  </span>
                </div>
              </div>
              <div style="margin-bottom:10px;">
                <div style="font-size:12px;color:var(--mahal-text-muted);margin-bottom:2px;">{{ __('Plan') }}</div>
                <span class="plan_name" style="font-size:13px;font-weight:700;color:var(--mahal-text-primary);"></span>
              </div>
              <div>
                <div style="font-size:12px;color:var(--mahal-text-muted);margin-bottom:2px;">{{ __('Expires') }}</div>
                <span class="plan_expire" style="font-size:12px;font-weight:600;color:var(--mahal-text-muted);"></span>
              </div>
            </div>
          </div>
          @if(Auth::user()->status == 1)
          <div class="mt-3">
            <a href="{{ url('/seller/settings/plan') }}"
               style="display:block;text-align:center;background:var(--mahal-accent);
                      color:#fff;border-radius:8px;padding:8px 0;font-size:13px;
                      font-weight:700;text-decoration:none;">
              {{ __('Upgrade Plan') }}
            </a>
          </div>
          @endif
        </div>
      </div>

      {{-- Order Statistics Mini Card --}}
      <div class="card" style="border-radius:14px;">
        <div class="card-header" style="border-bottom:1px solid var(--mahal-border);padding:14px 18px;">
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <h4 style="font-size:14px;font-weight:700;margin:0;color:var(--mahal-text-primary);">
              <i class="fas fa-chart-pie mr-2" style="color:var(--mahal-accent);"></i>
              {{ __('Order Statistics') }}
            </h4>
            <div class="dropdown d-inline">
              <a class="dropdown-toggle"
                 style="font-size:12px;color:var(--mahal-accent);font-weight:600;cursor:pointer;"
                 data-toggle="dropdown" id="orders-month">{{ Date('F') }}</a>
              <ul class="dropdown-menu dropdown-menu-right dropdown-menu-sm"
                  style="min-width:140px;border-radius:10px;">
                <li class="dropdown-title" style="padding:8px 16px;font-size:12px;color:var(--mahal-text-muted);">
                  {{ __('Select Month') }}
                </li>
                @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                <li>
                  <a href="#" class="dropdown-item month {{ Date('F')==$m ? 'active' : '' }}"
                     data-month="{{ $m }}" style="font-size:13px;">{{ __($m) }}</a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body" style="padding:12px 18px;">
          <div class="row text-center">
            <div class="col-4">
              <div style="font-size:22px;font-weight:800;color:var(--mahal-text-primary);" id="pending_order"></div>
              <div style="font-size:11px;color:var(--mahal-text-muted);margin-top:2px;">{{ __('Pending') }}</div>
            </div>
            <div class="col-4">
              <div style="font-size:22px;font-weight:800;color:var(--mahal-success);" id="completed_order"></div>
              <div style="font-size:11px;color:var(--mahal-text-muted);margin-top:2px;">{{ __('Completed') }}</div>
            </div>
            <div class="col-4">
              <div style="font-size:22px;font-weight:800;color:var(--mahal-accent);" id="shipping_order"></div>
              <div style="font-size:11px;color:var(--mahal-text-muted);margin-top:2px;">{{ __('Processing') }}</div>
            </div>
          </div>
          <div class="mt-3 text-center">
            <div style="font-size:12px;color:var(--mahal-text-muted);">{{ __('Total Orders') }}</div>
            <div style="font-size:28px;font-weight:800;color:var(--mahal-text-primary);" id="total_order"></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- ════════════════════════════════════════════════
     ROW 4: More Stats (7 days, last month, products)
     ════════════════════════════════════════════════ --}}
<div class="row mb-4">
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card">
      <div class="stat-icon icon-info">
        <i class="fas fa-calendar-week"></i>
      </div>
      <div class="stat-label">{{ __('Last 7 Days') }}</div>
      <div class="stat-value" id="last_seven_days_total_sales">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card">
      <div class="stat-icon icon-warning">
        <i class="fas fa-history"></i>
      </div>
      <div class="stat-label">{{ __('Last Month') }}</div>
      <div class="stat-value" id="last_month_total_sales">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card">
      <div class="stat-icon icon-success">
        <i class="fas fa-boxes"></i>
      </div>
      <div class="stat-label">{{ __('Products Limit') }}</div>
      <div class="stat-value">
        <span class="text-danger posts_created" style="font-size:22px;font-weight:800;"></span>
        <span style="color:var(--mahal-text-muted);font-size:16px;">/</span>
        <span class="product_capacity" style="font-size:16px;font-weight:600;color:var(--mahal-text-muted);"></span>
      </div>
      <div class="mt-2">
        <div class="sparkline-pie-product d-inline"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card">
      <div class="stat-icon icon-accent">
        <i class="fas fa-shopping-bag"></i>
      </div>
      <div class="stat-label">{{ __('Today\'s Orders') }}</div>
      <div class="stat-value" id="today_order">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
    </div>
  </div>
</div>

{{-- ════════════════════════════════════════════════
     ROW 5: QR Code + Google Analytics (conditional)
     ════════════════════════════════════════════════ --}}
@if(Auth::user()->status == 1)
<div class="row mb-4">
  @if(filter_var($plan['qr_code']) == true)
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card text-center" style="border-radius:14px;">
      <div class="card-header" style="border-bottom:1px solid var(--mahal-border);padding:14px 18px;">
        <h4 style="font-size:14px;font-weight:700;margin:0;color:var(--mahal-text-primary);">
          <i class="fas fa-qrcode mr-2" style="color:var(--mahal-accent);"></i>
          {{ __('Scan Your Store') }}
        </h4>
      </div>
      <div class="card-body qr-code-main" style="padding:20px;">
        {!! QrCode::size(160)->generate(url('/')) !!}
      </div>
      <div class="card-footer" style="padding:12px 18px;border-top:1px solid var(--mahal-border);background:transparent;">
        <button class="btn btn-primary w-100"
                onclick="downloadPng()"
                style="background:var(--mahal-accent)!important;border-color:var(--mahal-accent)!important;
                       border-radius:8px!important;font-size:13px!important;font-weight:700!important;">
          <i class="fas fa-download mr-1"></i> {{ __('Download QR') }}
        </button>
      </div>
    </div>
  </div>
  @endif

  @if(filter_var($plan['google_analytics']) == true)
  <div class="col-lg-{{ filter_var($plan['qr_code']) == true ? '9' : '12' }} col-md-12 mb-3">
    <div class="card" style="border-radius:14px;">
      <div class="card-header d-flex justify-content-between align-items-center"
           style="border-bottom:1px solid var(--mahal-border);padding:16px 20px;">
        <h4 style="font-size:15px;font-weight:700;margin:0;color:var(--mahal-text-primary);">
          <i class="fas fa-chart-area mr-2" style="color:var(--mahal-accent);"></i>
          {{ __('Site Analytics') }}
        </h4>
        <select class="form-control" id="days"
                style="width:auto;font-size:12px;height:34px;border-radius:8px;
                       border:1px solid var(--mahal-border);padding:4px 10px;">
          <option value="7">{{ __('Last 7 Days') }}</option>
          <option value="15">{{ __('Last 15 Days') }}</option>
          <option value="30">{{ __('Last 30 Days') }}</option>
          <option value="180">{{ __('Last 180 Days') }}</option>
          <option value="365">{{ __('Last 365 Days') }}</option>
        </select>
      </div>
      <div class="card-body" style="padding:20px;">
        <canvas id="google_analytics" height="80"></canvas>
        <div class="row mt-4 text-center">
          <div class="col-3">
            <div style="font-size:22px;font-weight:800;color:var(--mahal-text-primary);" id="total_visitors"></div>
            <div style="font-size:12px;color:var(--mahal-text-muted);">{{ __('Total Visitors') }}</div>
          </div>
          <div class="col-3">
            <div style="font-size:22px;font-weight:800;color:var(--mahal-accent);" id="total_page_views"></div>
            <div style="font-size:12px;color:var(--mahal-text-muted);">{{ __('Page Views') }}</div>
          </div>
          <div class="col-3">
            <div style="font-size:22px;font-weight:800;color:var(--mahal-success);" id="new_vistors"></div>
            <div style="font-size:12px;color:var(--mahal-text-muted);">{{ __('New Visitors') }}</div>
          </div>
          <div class="col-3">
            <div style="font-size:22px;font-weight:800;color:var(--mahal-info);" id="returning_visitor"></div>
            <div style="font-size:12px;color:var(--mahal-text-muted);">{{ __('Returning') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@endif

{{-- ════════════════════════════════════════════════
     ROW 6: Recent Orders Table
     ════════════════════════════════════════════════ --}}
<div class="row mb-4">
  <div class="col-12">
    <div class="card" style="border-radius:14px;">
      <div class="card-header d-flex justify-content-between align-items-center"
           style="border-bottom:1px solid var(--mahal-border);padding:16px 20px;">
        <h4 style="font-size:15px;font-weight:700;margin:0;color:var(--mahal-text-primary);">
          <i class="fas fa-receipt mr-2" style="color:var(--mahal-accent);"></i>
          {{ __('Recent Orders') }}
        </h4>
        <a href="{{ url('/seller/orders/all') }}"
           style="font-size:13px;color:var(--mahal-accent);font-weight:600;text-decoration:none;">
          {{ __('View All') }} <i class="fas fa-arrow-left ml-1" style="font-size:11px;"></i>
        </a>
      </div>
      <div class="card-body" style="padding:0;">
        <div class="table-responsive">
          <table class="table mb-0"
                 style="border-collapse:separate;">
            <thead>
              <tr style="background:var(--mahal-page-bg);">
                <th style="padding:12px 20px;font-size:11px;font-weight:700;
                           color:var(--mahal-text-muted);text-transform:uppercase;
                           letter-spacing:0.5px;border-bottom:1px solid var(--mahal-border);
                           border-top:none;">{{ __('Order #') }}</th>
                <th style="padding:12px 20px;font-size:11px;font-weight:700;
                           color:var(--mahal-text-muted);text-transform:uppercase;
                           letter-spacing:0.5px;border-bottom:1px solid var(--mahal-border);
                           border-top:none;">{{ __('Customer') }}</th>
                <th style="padding:12px 20px;font-size:11px;font-weight:700;
                           color:var(--mahal-text-muted);text-transform:uppercase;
                           letter-spacing:0.5px;border-bottom:1px solid var(--mahal-border);
                           border-top:none;">{{ __('Date') }}</th>
                <th style="padding:12px 20px;font-size:11px;font-weight:700;
                           color:var(--mahal-text-muted);text-transform:uppercase;
                           letter-spacing:0.5px;border-bottom:1px solid var(--mahal-border);
                           border-top:none;">{{ __('Status') }}</th>
                <th style="padding:12px 20px;font-size:11px;font-weight:700;
                           color:var(--mahal-text-muted);text-transform:uppercase;
                           letter-spacing:0.5px;border-bottom:1px solid var(--mahal-border);
                           border-top:none;text-align:right;">{{ __('Amount') }}</th>
              </tr>
            </thead>
            <tbody id="recent_orders_table">
              <tr>
                <td colspan="5" class="text-center" style="padding:40px;color:var(--mahal-text-muted);">
                  <img src="{{ asset('uploads/loader.gif') }}" height="24">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ════════════════════════════════════════════════
     Support Card (bottom-right widget style)
     ════════════════════════════════════════════════ --}}
<div class="row">
  <div class="col-lg-4 col-md-6 offset-lg-8 offset-md-6">
    <div style="background:#2C1A0E;border-radius:14px;padding:20px;">
      <h5 style="font-size:14px;font-weight:700;color:#FFFFFF;margin-bottom:8px;">
        {{ __('Need Help?') }}
      </h5>
      <p style="font-size:12px;color:rgba(255,255,255,0.65);margin-bottom:14px;">
        {{ __('Our support team is available 24/7 to help you grow your store.') }}
      </p>
      @if(filter_var($plan['live_support']) == true)
      <a href="{{ route('seller.support') }}"
         style="display:block;text-align:center;background:var(--mahal-accent);
                color:#fff;border-radius:8px;padding:9px 0;font-size:13px;
                font-weight:700;text-decoration:none;">
        <i class="fas fa-headset mr-2"></i> {{ __('Contact Support') }}
      </a>
      @else
      <button disabled
              style="display:block;width:100%;text-align:center;background:rgba(255,255,255,0.15);
                     color:rgba(255,255,255,0.5);border:none;border-radius:8px;
                     padding:9px 0;font-size:13px;font-weight:700;cursor:not-allowed;">
        <i class="fa fa-lock mr-2"></i> {{ __('Contact Support') }}
      </button>
      @endif
    </div>
  </div>
</div>

{{-- Hidden inputs for JS --}}
<input type="hidden" id="base_url"                value="{{ url('/') }}">
<input type="hidden" id="site_url"                value="{{ url('/') }}">
<input type="hidden" id="dashboard_static"        value="{{ route('seller.dashboard.static') }}">
<input type="hidden" id="dashboard_perfomance"    value="{{ url('/seller/dashboard/perfomance') }}">
<input type="hidden" id="dashboard_order_statics" value="{{ url('/seller/dashboard/order_statics') }}">
<input type="hidden" id="gif_url"                 value="{{ asset('uploads/loader.gif') }}">
<input type="hidden" id="month"                   value="{{ date('F') }}">

@endsection

@push('js')
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/seller/dashboard.js') }}"></script>

@if(Auth::user()->status == 1 && filter_var($plan['qr_code']) == true)
<script>
"use strict";
function downloadPng() {
  var img = new Image();
  img.onload = function() {
    var canvas = document.createElement("canvas");
    canvas.width  = img.naturalWidth;
    canvas.height = img.naturalHeight;
    var ctx = canvas.getContext("2d");
    ctx.fillStyle = "#fff";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(img, 0, 0);
    var a = document.createElement("a");
    a.href     = canvas.toDataURL("image/png");
    a.download = "qrcode.png";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  };
  var svg     = document.querySelector(".qr-code-main svg");
  var svgText = (new XMLSerializer()).serializeToString(svg);
  img.src = "data:image/svg+xml;utf8," + encodeURIComponent(svgText);
}
</script>
@endif

@endpush
