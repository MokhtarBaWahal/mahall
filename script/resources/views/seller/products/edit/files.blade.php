@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>__('Product Files')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
            <div class="card-body" style="padding:0!important;">
                <div class="row no-gutters">
                    @include('seller.products.edit._sidebar', ['activeTab' => 'files'])

                    <div class="col-sm-9">
                        <div style="padding:32px;">
                            <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Product Files') }}</h3>
                            <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Your customer will automatically receive the download link via email') }}</p>

                            <button class="btn float-right mb-2" data-toggle="modal" data-target="#attribute_modal" style="background:var(--m-primary);color:#fff;border-radius:var(--m-radius-sm);padding:10px 20px;font-weight:600;">
                                <i class="fas fa-plus" style="margin-inline-end:6px;"></i>{{ __('Create File') }}
                            </button>

                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap card-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('URL') }}</th>
                                            <th width="200">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($info->files as $row)
                                        <tr>
                                            <td>{{ $row->url }}</td>
                                            <td class="text-right">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn edit" data-toggle="modal" data-target="#editModal" data-id="{{ $row->id }}" data-attribute="{{ $row->attribute_id }}" data-name="{{ $row->name }}" data-url="{{ $row->url }}" style="background:var(--m-accent);color:#fff;border-radius:6px 0 0 6px;"><i class="fas fa-edit"></i></button>
                                                    <button type="button" onclick="make_trash('{{ base64_encode($row->id) }}')" class="btn" style="background:#e53e3e;color:#fff;border-radius:0 6px 6px 0;"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add File Modal --}}
<form action="{{ route('seller.file.store') }}" class="basicform">
    @csrf
    <div class="modal fade" id="attribute_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius:var(--m-radius-lg);overflow:hidden;">
                <div class="modal-header" style="background:var(--m-sidebar-bg);border-bottom:1px solid var(--m-border-light);padding:20px 24px;">
                    <h5 class="modal-title" style="font-weight:700;color:var(--m-primary);">{{ __('Add New File') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="padding:24px;">
                    <input type="hidden" name="term" value="{{ $info->id }}">
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Url') }}</label>
                        <input type="text" name="url" class="form-control" required="" dir="ltr">
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--m-border-light);padding:16px 24px;">
                    <button type="button" class="btn" data-dismiss="modal" style="background:#ece7e2;color:var(--m-primary);font-weight:600;">{{ __('Close') }}</button>
                    <button type="submit" class="btn basicbtn" style="background:var(--m-primary);color:#fff;font-weight:600;">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Edit File Modal --}}
<form method="post" action="{{ route('seller.files.update') }}" class="basicform">
    @csrf
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius:var(--m-radius-lg);overflow:hidden;">
                <div class="modal-header" style="background:var(--m-sidebar-bg);border-bottom:1px solid var(--m-border-light);padding:20px 24px;">
                    <h5 class="modal-title" style="font-weight:700;color:var(--m-primary);">{{ __('Edit') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="padding:24px;">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="term" value="{{ $info->id }}">
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Url') }}</label>
                        <input type="text" name="url" class="form-control" required="" id="url" dir="ltr">
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--m-border-light);padding:16px 24px;">
                    <button type="button" class="btn" data-dismiss="modal" style="background:#ece7e2;color:var(--m-primary);font-weight:600;">{{ __('Close') }}</button>
                    <button type="submit" class="btn basicbtn" style="background:var(--m-primary);color:#fff;font-weight:600;">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{ route('seller.files.destroy') }}" id="basicform">
    @csrf
    <input type="hidden" name="a_id" id="m_id">
</form>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
<script src="{{ asset('assets/seller/product/files.js') }}"></script>
@endpush
