@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>__('Products')])
@endsection
@section('content')
@php
$url=domain_info('full_domain');
$currency = __('SAR');
@endphp

{{-- ===== PAGE HEADER ===== --}}
<div class="m-page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:28px;">
    <div>
        <h2 style="font-size:28px;font-weight:700;color:var(--m-primary);margin:0;">{{ __('Product Management') }}</h2>
        <p style="color:#8c7b6b;margin:6px 0 0;font-size:15px;">{{ __('Manage your products, inventory, and pricing all in one place.') }}</p>
    </div>
    <div style="display:flex;gap:12px;align-items:center;">
        <a href="#" class="btn" data-toggle="modal" data-target="#import" style="background:var(--m-card-bg);color:var(--m-primary);border:1px solid #e0d5ca;border-radius:var(--m-radius-md);padding:10px 20px;font-weight:600;font-size:14px;">
            <i class="fas fa-file-import" style="margin-inline-end:6px;"></i>{{ __('Import') }}
        </a>
        <a href="{{ route('seller.product.create') }}" class="btn" style="background:var(--m-primary);color:#fff;border-radius:var(--m-radius-md);padding:10px 24px;font-weight:600;font-size:14px;">
            <i class="fas fa-plus" style="margin-inline-end:6px;"></i>{{ __('Add New Product') }}
        </a>
    </div>
</div>

{{-- ===== STAT CARDS ===== --}}
<div class="m-stat-row" style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:28px;">
    {{-- Total Products --}}
    <div class="m-stat-card" style="background:var(--m-card-bg);border-radius:var(--m-radius-lg);padding:24px;position:relative;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;">
            <div>
                <p style="color:#8c7b6b;font-size:13px;margin:0 0 8px;">{{ __('Total Products') }}</p>
                <h3 style="font-size:32px;font-weight:700;color:var(--m-primary);margin:0;">{{ number_format($total_products ?? 0) }}</h3>
            </div>
            <div style="width:52px;height:52px;border-radius:16px;background:rgba(121,88,47,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-box" style="font-size:22px;color:var(--m-accent);"></i>
            </div>
        </div>
        <div style="margin-top:12px;">
            <span style="background:rgba(72,187,120,0.12);color:#38a169;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">+12%</span>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="m-stat-card" style="background:var(--m-card-bg);border-radius:var(--m-radius-lg);padding:24px;position:relative;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;">
            <div>
                <p style="color:#8c7b6b;font-size:13px;margin:0 0 8px;">{{ __('Low Stock') }}</p>
                <h3 style="font-size:32px;font-weight:700;color:var(--m-primary);margin:0;">{{ number_format($low_stock ?? 0) }}</h3>
            </div>
            <div style="width:52px;height:52px;border-radius:16px;background:rgba(237,100,100,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-exclamation-triangle" style="font-size:22px;color:#e53e3e;"></i>
            </div>
        </div>
        <div style="margin-top:12px;">
            <span style="background:rgba(237,100,100,0.12);color:#e53e3e;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">{{ __('Alert') }}</span>
        </div>
    </div>

    {{-- Inventory Value --}}
    <div class="m-stat-card" style="background:var(--m-card-bg);border-radius:var(--m-radius-lg);padding:24px;position:relative;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;">
            <div>
                <p style="color:#8c7b6b;font-size:13px;margin:0 0 8px;">{{ __('Inventory Value') }}</p>
                <h3 style="font-size:32px;font-weight:700;color:var(--m-primary);margin:0;">{{ number_format($inventory_value ?? 0) }} <span style="font-size:16px;font-weight:500;">{{ $currency }}</span></h3>
            </div>
            <div style="width:52px;height:52px;border-radius:16px;background:rgba(121,88,47,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-tag" style="font-size:22px;color:var(--m-accent);"></i>
            </div>
        </div>
    </div>

    {{-- Active Now --}}
    <div class="m-stat-card" style="background:var(--m-card-bg);border-radius:var(--m-radius-lg);padding:24px;position:relative;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;">
            <div>
                <p style="color:#8c7b6b;font-size:13px;margin:0 0 8px;">{{ __('Active Now') }}</p>
                <h3 style="font-size:32px;font-weight:700;color:var(--m-primary);margin:0;">{{ number_format($actives ?? 0) }}</h3>
            </div>
            <div style="width:52px;height:52px;border-radius:16px;background:rgba(72,187,120,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-chart-line" style="font-size:22px;color:#38a169;"></i>
            </div>
        </div>
    </div>
</div>

{{-- ===== FILTER BAR ===== --}}
<div class="m-filter-bar" style="background:var(--m-sidebar-bg);border-radius:var(--m-radius-md);padding:16px 24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:28px;">
    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
        {{-- Status tabs --}}
        <div style="display:flex;gap:6px;">
            <a href="{{ route('seller.product.list','all') }}" class="m-filter-tab" style="padding:8px 18px;border-radius:var(--m-radius-sm);font-size:13px;font-weight:600;text-decoration:none;{{ $type=='all' ? 'background:var(--m-primary);color:#fff;' : 'background:var(--m-card-bg);color:var(--m-primary);border:1px solid #e0d5ca;' }}">
                {{ __('All') }}
            </a>
            <a href="{{ route('seller.product.list',1) }}" class="m-filter-tab" style="padding:8px 18px;border-radius:var(--m-radius-sm);font-size:13px;font-weight:600;text-decoration:none;{{ $type==1 ? 'background:var(--m-primary);color:#fff;' : 'background:var(--m-card-bg);color:var(--m-primary);border:1px solid #e0d5ca;' }}">
                {{ __('Publish') }} ({{ $actives }})
            </a>
            <a href="{{ route('seller.product.list',2) }}" class="m-filter-tab" style="padding:8px 18px;border-radius:var(--m-radius-sm);font-size:13px;font-weight:600;text-decoration:none;{{ $type==2 ? 'background:var(--m-primary);color:#fff;' : 'background:var(--m-card-bg);color:var(--m-primary);border:1px solid #e0d5ca;' }}">
                {{ __('Draft') }} ({{ $drafts }})
            </a>
            <a href="{{ route('seller.product.list',3) }}" class="m-filter-tab" style="padding:8px 18px;border-radius:var(--m-radius-sm);font-size:13px;font-weight:600;text-decoration:none;{{ $type==3 ? 'background:var(--m-primary);color:#fff;' : 'background:var(--m-card-bg);color:var(--m-primary);border:1px solid #e0d5ca;' }}">
                {{ __('Incomplete') }} ({{ $incomplete }})
            </a>
            <a href="{{ route('seller.product.list',0) }}" class="m-filter-tab" style="padding:8px 18px;border-radius:var(--m-radius-sm);font-size:13px;font-weight:600;text-decoration:none;{{ ($type===0 || $type==='0') ? 'background:var(--m-primary);color:#fff;' : 'background:var(--m-card-bg);color:var(--m-primary);border:1px solid #e0d5ca;' }}">
                {{ __('Trash') }} ({{ $trash }})
            </a>
        </div>
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
        {{-- Search --}}
        <form style="display:flex;align-items:center;gap:8px;" method="GET">
            <div style="position:relative;">
                <input type="text" name="src" value="{{ $src ?? '' }}" placeholder="{{ __('Search...') }}" style="background:var(--m-card-bg);border:1px solid #e0d5ca;border-radius:var(--m-radius-sm);padding:8px 16px 8px 36px;font-size:13px;width:220px;color:var(--m-primary);outline:none;">
                <i class="fas fa-search" style="position:absolute;top:50%;transform:translateY(-50%);left:12px;right:auto;color:#8c7b6b;font-size:13px;"></i>
                <input type="hidden" name="type" value="title">
            </div>
        </form>
        {{-- Bulk actions --}}
        <form method="post" action="{{ route('seller.products.destroys') }}" class="basicform" style="display:flex;align-items:center;gap:8px;" id="bulkForm">
            @csrf
            <select name="method" style="background:var(--m-card-bg);border:1px solid #e0d5ca;border-radius:var(--m-radius-sm);padding:8px 14px;font-size:13px;color:var(--m-primary);outline:none;">
                <option disabled selected>{{ __('Select Action') }}</option>
                <option value="1">{{ __('Publish Now') }}</option>
                <option value="2">{{ __('Draft') }}</option>
                @if($type== 0 && $type != 'all')
                <option value="delete">{{ __('Delete Permanently') }}</option>
                @else
                <option value="0">{{ __('Move To Trash') }}</option>
                @endif
            </select>
            <button type="submit" class="btn basicbtn" style="background:var(--m-accent);color:#fff;border-radius:var(--m-radius-sm);padding:8px 16px;font-size:13px;font-weight:600;border:none;">{{ __('Submit') }}</button>
        </form>
    </div>
</div>

@if(Session::has('error'))
<div class="row" style="margin-bottom:20px;">
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:var(--m-radius-md);border:none;background:rgba(237,100,100,0.1);color:#e53e3e;">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif

{{-- ===== PRODUCT GRID ===== --}}
@if(count($posts) > 0)
<div class="m-product-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-bottom:32px;">
    @foreach($posts as $row)
    <div class="m-product-card" style="background:var(--m-card-bg);border-radius:var(--m-radius-xl);overflow:hidden;transition:transform .2s,box-shadow .2s;">
        {{-- Image --}}
        <div style="position:relative;overflow:hidden;height:220px;background:#f5efe9;">
            <img src="{{ asset($row->preview->media->url ?? 'uploads/default.png') }}" alt="{{ $row->title }}" style="width:100%;height:100%;object-fit:cover;">
            {{-- Category badge --}}
            @if($row->category && $row->category->category)
            <span style="position:absolute;top:14px;{{ app()->getLocale()=='ar' ? 'right:14px;' : 'left:14px;' }}background:rgba(255,255,255,0.75);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;color:var(--m-primary);">
                {{ $row->category->category->name ?? '' }}
            </span>
            @endif
            {{-- Checkbox for bulk --}}
            <label style="position:absolute;top:14px;{{ app()->getLocale()=='ar' ? 'left:14px;' : 'right:14px;' }}width:22px;height:22px;background:rgba(255,255,255,0.75);backdrop-filter:blur(8px);border-radius:6px;display:flex;align-items:center;justify-content:center;cursor:pointer;">
                <input type="checkbox" name="ids[]" form="bulkForm" value="{{ $row->id }}" style="width:16px;height:16px;accent-color:var(--m-accent);cursor:pointer;">
            </label>
        </div>
        {{-- Body --}}
        <div style="padding:20px;">
            <h4 style="font-size:17px;font-weight:700;color:var(--m-primary);margin:0 0 8px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $row->title }}</h4>
            @if($row->price)
            <p style="font-size:20px;font-weight:700;color:var(--m-accent);margin:0 0 12px;">
                {{ number_format($row->price->price ?? 0, 2) }} <span style="font-size:14px;font-weight:500;">{{ $currency }}</span>
                @if($row->price->special_price && $row->price->special_price > 0)
                <span style="font-size:13px;color:#8c7b6b;text-decoration:line-through;margin-inline-start:6px;">{{ number_format($row->price->regular_price, 2) }}</span>
                @endif
            </p>
            @endif
            {{-- Stock status --}}
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px;">
                @php
                    $stockQty = $row->stock->stock_qty ?? 0;
                    $stockStatus = $row->stock->stock_status ?? 0;
                @endphp
                @if($stockQty > 5)
                    <span style="width:8px;height:8px;border-radius:50%;background:#38a169;display:inline-block;"></span>
                    <span style="font-size:13px;color:#38a169;font-weight:500;">{{ __('In Stock') }}</span>
                @elseif($stockQty > 0)
                    <span style="width:8px;height:8px;border-radius:50%;background:#dd6b20;display:inline-block;"></span>
                    <span style="font-size:13px;color:#dd6b20;font-weight:500;">{{ __('Low Stock') }} ({{ $stockQty }})</span>
                @else
                    <span style="width:8px;height:8px;border-radius:50%;background:#e53e3e;display:inline-block;"></span>
                    <span style="font-size:13px;color:#e53e3e;font-weight:500;">{{ __('Out of Stock') }}</span>
                @endif
            </div>
            {{-- Actions --}}
            <div style="display:flex;gap:10px;">
                <a href="{{ route('seller.product.edit',$row->id) }}" style="flex:1;display:flex;align-items:center;justify-content:center;gap:6px;background:#ece7e2;color:var(--m-primary);border-radius:var(--m-radius-sm);padding:10px 0;font-size:13px;font-weight:600;text-decoration:none;transition:background .2s;">
                    <i class="fas fa-pen" style="font-size:12px;"></i> {{ __('Edit') }}
                </a>
                <a href="{{ $url.'/product/'.$row->slug.'/'.$row->id }}" target="_blank" style="width:42px;height:42px;display:flex;align-items:center;justify-content:center;background:#ece7e2;border-radius:var(--m-radius-sm);color:var(--m-primary);text-decoration:none;transition:background .2s;">
                    <i class="fas fa-external-link-alt" style="font-size:13px;"></i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- ===== PAGINATION ===== --}}
<div class="m-pagination" style="display:flex;justify-content:center;padding:8px 0 24px;">
    {{ $posts->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
</div>

@else
<div style="background:var(--m-card-bg);border-radius:var(--m-radius-xl);padding:60px 40px;text-align:center;">
    <i class="fas fa-box-open" style="font-size:56px;color:#d4c8bb;margin-bottom:20px;"></i>
    <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 8px;">{{ __('No products found.') }}</h3>
    <p style="color:#8c7b6b;font-size:15px;margin:0 0 24px;">{{ __('Manage your products, inventory, and pricing all in one place.') }}</p>
    <a href="{{ route('seller.product.create') }}" class="btn" style="background:var(--m-primary);color:#fff;border-radius:var(--m-radius-md);padding:12px 28px;font-weight:600;">
        <i class="fas fa-plus" style="margin-inline-end:6px;"></i>{{ __('Add New Product') }}
    </a>
</div>
@endif

{{-- ===== IMPORT MODAL ===== --}}
<div class="modal fade" id="import" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:var(--m-radius-lg);border:none;overflow:hidden;">
            <div class="modal-header" style="background:var(--m-sidebar-bg);border-bottom:1px solid #e0d5ca;padding:20px 24px;">
                <h5 class="modal-title" id="importModalLabel" style="font-weight:700;color:var(--m-primary);">{{ __('Product Import') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('seller.products.import') }}" method="POST" class="basicform" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding:24px;">
                    <div class="form-group">
                        <div style="border:2px dashed #d4c8bb;border-radius:var(--m-radius-md);padding:32px;text-align:center;">
                            <i class="fas fa-cloud-upload-alt" style="font-size:32px;color:#8c7b6b;margin-bottom:12px;"></i>
                            <p style="color:#8c7b6b;margin:0 0 12px;font-size:14px;">CSV</p>
                            <input type="file" name="file" accept=".csv" style="margin:0 auto;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #e0d5ca;padding:16px 24px;display:flex;justify-content:space-between;align-items:center;">
                    <a href="{{ asset('uploads/demo.csv') }}" style="color:var(--m-accent);font-size:14px;font-weight:600;">
                        <i class="fas fa-download" style="margin-inline-end:4px;"></i>{{ __('Download Sample') }}
                    </a>
                    <div style="display:flex;gap:10px;">
                        <button type="button" class="btn" data-dismiss="modal" style="background:#ece7e2;color:var(--m-primary);border-radius:var(--m-radius-sm);padding:8px 20px;font-weight:600;">{{ __('Close') }}</button>
                        <button type="submit" class="btn basicbtn" style="background:var(--m-primary);color:#fff;border-radius:var(--m-radius-sm);padding:8px 20px;font-weight:600;">{{ __('Import') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
/* Product card hover */
.m-product-card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(54,31,26,0.08);}
.m-product-card img{transition:transform .3s;}
.m-product-card:hover img{transform:scale(1.05);}

/* Pagination override */
.m-pagination .pagination{gap:6px;}
.m-pagination .page-item .page-link{
    width:40px;height:40px;display:flex;align-items:center;justify-content:center;
    border-radius:var(--m-radius-sm)!important;border:1px solid #e0d5ca!important;
    color:var(--m-primary)!important;font-weight:600;font-size:14px;background:var(--m-card-bg)!important;
    padding:0!important;margin:0!important;
}
.m-pagination .page-item.active .page-link{
    background:var(--m-primary)!important;color:#fff!important;border-color:var(--m-primary)!important;
}
.m-pagination .page-item .page-link:hover{background:#ece7e2!important;}

/* Filter tab hover */
.m-filter-tab:hover{opacity:0.85;}

/* Responsive: 3 cols on medium, 2 on small, 1 on xs */
@media(max-width:1200px){
    .m-product-grid{grid-template-columns:repeat(3,1fr)!important;}
    .m-stat-row{grid-template-columns:repeat(2,1fr)!important;}
}
@media(max-width:768px){
    .m-product-grid{grid-template-columns:repeat(2,1fr)!important;}
    .m-stat-row{grid-template-columns:repeat(2,1fr)!important;}
    .m-filter-bar{flex-direction:column;align-items:stretch!important;}
}
@media(max-width:480px){
    .m-product-grid{grid-template-columns:1fr!important;}
    .m-stat-row{grid-template-columns:1fr!important;}
}
</style>
@endpush

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
<script>
// Select All checkbox for bulk actions
document.querySelectorAll('input[name="ids[]"]').forEach(function(cb){
    cb.addEventListener('change', function(){
        // visual feedback
        var card = this.closest('.m-product-card');
        if(card){
            card.style.outline = this.checked ? '2px solid var(--m-accent)' : 'none';
            card.style.outlineOffset = this.checked ? '-2px' : '0';
        }
    });
});
</script>
@endpush
