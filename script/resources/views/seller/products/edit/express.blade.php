@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>__('Express checkout')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
            <div class="card-body" style="padding:0!important;">
                <div class="row no-gutters">
                    @include('seller.products.edit._sidebar', ['activeTab' => 'express-checkout'])

                    <div class="col-sm-9">
                        <div style="padding:32px;">
                            <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Express checkout') }}</h3>
                            <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Create Express Checkout Url For Direct Order') }}</p>

                            <div class="row">
                                <div class="col-12 col-md-8 col-lg-8">
                                    <form class="express_form">
                                        <input type="hidden" name="id" value="{{ $info->id }}">
                                        @foreach ($variations as $key=> $item)
                                        <div class="form-group" style="margin-bottom:20px;">
                                            <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ $key }}</label>
                                            <div class="selectgroup w-100">
                                                @foreach ($item as $row)
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="variation[{{ $row->category_id }}]" value="{{ $row->variation->id }}" class="selectgroup-input">
                                                    <span class="selectgroup-button">{{ $row->variation->name }}</span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                        <input type="hidden" name="term" value="{{ $info->id }}">
                                        @foreach ($info->options as $key=> $option)
                                        <div class="form-group" style="margin-bottom:20px;">
                                            <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ $option->name }} @if($option->is_required == 1) <span class="text-danger">*</span> @endif</label>
                                            <div class="selectgroup w-100">
                                                @foreach ($option->childrenCategories as $row)
                                                <label class="selectgroup-item">
                                                    <input @if($option->select_type == 1) type="checkbox" name="option[]" @else type="radio" name="option[{{ $key }}]" @endif value="{{ $row->id }}" class="selectgroup-input @if($option->is_required == 1) req @endif">
                                                    <span class="selectgroup-button">{{ $row->name }}</span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="form-group" style="margin-bottom:20px;">
                                            <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Quantity') }}</label>
                                            <input type="number" name="qty" class="form-control" value="1" required min="1" style="padding:12px 16px!important;font-size:15px!important;">
                                        </div>
                                        <p class="text-danger none required_option">{{ __('Please Select A Option From Required Field') }}</p>
                                        <button type="submit" class="btn" style="background:var(--m-primary);color:#fff;border-radius:var(--m-radius-sm);padding:12px 32px;font-weight:600;">
                                            <i class="fas fa-link" style="margin-inline-end:6px;"></i>{{ __('Generate Url') }}
                                        </button>
                                    </form>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="exp_area none" style="background:var(--m-sidebar-bg);border-radius:var(--m-radius-md);padding:20px;margin-top:20px;">
                                        <p style="font-weight:600;color:var(--m-primary);margin-bottom:8px;">{{ __('Checkout Url') }}:</p>
                                        <span class="express_url text-primary" style="word-break:break-all;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="base_url" value="{{ url('/') }}">
@endsection
@push('css')
<style>.none{display:none;}</style>
@endpush
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
<script src="{{ asset('assets/seller/product/index.js') }}"></script>
@endpush
