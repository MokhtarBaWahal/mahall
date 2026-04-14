@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>__('Product Options')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
            <div class="card-body" style="padding:0!important;">
                <div class="row no-gutters">
                    @include('seller.products.edit._sidebar', ['activeTab' => 'option'])

                    <div class="col-sm-9">
                        <div style="padding:32px;">
                            <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Product Options') }}</h3>
                            <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Update your product details below.') }}</p>

                            <form class="basicform" method="post" action="{{ route('seller.product.option_update',$info->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <button type="button" data-toggle="modal" data-target="#add_option" class="btn float-right" style="background:var(--m-primary);color:#fff;border-radius:var(--m-radius-sm);padding:10px 20px;font-weight:600;margin-bottom:16px;">
                                            <i class="fas fa-plus" style="margin-inline-end:6px;"></i>{{ __('Add New Option') }}
                                        </button>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12 mt-3">
                                        <div id="accordion">
                                            @foreach ($info->options as $key=> $row)
                                            <div class="accordion option{{ $row->id }}" style="margin-bottom:12px;border:1px solid var(--m-border-light);border-radius:var(--m-radius-md);overflow:hidden;">
                                                <div class="accordion-header h-50" role="button" data-toggle="collapse" data-target="#panel-body-{{ $key }}" style="padding:16px 20px;background:var(--m-sidebar-bg);">
                                                    <div class="float-left">
                                                        <h6 style="margin:0;font-weight:600;color:var(--m-primary);"><span id="option_name{{ $row->id }}">{{ $row->name }}</span> @if($row->is_required == 1) <span class="text-danger">*</span> @endif</h6>
                                                    </div>
                                                    <div class="float-right">
                                                        <a class="btn btn-sm text-white row_edit" data-toggle="modal" data-target="#editform" data-selecttype="{{ $row->select_type }}" data-name="{{ $row->name }}" data-required="{{ $row->is_required }}" data-id="{{ $row->id }}" style="background:var(--m-accent);border-radius:6px;"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-sm text-white option_delete" data-id="{{ $row->id }}" style="background:#e53e3e;border-radius:6px;"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                                <div class="accordion-body collapse" id="panel-body-{{ $key }}" data-parent="#accordion">
                                                    <div class="panel-body" style="padding:16px 20px;">
                                                        <div class="option-values clearfix" id="option-2-values">
                                                            <div class="option-select">
                                                                <div class="table-responsive">
                                                                    <table class="options table table-bordered table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>{{ __('Label') }}</th>
                                                                                <th>{{ __('Price') }}</th>
                                                                                <th>{{ __('Price Type') }}</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($row->childrenCategories ?? [] as $item)
                                                                            <tr class="option{{ $item->id }}">
                                                                                <td>
                                                                                    <input type="text" name="options[{{ $row->id }}][values][{{ $item->id }}][label]" class="form-control" value="{{ $item->name }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="options[{{ $row->id }}][values][{{ $item->id }}][price]" class="form-control" value="{{ $item->amount }}" step="any" min="0">
                                                                                </td>
                                                                                <td>
                                                                                    <select name="options[{{ $row->id }}][values][{{ $item->id }}][price_type]" class="form-control">
                                                                                        <option value="1" @if($item->amount_type == 1) selected="" @endif>{{ __('Fixed') }}</option>
                                                                                        <option value="0" @if($item->amount_type == 0) selected="" @endif>{{ __('Percent') }}</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <button type="button" class="btn btn-white delete-row bg-white option_delete text-danger" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <button type="button" data-toggle="modal" data-target="#new_row_modal" class="btn add_new_row" data-id="{{ $row->id }}" style="background:#ece7e2;color:var(--m-primary);border-radius:var(--m-radius-sm);font-weight:600;">
                                                                    <i class="fas fa-plus" style="margin-inline-end:4px;"></i>{{ __('Add New Row') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @if(count($info->options) > 0)
                                        <button type="submit" class="btn btn-primary basicbtn" style="background:var(--m-primary)!important;border-color:var(--m-primary)!important;padding:12px 32px!important;font-size:15px!important;margin-top:16px;">
                                            <i class="fas fa-save" style="margin-inline-end:6px;"></i>{{ __('Save Changes') }}
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Option Modal --}}
<div class="modal fade" id="add_option" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('seller.product.store_group',$info->id) }}" class="basicform_with_reload" method="post">
            <div class="modal-content" style="border-radius:var(--m-radius-lg);overflow:hidden;">
                <div class="modal-header" style="background:var(--m-sidebar-bg);border-bottom:1px solid var(--m-border-light);padding:20px 24px;">
                    <h5 class="modal-title" style="font-weight:700;color:var(--m-primary);">{{ __('Add New Option') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="padding:24px;">
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Option Name') }}</label>
                        <input type="text" name="name" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Select Type') }}</label>
                        <select name="select_type" class="form-control">
                            <option value="1">{{ __('Multiple Select') }}</option>
                            <option selected value="0">{{ __('Single Select') }}</option>
                        </select>
                    </div>
                    <label><input type="checkbox" name="is_required" value="1"> {{ __('Required') }}</label>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--m-border-light);padding:16px 24px;">
                    <button type="button" class="btn" data-dismiss="modal" style="background:#ece7e2;color:var(--m-primary);font-weight:600;">{{ __('Close') }}</button>
                    <button type="submit" class="btn basicbtn" style="background:var(--m-primary);color:#fff;font-weight:600;">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Add Row Modal --}}
<div class="modal fade" id="new_row_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:var(--m-radius-lg);overflow:hidden;">
            <form action="{{ route('seller.product.add_row') }}" class="basicform_with_reload" method="post">
                @csrf
                <div class="modal-header" style="background:var(--m-sidebar-bg);border-bottom:1px solid var(--m-border-light);padding:20px 24px;">
                    <h5 class="modal-title" style="font-weight:700;color:var(--m-primary);">{{ __('Add New Row') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="padding:24px;">
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Row Name') }}</label>
                        <input type="text" id="add_row" class="form-control" name="name" required>
                        <input type="hidden" id="row_id" name="row_id">
                    </div>
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Price') }}</label>
                        <input type="number" step="any" class="form-control" name="price" required>
                    </div>
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Price Type') }}</label>
                        <select name="amount_type" class="form-control">
                            <option value="1">{{ __('Fixed') }}</option>
                            <option value="0">{{ __('Percentage') }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--m-border-light);padding:16px 24px;">
                    <button type="button" class="btn" data-dismiss="modal" style="background:#ece7e2;color:var(--m-primary);font-weight:600;">{{ __('Close') }}</button>
                    <button type="submit" class="btn basicbtn" style="background:var(--m-primary);color:#fff;font-weight:600;">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Option Modal --}}
<div class="modal fade" id="editform" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:var(--m-radius-lg);overflow:hidden;">
            <div class="modal-header" style="background:var(--m-sidebar-bg);border-bottom:1px solid var(--m-border-light);padding:20px 24px;">
                <h5 class="modal-title" style="font-weight:700;color:var(--m-primary);">{{ __('Edit Option') }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('seller.product.row_update') }}" class="basicform row_update_form">
                @csrf
                <div class="modal-body" style="padding:24px;">
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Option Name') }}</label>
                        <input type="text" id="edit_name" name="name" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="font-weight:600;color:var(--m-primary);">{{ __('Select Type') }}</label>
                        <select id="edit_select" name="select_type" class="form-control">
                            <option value="1">{{ __('Multiple Select') }}</option>
                            <option value="0">{{ __('Single Select') }}</option>
                        </select>
                    </div>
                    <input type="hidden" id="edit_id" name="id">
                    <label><input id="edit_required" type="checkbox" name="is_required" value="1"> {{ __('Required') }}</label>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--m-border-light);padding:16px 24px;">
                    <button type="button" class="btn" data-dismiss="modal" style="background:#ece7e2;color:var(--m-primary);font-weight:600;">{{ __('Close') }}</button>
                    <button type="submit" class="btn basicbtn" style="background:var(--m-primary);color:#fff;font-weight:600;">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form class="basicform delete_from" action="{{ route('seller.product.option_delete') }}" method="post">
    @csrf
    <input type="hidden" name="id" id="option_id">
</form>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/product_option.js') }}"></script>
@endpush
