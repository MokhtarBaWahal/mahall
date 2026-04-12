@extends('layouts.app')
@section('content')
@php $plan = user_limit(); @endphp

{{-- ── Subscription / Account Status Alert ── --}}
@if(Auth::user()->status == 2 || Auth::user()->status == 3)
<div class="alert alert-warning d-flex align-items-center mb-4">
  <i class="fas fa-exclamation-triangle mr-3" style="font-size:18px;color:var(--m-warning);"></i>
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
      <a href="{{ route('merchant.plan') }}" style="color:var(--m-accent);font-weight:700;">{{ __('here') }}</a>
    @endif
    {{ __('or contact the support team.') }}
  </div>
</div>
@endif

{{-- ── Subscription Expiry Warning ── --}}
@php $expireDate = \Carbon\Carbon::now()->addDays(7)->format('Y-m-d'); @endphp
@if(Auth::user()->user_domain->will_expire <= $expireDate)
<div class="alert alert-warning d-flex align-items-center mb-4">
  <i class="fas fa-clock mr-3" style="font-size:18px;color:var(--m-warning);"></i>
  <div>
    {{ __('Your subscription is ending') }} <strong>{{ \Carbon\Carbon::parse(Auth::user()->user_domain->will_expire)->diffForHumans() }}</strong>.
    {{ __('Please') }}
    <a href="{{ Auth::user()->user_domain->is_trial == 1 ? url('/seller/settings/plan') : url('/seller/plan-renew') }}"
       style="color:var(--m-accent);font-weight:700;text-decoration:underline;">
      {{ Auth::user()->user_domain->is_trial == 1 ? __('Enroll in a plan') : __('Renew the plan') }}
    </a>.
  </div>
</div>
@endif

{{-- ════════════════════════════════════════════════
     WELCOME SECTION
     ════════════════════════════════════════════════ --}}
<div style="margin-bottom:32px;display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:16px;">
  <div>
    <h1 class="welcome-title" style="font-size:36px;font-weight:800;color:var(--m-text);margin:0 0 8px;line-height:40px;">
      👋 {{ __('Welcome,') }} {{ Auth::user()->name }}
    </h1>
    <p style="font-size:16px;color:var(--m-text-body);margin:0;line-height:24px;">
      {{ __('Overview of your store performance. Everything is running smoothly!') }}
    </p>
  </div>
  <div style="display:flex;gap:10px;flex-wrap:wrap;">
    <a href="{{ route('seller.report.index') }}"
       class="btn btn-secondary" style="font-size:14px;padding:10px 20px;">
      <i class="fas fa-chart-bar mr-1"></i> {{ __('Export Reports') }}
    </a>
    <a href="{{ route('seller.product.create') }}"
       class="btn btn-primary" style="font-size:14px;padding:10px 20px;">
      <i class="fas fa-plus mr-1"></i> {{ __('New Product') }}
    </a>
  </div>
</div>

{{-- ════════════════════════════════════════════════
     ROW 1: 4 Metric Cards
     ════════════════════════════════════════════════ --}}
<div class="row mb-4" style="gap:0;">

  {{-- Total Sales --}}
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card" style="height:100%;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
        <span class="stat-badge up" id="sales_badge">+12.5%</span>
        <div class="stat-icon icon-accent" style="margin-bottom:0;">
          <i class="fas fa-dollar-sign"></i>
        </div>
      </div>
      <div class="stat-label">{{ __('Total Sales') }}</div>
      <div class="stat-value" id="sales_of_earnings">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
      <div class="stat-mini-chart">
        <div class="bar active" style="height:60%"></div>
        <div class="bar active" style="height:80%"></div>
        <div class="bar" style="height:40%"></div>
        <div class="bar active" style="height:90%"></div>
        <div class="bar" style="height:50%"></div>
        <div class="bar active" style="height:70%"></div>
      </div>
    </div>
  </div>

  {{-- Orders Today --}}
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card" style="height:100%;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
        <span class="stat-badge up" id="orders_badge">+8%</span>
        <div class="stat-icon icon-success" style="margin-bottom:0;">
          <i class="fas fa-shopping-cart"></i>
        </div>
      </div>
      <div class="stat-label">{{ __('Orders Today') }}</div>
      <div class="stat-value" id="today_order">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
      <div class="stat-mini-chart">
        <div class="bar" style="height:50%"></div>
        <div class="bar active" style="height:75%"></div>
        <div class="bar active" style="height:60%"></div>
        <div class="bar" style="height:40%"></div>
        <div class="bar active" style="height:85%"></div>
        <div class="bar active" style="height:55%"></div>
      </div>
    </div>
  </div>

  {{-- Yesterday Sales --}}
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card" style="height:100%;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
        <span class="stat-badge down" id="yesterday_badge">-2.4%</span>
        <div class="stat-icon icon-warning" style="margin-bottom:0;">
          <i class="fas fa-calendar-day"></i>
        </div>
      </div>
      <div class="stat-label">{{ __('Yesterday Sales') }}</div>
      <div class="stat-value" id="yesterday_total_sales">
        <img src="{{ asset('uploads/loader.gif') }}" height="20">
      </div>
      <div class="stat-mini-chart">
        <div class="bar active" style="height:70%"></div>
        <div class="bar" style="height:45%"></div>
        <div class="bar active" style="height:55%"></div>
        <div class="bar active" style="height:80%"></div>
        <div class="bar" style="height:35%"></div>
        <div class="bar" style="height:50%"></div>
      </div>
    </div>
  </div>

  {{-- Monthly Earnings (dark card) --}}
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="mahal-stat-card dark-card" style="height:100%;position:relative;">
      <div style="position:absolute;top:12px;right:12px;">
        <span style="font-size:10px;color:rgba(255,255,255,.5);font-weight:600;text-transform:uppercase;letter-spacing:1px;">{{ __('Monthly Target') }}</span>
      </div>
      <div style="margin-top:24px;">
        <div class="stat-label" style="color:rgba(255,255,255,.6)!important;">{{ __('Monthly Earnings') }}</div>
        <div class="stat-value" id="monthly_total_sales" style="font-size:24px;">
          <img src="{{ asset('uploads/loader.gif') }}" height="20">
        </div>
      </div>
      <div style="margin-top:16px;">
        <div style="height:4px;border-radius:12px;background:rgba(255,255,255,.15);overflow:hidden;">
          <div style="height:100%;width:78%;border-radius:12px;background:var(--m-accent);"></div>
        </div>
        <div style="font-size:10px;color:rgba(255,255,255,.5);margin-top:6px;">{{ __('78% of monthly target achieved') }}</div>
      </div>
    </div>
  </div>
</div>

{{-- ════════════════════════════════════════════════
     ROW 2: Performance Chart + Storage + Order Stats
     ════════════════════════════════════════════════ --}}
<div class="row mb-4">

  {{-- Earnings Performance Chart --}}
  <div class="col-lg-8 col-md-12 mb-3">
    <div class="card card-alt" style="height:100%;">
      <div class="card-header d-flex justify-content-between align-items-center" style="border-bottom:none!important;padding:24px 32px 0!important;">
        <div>
          <h4 style="font-size:20px;font-weight:700;margin:0;color:var(--m-text);">
            {{ __('Profit Performance') }}
            <img src="{{ asset('uploads/loader.gif') }}" height="16" id="earning_performance" class="ml-2">
          </h4>
          <p style="font-size:12px;color:var(--m-text-body);margin:4px 0 0;">
            {{ __('Weekly sales analysis') }}
          </p>
        </div>
        <div class="chart-tabs">
          <button class="tab active" data-period="7">{{ __('Daily') }}</button>
          <button class="tab" data-period="30">{{ __('Weekly') }}</button>
          <button class="tab" data-period="365">{{ __('Monthly') }}</button>
        </div>
      </div>
      <div class="card-body" style="padding:16px 32px 24px!important;">
        <canvas id="myChart" height="140"></canvas>
      </div>
    </div>
  </div>

  {{-- Right column: Storage + Order Stats --}}
  <div class="col-lg-4 col-md-12 mb-3">
    <div class="d-flex flex-column h-100" style="gap:16px;">

      {{-- Storage Card --}}
      <div class="card" style="flex:1;">
        <div class="card-header" style="padding:20px 24px!important;border-bottom:none!important;">
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <h4 style="font-size:18px;font-weight:700;margin:0;">
              {{ __('Storage Space') }}
            </h4>
            <i class="fas fa-expand-alt" style="color:var(--m-text-body);font-size:14px;"></i>
          </div>
        </div>
        <div class="card-body" style="padding:0 24px 24px!important;">
          <div class="row align-items-center">
            <div class="col-5 text-center">
              <div class="sparkline-pie-storage d-inline" style="font-size:13px;"></div>
            </div>
            <div class="col-7">
              <div style="margin-bottom:12px;">
                <div style="font-size:12px;color:var(--m-text-body);margin-bottom:2px;">{{ __('Total Space') }}</div>
                <span class="posts_used" style="font-size:14px;font-weight:700;color:var(--m-text);">
                  <img src="{{ asset('uploads/loader.gif') }}" height="12" class="product_used">
                </span>
              </div>
              <div>
                <div style="font-size:12px;color:var(--m-text-body);margin-bottom:2px;">{{ __('Remaining') }}</div>
                <span class="plan_name" style="font-size:14px;font-weight:700;color:var(--m-text);"></span>
              </div>
            </div>
          </div>
          @if(Auth::user()->status == 1)
          <a href="{{ url('/seller/settings/plan') }}"
             style="display:block;text-align:center;background:var(--m-accent-light);
                    color:#78572e;border-radius:var(--m-radius-sm);padding:10px 0;font-size:14px;
                    font-weight:700;text-decoration:none;margin-top:16px;">
            {{ __('Upgrade Package') }}
          </a>
          @endif
        </div>
      </div>

      {{-- Order Statistics --}}
      <div class="card" style="background:var(--m-card-alt)!important;">
        <div class="card-header" style="padding:20px 24px!important;border-bottom:none!important;">
          <h4 style="font-size:18px;font-weight:700;margin:0;">{{ __('Order Statistics') }}</h4>
        </div>
        <div class="card-body" style="padding:0 24px 24px!important;">
          {{-- Completed --}}
          <div style="margin-bottom:16px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
              <span style="font-size:14px;font-weight:700;color:var(--m-text);">{{ __('Completed') }}</span>
              <span style="font-size:14px;font-weight:700;color:var(--m-text);" id="completed_pct">65%</span>
            </div>
            <div class="mahal-progress"><div class="bar success" style="width:65%;" id="completed_bar"></div></div>
          </div>
          {{-- Processing --}}
          <div style="margin-bottom:16px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
              <span style="font-size:14px;font-weight:700;color:var(--m-text);">{{ __('Processing') }}</span>
              <span style="font-size:14px;font-weight:700;color:var(--m-text);" id="processing_pct">25%</span>
            </div>
            <div class="mahal-progress"><div class="bar warning" style="width:25%;" id="processing_bar"></div></div>
          </div>
          {{-- Cancelled --}}
          <div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
              <span style="font-size:14px;font-weight:700;color:var(--m-text);">{{ __('Cancelled') }}</span>
              <span style="font-size:14px;font-weight:700;color:var(--m-text);" id="cancelled_pct">10%</span>
            </div>
            <div class="mahal-progress"><div class="bar danger" style="width:10%;" id="cancelled_bar"></div></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- ════════════════════════════════════════════════
     ROW 3: Recent Orders Table
     ════════════════════════════════════════════════ --}}
<div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 style="font-size:20px;font-weight:700;margin:0;">{{ __('Recent Orders') }}</h4>
        <a href="{{ route('seller.order.index') }}"
           style="font-size:14px;color:var(--m-accent);font-weight:600;text-decoration:none;">
          {{ __('View All') }}
        </a>
      </div>
      <div class="card-body" style="padding:0!important;">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>{{ __('Order #') }}</th>
                <th>{{ __('Customer') }}</th>
                <th>{{ __('Product') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Status') }}</th>
                <th style="text-align:right;">{{ __('Total') }}</th>
              </tr>
            </thead>
            <tbody id="recent_orders_table">
              <tr>
                <td colspan="6" class="text-center" style="padding:48px;color:var(--m-text-body);">
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
     ROW 4: QR Code + Google Analytics (conditional)
     ════════════════════════════════════════════════ --}}
@if(Auth::user()->status == 1)
<div class="row mb-4">
  @if(filter_var($plan['qr_code']) == true)
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card text-center">
      <div class="card-header">
        <h4 style="font-size:18px;">{{ __('Scan Your Store') }}</h4>
      </div>
      <div class="card-body qr-code-main">
        {!! QrCode::size(160)->generate(url('/')) !!}
      </div>
      <div class="card-footer" style="padding:16px 24px;border-top:1px solid var(--m-border-light);background:transparent;">
        <button class="btn btn-primary w-100" onclick="downloadPng()">
          <i class="fas fa-download mr-1"></i> {{ __('Download QR') }}
        </button>
      </div>
    </div>
  </div>
  @endif

  @if(filter_var($plan['google_analytics']) == true)
  <div class="col-lg-{{ filter_var($plan['qr_code']) == true ? '9' : '12' }} col-md-12 mb-3">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 style="font-size:18px;">{{ __('Site Analytics') }}</h4>
        <select class="form-control" id="days"
                style="width:auto;font-size:13px;height:36px;padding:4px 12px;">
          <option value="7">{{ __('Last 7 Days') }}</option>
          <option value="15">{{ __('Last 15 Days') }}</option>
          <option value="30">{{ __('Last 30 Days') }}</option>
          <option value="180">{{ __('Last 180 Days') }}</option>
          <option value="365">{{ __('Last 365 Days') }}</option>
        </select>
      </div>
      <div class="card-body">
        <canvas id="google_analytics" height="80"></canvas>
        <div class="row mt-4 text-center">
          <div class="col-3">
            <div style="font-size:24px;font-weight:800;color:var(--m-text);" id="total_visitors"></div>
            <div style="font-size:12px;color:var(--m-text-body);">{{ __('Total Visitors') }}</div>
          </div>
          <div class="col-3">
            <div style="font-size:24px;font-weight:800;color:var(--m-accent);" id="total_page_views"></div>
            <div style="font-size:12px;color:var(--m-text-body);">{{ __('Page Views') }}</div>
          </div>
          <div class="col-3">
            <div style="font-size:24px;font-weight:800;color:var(--m-success);" id="new_vistors"></div>
            <div style="font-size:12px;color:var(--m-text-body);">{{ __('New Visitors') }}</div>
          </div>
          <div class="col-3">
            <div style="font-size:24px;font-weight:800;color:var(--m-info);" id="returning_visitor"></div>
            <div style="font-size:12px;color:var(--m-text-body);">{{ __('Returning') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@endif

{{-- ── FAB Button ── --}}
<a href="{{ route('seller.product.create') }}" class="mahal-fab d-none d-md-flex">
  <i class="fas fa-plus"></i>
</a>

{{-- Hidden inputs for JS --}}
<input type="hidden" id="base_url"                value="{{ url('/') }}">
<input type="hidden" id="site_url"                value="{{ url('/') }}">
<input type="hidden" id="dashboard_static"        value="{{ route('seller.dashboard.static') }}">
<input type="hidden" id="dashboard_perfomance"    value="{{ url('/seller/dashboard/perfomance') }}">
<input type="hidden" id="dashboard_order_statics" value="{{ url('/seller/dashboard/order_statics') }}">
<input type="hidden" id="gif_url"                 value="{{ asset('uploads/loader.gif') }}">
<input type="hidden" id="month"                   value="{{ date('F') }}">
{{-- Keep these IDs for dashboard.js compatibility --}}
<input type="hidden" id="total_revenue_quick" value="">
<input type="hidden" id="orders_quick" value="">
<input type="hidden" id="today_total_sales" value="">
<input type="hidden" id="total_sales" value="">
<input type="hidden" id="last_seven_days_total_sales" value="">
<input type="hidden" id="last_month_total_sales" value="">
<input type="hidden" id="storage_used" value="">
<input type="hidden" id="pending_order" value="">
<input type="hidden" id="completed_order" value="">
<input type="hidden" id="shipping_order" value="">
<input type="hidden" id="total_order" value="">

@endsection

@push('js')
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/seller/dashboard.js') }}"></script>

{{-- Chart tab switching --}}
<script>
"use strict";
$(document).ready(function(){
  // Chart period tabs
  $('.chart-tabs .tab').on('click', function(){
    $('.chart-tabs .tab').removeClass('active');
    $(this).addClass('active');
    var period = $(this).data('period');
    if(typeof load_perfomace === 'function') load_perfomace(period);
  });

  // Compatibility: also handle old select if present
  $('#perfomace').on('change', function(){
    if(typeof load_perfomace === 'function') load_perfomace($(this).val());
  });
});
</script>

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
