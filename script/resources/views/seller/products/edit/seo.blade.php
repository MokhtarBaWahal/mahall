@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>__('Product SEO')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
            <div class="card-body" style="padding:0!important;">
                <div class="row no-gutters">
                    @include('seller.products.edit._sidebar', ['activeTab' => 'seo'])

                    <div class="col-sm-9">
                        <div style="padding:32px;">
                            <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Product SEO') }}</h3>
                            <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Update your product details below.') }}</p>

                            <form class="basicform" method="post" action="{{ route('seller.products.seo',$info->id) }}">
                                @csrf
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Meta Title') }}</label>
                                    <input type="text" name="meta_title" class="form-control" required="" value="{{ $json->meta_title }}" style="padding:12px 16px!important;font-size:15px!important;">
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Meta Keyword') }}</label>
                                    <input type="text" name="meta_keyword" class="form-control" required="" value="{{ $json->meta_keyword }}" style="padding:12px 16px!important;font-size:15px!important;">
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <label style="font-size:14px;font-weight:600;color:var(--m-primary);margin-bottom:8px;display:block;">{{ __('Meta Description') }}</label>
                                    <textarea class="form-control" name="meta_description" required="" rows="4" style="padding:12px 16px!important;font-size:15px!important;">{{ $json->meta_description }}</textarea>
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
