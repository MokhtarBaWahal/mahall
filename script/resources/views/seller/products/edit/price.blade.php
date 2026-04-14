@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>__('Product Price')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
            <div class="card-body" style="padding:0!important;">
                <div class="row no-gutters">
                    @include('seller.products.edit._sidebar', ['activeTab' => 'price'])

                    <div class="col-sm-9">
                        <div style="padding:32px;">
                            <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Product Price') }}</h3>
                            <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Update your product details below.') }}</p>

                            <form class="basicform" method="post" action="{{ route('seller.products.price',$info->price->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Current Price') }}</label>
                                    <input type="number" disabled value="{{ $info->price->price }}" step="any" class="form-control" style="padding:12px 16px!important;font-size:15px!important;">
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Regular Price') }}</label>
                                    <input type="number" value="{{ $info->price->regular_price }}" step="any" class="form-control" name="price" required="" style="padding:12px 16px!important;font-size:15px!important;">
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Special Price') }}</label>
                                    <input type="number" value="{{ $info->price->special_price }}" step="any" class="form-control" name="special_price" style="padding:12px 16px!important;font-size:15px!important;">
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Special Price Type') }}</label>
                                    <select name="price_type" class="form-control" style="padding:12px 16px!important;font-size:15px!important;">
                                        <option value="1" @if($info->price->price_type === 1) selected @endif>{{ __('Fixed') }}</option>
                                        <option value="0" @if($info->price->price_type === 0) selected @endif>{{ __('Percent') }}</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom:20px;">
                                            <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Special Price Start') }}</label>
                                            <input type="date" class="form-control" value="{{ $info->price->starting_date }}" name="special_price_start" style="padding:12px 16px!important;font-size:15px!important;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom:20px;">
                                            <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Special Price End') }}</label>
                                            <input type="date" class="form-control" value="{{ $info->price->ending_date }}" name="special_price_end" style="padding:12px 16px!important;font-size:15px!important;">
                                        </div>
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
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
@endpush
