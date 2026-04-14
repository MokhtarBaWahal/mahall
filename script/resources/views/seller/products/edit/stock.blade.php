@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>__('Product Inventory')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
            <div class="card-body" style="padding:0!important;">
                <div class="row no-gutters">
                    @include('seller.products.edit._sidebar', ['activeTab' => 'inventory'])

                    <div class="col-sm-9">
                        <div style="padding:32px;">
                            <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Product Inventory') }}</h3>
                            <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Update your product details below.') }}</p>

                            <form class="basicform" method="post" action="{{ route('seller.products.stock_update',$info->id) }}">
                                @csrf
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('SKU') }}</label>
                                    <input type="text" name="sku" value="{{ $info->stock->sku }}" class="form-control" style="padding:12px 16px!important;font-size:15px!important;" dir="ltr">
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Manage Stock') }}</label>
                                    <select name="stock_manage" id="stock_manage" class="form-control" style="padding:12px 16px!important;font-size:15px!important;">
                                        <option value="1" @if($info->stock->stock_manage == 1) selected @endif>{{ __('Manage Stock') }}</option>
                                        <option value="0" @if($info->stock->stock_manage == 0) selected @endif>{{ __('Dont Need To Manage Stock') }}</option>
                                    </select>
                                </div>
                                <div class="stock_area @if($info->stock->stock_manage == 0) none @endif">
                                    <div class="form-group" style="margin-bottom:20px;">
                                        <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Stock Status') }}</label>
                                        <select name="stock_status" id="stock_status" class="form-control" style="padding:12px 16px!important;font-size:15px!important;">
                                            <option value="1" @if($info->stock->stock_status == 1) selected @endif>{{ __('In Stock') }}</option>
                                            <option value="0" @if($info->stock->stock_status == 0) selected @endif>{{ __('Out of Stock') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-bottom:20px;">
                                        <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Stock Quantity') }}</label>
                                        <input type="text" name="stock_qty" value="{{ $info->stock->stock_qty }}" class="form-control" style="padding:12px 16px!important;font-size:15px!important;">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary basicbtn" style="background:var(--m-primary)!important;border-color:var(--m-primary)!important;padding:12px 32px!important;font-size:15px!important;">
                                    <i class="fas fa-save" style="margin-inline-end:6px;"></i>{{ __('Save Changes') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<style>.none{display:none;}</style>
@endpush
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/stock.js') }}"></script>
@endpush
