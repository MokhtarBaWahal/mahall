@extends('layouts.app')
@push('style')
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('head')
@include('layouts.partials.headersection',['title'=>__('Edit Product')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <form method="post" action="{{ route('seller.product.update',$info->id) }}" id="productform">
            @csrf
            @method('PUT')
            <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
                <div class="card-body" style="padding:0!important;">
                    @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session()->get('flash_notification.level') }}" style="margin:24px 24px 0;border-radius:var(--m-radius-md);">
                        <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session()->get('flash_notification.message') !!}
                    </div>
                    @endif
                    <div class="row no-gutters">
                        @include('seller.products.edit._sidebar', ['activeTab' => 'edit'])

                        <div class="col-sm-9">
                            <div style="padding:32px;">
                                <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Edit Product') }}</h3>
                                <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Update your product details below.') }}</p>

                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Product Name') }}</label>
                                    <input type="text" name="title" class="form-control" required="" value="{{ $info->title }}" style="padding:12px 16px!important;font-size:15px!important;">
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Slug') }}</label>
                                    <input type="text" name="slug" class="form-control" required="" value="{{ $info->slug }}" style="padding:12px 16px!important;font-size:15px!important;" dir="ltr">
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Short Description') }}</label>
                                    <textarea class="form-control" name="excerpt" rows="3" style="padding:12px 16px!important;font-size:15px!important;">{{ $content->excerpt ?? '' }}</textarea>
                                </div>
                                {{ editor(array('title'=>__('Product Content'),'name'=>'content','class'=>'content','value'=> $content->content ?? '')) }}

                                <div class="row" style="margin-top:20px;">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom:20px;">
                                            <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Brand') }}</label>
                                            <select class="form-control" name="brand" style="padding:12px 16px!important;font-size:15px!important;">
                                                <option value="">{{ __('None') }}</option>
                                                {{ ConfigCategoryMulti('brand',$cats) }}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom:20px;">
                                            <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Featured') }}</label>
                                            <select class="form-control" name="featured" style="padding:12px 16px!important;font-size:15px!important;">
                                                <option value="0" @if($info->featured==0) selected="" @endif>{{ __('None') }}</option>
                                                <option value="1" @if($info->featured==1) selected="" @endif>{{ __('Trending products') }}</option>
                                                <option value="2" @if($info->featured==2) selected="" @endif>{{ __('Best selling products') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Category') }}</label>
                                    <select multiple class="form-control select2" name="cats[]" style="width:100%;">
                                        <option value="">{{ __('None') }}</option>
                                        {{ ConfigCategoryMulti('category',$cats) }}
                                    </select>
                                </div>

                                <div style="background:var(--m-sidebar-bg);border-radius:var(--m-radius-md);padding:20px;margin-bottom:20px;">
                                    <div class="form-group" style="margin-bottom:12px;">
                                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;margin:0;">
                                            <input type="checkbox" @if(!empty($info->affiliate)) checked @endif name="affiliate" id="affiliate" class="custom-switch-input sm" value="1">
                                            <span class="custom-switch-indicator"></span>
                                            <span style="font-size:14px;font-weight:600;color:var(--m-primary);">{{ __('External Product') }}</span>
                                        </label>
                                    </div>
                                    <div class="form-group order_link @if(empty($info->affiliate)) none @endif" style="margin-bottom:0;">
                                        <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Order Link') }}</label>
                                        <input type="text" class="form-control" id="purchase_link" value="{{ $info->affiliate->value ?? '' }}" name="purchase_link" dir="ltr" style="padding:12px 16px!important;">
                                    </div>
                                </div>

                                <div style="background:var(--m-sidebar-bg);border-radius:var(--m-radius-md);padding:20px;margin-bottom:28px;">
                                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;margin:0;">
                                        <input type="checkbox" name="status" @if($info->status==1) checked="" @endif class="custom-switch-input sm" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        <span style="font-size:14px;font-weight:600;color:var(--m-primary);">{{ __('Published') }}</span>
                                    </label>
                                </div>

                                <div style="display:flex;gap:12px;align-items:center;">
                                    <button class="btn btn-primary basicbtn" type="submit" style="background:var(--m-primary)!important;border-color:var(--m-primary)!important;padding:12px 32px!important;font-size:15px!important;">
                                        <i class="fas fa-save" style="margin-inline-end:6px;"></i>{{ __('Save Changes') }}
                                    </button>
                                    <a href="{{ route('seller.product.index') }}" style="padding:12px 24px;color:var(--m-text-body);font-weight:600;font-size:14px;text-decoration:none;">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('css')
<style>
.select2-container--default .select2-selection--multiple{border:1px solid var(--m-border)!important;border-radius:var(--m-radius-sm)!important;background:var(--m-card-bg)!important;padding:8px 12px!important;min-height:48px!important;}
.select2-container--default .select2-selection--multiple .select2-selection__choice{background:var(--m-accent)!important;border:none!important;color:#fff!important;border-radius:6px!important;padding:4px 10px!important;}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{color:#fff!important;}
.none{display:none;}
</style>
@endpush
@push('js')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/form.js?v=1.0') }}"></script>
<script type="text/javascript">
    $('#affiliate').on('change',function(){
        if(this.checked) { $('.order_link').show(); }
        else { $('.order_link').hide(); }
    });
</script>
@endpush
