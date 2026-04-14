@extends('layouts.app')
@push('style')
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('head')
@include('layouts.partials.headersection',['title'=>__('Product Variants')])
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="border-radius:var(--m-radius-xl)!important;overflow:hidden;">
            <div class="card-body" style="padding:0!important;">
                <div class="row no-gutters">
                    @include('seller.products.edit._sidebar', ['activeTab' => 'varient'])

                    <div class="col-sm-9">
                        <div style="padding:32px;">
                            <h3 style="font-size:22px;font-weight:700;color:var(--m-primary);margin:0 0 4px;">{{ __('Product Variants') }}</h3>
                            <p style="color:#8c7b6b;font-size:14px;margin:0 0 28px;">{{ __('Update your product details below.') }}</p>

                            <button class="btn float-right mb-2 add_attr" data-toggle="modal" data-target="#attribute_modal" style="background:var(--m-primary);color:#fff;border-radius:var(--m-radius-sm);padding:10px 20px;font-weight:600;">
                                <i class="fas fa-plus" style="margin-inline-end:6px;"></i>{{ __('Create Varient') }}
                            </button>
                            <div id="accordion">
                                <div>
                                    <form action="{{ route('seller.product.variation',$info->id) }}" class="basicform">
                                        @csrf
                                        <table class="table table-hover table-border">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">{{ __('Attribute') }}</th>
                                                    <th>{{ __('Values') }}</th>
                                                    <th>{{ __('Trash') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data-body">
                                                @php $i=1; @endphp
                                                @foreach($variations as $key => $value)
                                                @php $i++; @endphp
                                                <tr class="attr_{{ $i }}">
                                                    <td>
                                                        <select data-id="{{ $i }}" class="form-control parent_attr selec{{ $i }}">
                                                            <option value="" disabled selected>{{ __('Select Varient') }}</option>
                                                            @foreach ($posts as $k => $row)
                                                            <option data-parentattribute="{{ $row->childrenCategories }}" value="{{ $row->id }}" @if($key == $row->id) selected @endif>{{ $row->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="child[{{ $key }}][]" multiple class="form-control select2 multislect child{{ $i }}">
                                                            @foreach ($posts as $post)
                                                            @if($key == $post->id)
                                                            @foreach ($post->childrenCategories as $item)
                                                            <option class="attr{{ $i }}" value="{{ $item->id }}" @if(in_array($item->id,$attribute)) selected @endif>{{ $item->name }}</option>
                                                            @endforeach
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a data-id="{{ $i }}" class="btn btn-danger remove_attr text-white" style="border-radius:6px;"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <button class="btn btn-primary basicbtn" style="background:var(--m-primary)!important;border-color:var(--m-primary)!important;padding:12px 32px!important;font-size:15px!important;">
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
    </div>
</div>

<div class="none">
    <div class="attrs_row">
        @foreach($posts as $post)
        <option value="{{ $post->id }}" data-parentattribute="{{ $post->childrenCategories }}">{{ $post->name }}</option>
        @endforeach
    </div>
</div>
@endsection
@push('css')
<style>
.none{display:none;}
.select2-container--default .select2-selection--multiple{border:1px solid var(--m-border)!important;border-radius:var(--m-radius-sm)!important;background:var(--m-card-bg)!important;padding:8px 12px!important;min-height:48px!important;}
.select2-container--default .select2-selection--multiple .select2-selection__choice{background:var(--m-accent)!important;border:none!important;color:#fff!important;border-radius:6px!important;padding:4px 10px!important;}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{color:#fff!important;}
</style>
@endpush
@push('js')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
<script src="{{ asset('assets/seller/product/variants.js') }}"></script>
@endpush
