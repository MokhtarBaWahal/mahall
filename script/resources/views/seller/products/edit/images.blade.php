@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">
@endpush
@section('head')
@include('layouts.partials.headersection',['title'=>__('Product Images')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
            <div class="card-body" style="padding:0!important;">
                <div class="row no-gutters">
                    @include('seller.products.edit._sidebar', ['activeTab' => 'image'])

                    <div class="col-sm-9">
                        <div style="padding:32px;">
                            <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Product Images') }}</h3>
                            <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Upload product images here.') }}</p>

                            <div style="margin-bottom:28px;">
                                <form action="{{ route('seller.media.store') }}" enctype="multipart/form-data" class="dropzone" id="mydropzone" style="border:2px dashed #d4c8bb!important;border-radius:var(--m-radius-md)!important;background:var(--m-sidebar-bg)!important;min-height:180px;display:flex;align-items:center;justify-content:center;">
                                    @csrf
                                    <input type="hidden" name="term" value="{{ $info->id }}">
                                </form>
                            </div>

                            @if(count($info->medias) > 0)
                            <h5 style="font-size:16px;font-weight:700;color:var(--m-primary);margin:0 0 16px;">{{ __('Images') }} ({{ count($info->medias) }})</h5>
                            <div class="row">
                                @foreach($info->medias as $key => $row)
                                <div class="col-sm-3 col-6" id="m_area{{ $key }}" style="margin-bottom:20px;">
                                    <div style="background:var(--m-card-bg);border-radius:var(--m-radius-md);overflow:hidden;border:1px solid var(--m-border-light);transition:transform .2s;">
                                        <div style="height:140px;overflow:hidden;background:#f5efe9;">
                                            <img src="{{ asset($row->url) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                        </div>
                                        <div style="padding:12px;text-align:center;">
                                            <button class="btn" onclick="remove_image('{{ base64_encode($row->id) }}',{{ $key }})" style="background:rgba(237,100,100,0.1);color:#e53e3e;border:none;border-radius:var(--m-radius-sm);padding:8px 20px;font-size:13px;font-weight:600;width:100%;">
                                                <i class="fas fa-trash-alt" style="margin-inline-end:4px;"></i>{{ __('Remove') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form class="basicform" action="{{ route('seller.medias.destroy') }}">
    @csrf
    <input type="hidden" name="m_id" id="m_id">
</form>
@endsection
@push('css')
<style>
.dropzone .dz-message{margin:0!important;color:#8c7b6b!important;font-size:15px!important;font-weight:500!important;}
.dropzone .dz-preview .dz-image{border-radius:var(--m-radius-sm)!important;}
</style>
@endpush
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
<script src="{{ asset('assets/seller/product/images.js') }}"></script>
@endpush
