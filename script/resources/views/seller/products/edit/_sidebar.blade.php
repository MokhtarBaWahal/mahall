{{-- Shared product edit sidebar navigation --}}
<div class="col-sm-3" style="background:var(--m-sidebar-bg);min-height:100%;border-{{ app()->getLocale()=='ar' ? 'left' : 'right' }}:1px solid var(--m-border-light);">
    <div style="padding:24px 16px;">
        <h6 style="font-size:13px;font-weight:700;color:#8c7b6b;text-transform:uppercase;letter-spacing:0.5px;padding:0 12px;margin:0 0 16px;">{{ __('Product Settings') }}</h6>
        <ul class="nav nav-pills flex-column m-edit-nav" style="list-style:none;padding:0;margin:0;">
            @php
                $navItems = [
                    ['url' => route('seller.product.edit',$info->id), 'icon' => 'fas fa-cogs', 'label' => __('Item'), 'key' => 'edit'],
                    ['url' => url('seller/product/'.$info->id.'/price'), 'icon' => 'fas fa-money-bill-alt', 'label' => __('Price'), 'key' => 'price'],
                    ['url' => url('seller/product/'.$info->id.'/option'), 'icon' => 'fas fa-tags', 'label' => __('Options'), 'key' => 'option'],
                    ['url' => url('seller/product/'.$info->id.'/varient'), 'icon' => 'fas fa-expand-arrows-alt', 'label' => __('Variants'), 'key' => 'varient'],
                    ['url' => url('seller/product/'.$info->id.'/image'), 'icon' => 'far fa-images', 'label' => __('Images'), 'key' => 'image'],
                    ['url' => url('seller/product/'.$info->id.'/inventory'), 'icon' => 'fa fa-cubes', 'label' => __('Inventory'), 'key' => 'inventory'],
                    ['url' => url('seller/product/'.$info->id.'/files'), 'icon' => 'fas fa-file', 'label' => __('Files'), 'key' => 'files'],
                    ['url' => url('seller/product/'.$info->id.'/seo'), 'icon' => 'fas fa-chart-line', 'label' => __('SEO'), 'key' => 'seo'],
                    ['url' => url('seller/product/'.$info->id.'/express-checkout'), 'icon' => 'fas fa-cart-arrow-down', 'label' => __('Express checkout'), 'key' => 'express-checkout'],
                ];
            @endphp
            @foreach($navItems as $nav)
            <li class="nav-item" style="margin-bottom:4px;">
                <a class="nav-link {{ ($activeTab ?? 'edit') == $nav['key'] ? 'active' : '' }}"
                   href="{{ $nav['url'] }}"
                   style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:var(--m-radius-sm);font-size:14px;font-weight:{{ ($activeTab ?? 'edit') == $nav['key'] ? '600' : '500' }};text-decoration:none;{{ ($activeTab ?? 'edit') != $nav['key'] ? 'color:var(--m-text-body);' : '' }}">
                    <i class="{{ $nav['icon'] }}" style="width:20px;text-align:center;"></i> {{ $nav['label'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@push('css')
<style>
.m-edit-nav .nav-link.active{background:var(--m-primary)!important;color:#fff!important;font-weight:600!important;}
.m-edit-nav .nav-link:not(.active):hover{background:rgba(121,88,47,0.08);color:var(--m-primary);}
</style>
@endpush
