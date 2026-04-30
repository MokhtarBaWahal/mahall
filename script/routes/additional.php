<?php
use Illuminate\Support\Facades\Route;

//Route::group(['as' =>'seller.','prefix'=>'seller','namespace'=>'Seller','middleware'=>['web','auth','seller']],function(){

	Route::get('seller/setting/domain','Seller\DomainController@index')->middleware(['web','auth','seller'])->name('seller.domain.index');
	Route::post('seller/domain/store','Seller\DomainController@store')->middleware(['web','auth','seller'])->name('seller.customdomain.store');
	Route::put('seller/domain/update/{id}','Seller\DomainController@update')->middleware(['web','auth','seller'])->name('seller.customdomain.update');
	

	Route::get('admin/custom-domain','Admin\CustomdomainController@index')->middleware(['web','auth','admin'])->name('admin.customdomain.index');
	Route::get('admin/custom-domain/{id}','Admin\CustomdomainController@show')->middleware(['web','auth','admin'])->name('admin.customdomain.show');
	Route::get('admin/custom-domain/edit/{id}','Admin\CustomdomainController@edit')->middleware(['web','auth','admin'])->name('admin.customdomain.edit');
	Route::post('admin/custom-domain-delete','Admin\CustomdomainController@destroy')->middleware(['web','auth','admin'])->name('admin.customdomain.destroy');
	Route::put('admin/custom-domain-update/{id}','Admin\CustomdomainController@update')->middleware(['web','auth','admin'])->name('admin.customdomain.update');

//});

	Route::post('seller/delete-subscribers','Seller\NotificationController@destroy')->middleware(['web','auth','seller'])->name('seller.notification.delete');
	Route::post('seller/notify-to-customer','Seller\NotificationController@store')->middleware(['web','auth','seller'])->name('seller.notification.post');

// Match any other domains
Route::group(['domain' => '{domain}','middleware'=>['domain','customdomain']], function(){

    Route::group(['namespace'=>'Frontend'], function(){
        Route::get('/',                         'FrontendController@index')->name('tenant.home');
        Route::get('tracking',                  'FrontendController@tracking');
        Route::get('sitemap.xml',               'FrontendController@sitemap');
        Route::get('shop',                      'FrontendController@shop')->name('tenant.shop');
        Route::get('cart',                      'FrontendController@cart')->name('tenant.cart');
        Route::get('wishlist',                  'FrontendController@wishlist');
        Route::get('checkout',                  'FrontendController@checkout')->name('tenant.checkout');
        Route::get('thanks',                    'FrontendController@thanks');
        Route::get('page/{slug}',               'FrontendController@page');
        Route::get('product/{slug}/{id}',       'FrontendController@detail')->name('tenant.product');
        Route::get('category/{id}',             'FrontendController@category');
        Route::get('brand/{id}',                'FrontendController@brand');
        Route::get('search',                    'FrontendController@product_search');

        // AJAX / API endpoints for theme JS
        Route::post('make-local',               'FrontendController@make_local');
        Route::get('home-page-products',        'FrontendController@home_page_products');
        Route::get('get-menu-category',         'FrontendController@get_menu_category');
        Route::get('get-featured-attributes',   'FrontendController@get_featured_attributes');
        Route::get('get-related-products',      'FrontendController@get_ralated_products');
        Route::get('get-related-post-products', 'FrontendController@get_ralated_product_with_latest_post');
        Route::get('get-reviews/{id}',          'FrontendController@get_reviews');
        Route::get('get-featured-category',     'FrontendController@get_featured_category');
        Route::get('get-featured-brand',        'FrontendController@get_featured_brand');
        Route::get('get-category',              'FrontendController@get_category');
        Route::get('get-brand',                 'FrontendController@get_brand');
        Route::get('get-products',              'FrontendController@get_products');
        Route::get('get-shop-products',         'FrontendController@get_shop_products');
        Route::get('get-shop-attributes',       'FrontendController@get_shop_attributes');
        Route::get('get-bump-ads',              'FrontendController@get_bump_adds');
        Route::get('get-banner-ads',            'FrontendController@get_banner_adds');
        Route::get('max-price',                 'FrontendController@max_price');
        Route::get('min-price',                 'FrontendController@min_price');

        // Cart & order actions
        Route::post('cart/add',             'CartController@store')->name('tenant.cart.add');
        Route::post('cart/update',          'CartController@update');
        Route::post('cart/remove',          'CartController@destroy');
        Route::post('wishlist/add',         'CartController@wishlist_add');
        Route::post('wishlist/remove',      'FrontendController@wishlist_remove');
        Route::post('order',                'OrderController@store')->name('tenant.order.store');
        Route::get('order/success',         'OrderController@success');
        Route::get('order/fail',            'OrderController@fail');
        Route::post('review',               'ReviewController@store');

        // Auth
        Route::get('login',                 'UserController@login')->name('tenant.login');
        Route::post('login',                'UserController@authenticate');
        Route::get('register',              'UserController@register')->name('tenant.register');
        Route::post('register',             'UserController@store');
        Route::get('logout',                'UserController@logout')->name('tenant.logout');
        Route::get('profile',               'UserController@profile')->name('tenant.profile');
        Route::post('profile/update',       'UserController@update');
        Route::get('orders',                'UserController@orders')->name('tenant.orders');
        Route::get('orders/{id}',           'UserController@order_detail');

    });

});

?>