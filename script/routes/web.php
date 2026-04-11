<?php

use Illuminate\Support\Facades\Route;

// ============================================================
// INSTALLER ROUTES
// ============================================================
Route::get('install', 'Installer\InstallerController@install');
Route::get('install/purchase', function () {
    return view('installer.purchase');
});
Route::get('install/info', 'Installer\InstallerController@info');
Route::post('install/store', 'Installer\InstallerController@send');
Route::get('install/migrate', 'Installer\InstallerController@migrate');
Route::post('install/migrate', 'Installer\InstallerController@migrate');
Route::get('install/check', 'Installer\InstallerController@check');

// ============================================================
// MAIN FRONTEND ROUTES (main domain)
// ============================================================
Route::get('/', 'FrontendController@welcome')->name('home');
Route::get('/check', 'FrontendController@check');
Route::get('/page/{slug}', 'FrontendController@page');
Route::get('/service', 'FrontendController@service');
Route::get('/priceing', 'FrontendController@priceing');
Route::get('/contact', 'FrontendController@contact');
Route::post('/contact/send', 'FrontendController@send_mail')->name('send_mail');
Route::post('/translate', 'FrontendController@translate')->name('translate');

// Merchant registration from main site
Route::get('/register/{id}', 'FrontendController@register_view')->name('merchant.form');
Route::post('/register/{id}', 'FrontendController@register')->name('merchant.register-make');

// Payment callbacks for main site subscriptions
Route::get('/payment/success', 'FrontendController@success');
Route::get('/payment/fail', 'FrontendController@fail');

// Authenticated merchant area on main domain
Route::middleware(['auth', 'seller'])->prefix('merchant')->group(function () {
    Route::get('/dashboard', 'FrontendController@dashboard')->name('merchant.dashboard');
    Route::get('/settings', 'FrontendController@settings')->name('merchant.profile.settings');
    Route::get('/plan', 'FrontendController@plans')->name('merchant.plan');
    Route::get('/payment/{id}', 'FrontendController@make_payment')->name('merchant.make_payment');
    Route::post('/payment/{id}', 'FrontendController@make_charge');
    Route::get('/payment-with/razorpay', 'Seller\PlanController@razorpay')->name('seller.razorpay');
    Route::post('/payment-with/razorpay', 'Seller\PlanController@razorpay_pay');
    Route::get('/payment/renew/{id}', 'Seller\PlanController@renew');
});

// ============================================================
// AUTH ROUTES
// ============================================================
Auth::routes(['verify' => true]);

// ============================================================
// UTILITY (temporary - remove after use)
// ============================================================
Route::get('/clear-cache-mahal', function () {
    \Artisan::call('view:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    return 'All caches cleared! You can remove this route now.';
});

// ============================================================
// ADMIN ROUTES
// ============================================================
Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => ['web', 'auth', 'admin'],
    'namespace'  => 'Admin',
], function () {

    // Dashboard
    Route::get('/', 'AdminController@dashboard')->name('dashboard');
    Route::get('/dashboard/static', 'AdminController@staticData')->name('dashboard.static');
    Route::get('/dashboard/performance/{period}', 'AdminController@perfomance');
    Route::get('/dashboard/order-statics/{month}', 'AdminController@order_statics');
    Route::get('/dashboard/google-analytics/{days}', 'AdminController@google_analytics');
    Route::get('/report', 'ReportController@index')->name('report');

    // Users
    Route::get('/users', 'AdminController@index')->name('users.index');
    Route::get('/users/create', 'AdminController@create')->name('users.create');
    Route::post('/users', 'AdminController@store')->name('users.store');
    Route::get('/users/{id}', 'AdminController@show')->name('users.show');
    Route::get('/users/{id}/edit', 'AdminController@edit')->name('users.edit');
    Route::put('/users/{id}', 'AdminController@update')->name('users.update');
    Route::post('/users/delete', 'AdminController@destroy')->name('users.destroy');

    // Roles
    Route::get('/role', 'RoleController@index')->name('role.index');
    Route::get('/role/create', 'RoleController@create')->name('role.create');
    Route::post('/role', 'RoleController@store')->name('role.store');
    Route::get('/role/{id}', 'RoleController@show')->name('role.show');
    Route::get('/role/{id}/edit', 'RoleController@edit')->name('role.edit');
    Route::put('/role/{id}', 'RoleController@update')->name('role.update');
    Route::post('/role/delete', 'RoleController@destroy')->name('roles.destroy');

    // Customers (Sellers)
    Route::get('/customer', 'CustomerController@index')->name('customer.index');
    Route::get('/customer/create', 'CustomerController@create')->name('customer.create');
    Route::post('/customer', 'CustomerController@store')->name('customer.store');
    Route::get('/customer/{id}', 'CustomerController@show')->name('customer.show');
    Route::get('/customer/{id}/edit', 'CustomerController@edit')->name('customer.edit');
    Route::put('/customer/{id}', 'CustomerController@update')->name('customer.update');
    Route::get('/customer/{id}/plan', 'CustomerController@planview')->name('customer.planedit');
    Route::post('/customer/{id}/plan', 'CustomerController@updateplaninfo')->name('customer.updateplaninfo');
    Route::post('/customer/delete', 'CustomerController@destroy')->name('customers.destroys');

    // Orders
    Route::get('/order', 'OrderController@index')->name('order.index');
    Route::get('/order/create', 'OrderController@create')->name('order.create');
    Route::post('/order', 'OrderController@store')->name('order.store');
    Route::get('/order/{id}', 'OrderController@show')->name('order.show');
    Route::get('/order/{id}/invoice', 'OrderController@invoice')->name('order.invoice');
    Route::get('/order/{id}/edit', 'OrderController@edit')->name('order.edit');
    Route::put('/order/{id}', 'OrderController@update')->name('order.update');
    Route::post('/order/delete', 'OrderController@destroy')->name('orders.destroys');

    // Plans
    Route::get('/plan', 'PlanController@index')->name('plan.index');
    Route::get('/plan/create', 'PlanController@create')->name('plan.create');
    Route::post('/plan', 'PlanController@store')->name('plan.store');
    Route::get('/plan/{id}', 'PlanController@show')->name('plan.show');
    Route::get('/plan/{id}/edit', 'PlanController@edit')->name('plan.edit');
    Route::put('/plan/{id}', 'PlanController@update')->name('plan.update');
    Route::post('/plan/delete', 'PlanController@destroy')->name('plans.destroys');

    // Domains
    Route::get('/domain', 'DomainController@index')->name('domain.index');
    Route::get('/domain/create', 'DomainController@create')->name('domain.create');
    Route::post('/domain', 'DomainController@store')->name('domain.store');
    Route::get('/domain/{id}', 'DomainController@show')->name('domain.show');
    Route::get('/domain/{id}/edit', 'DomainController@edit')->name('domain.edit');
    Route::put('/domain/{id}', 'DomainController@update')->name('domain.update');
    Route::post('/domain/delete', 'DomainController@destroy')->name('domains.destroys');

    // Pages
    Route::get('/page', 'PageController@index')->name('page.index');
    Route::get('/page/create', 'PageController@create')->name('page.create');
    Route::post('/page', 'PageController@store')->name('page.store');
    Route::get('/page/{id}/edit', 'PageController@edit')->name('page.edit');
    Route::put('/page/{id}', 'PageController@update')->name('page.update');
    Route::post('/page/delete', 'PageController@destroy')->name('pages.destroys');

    // Gallery
    Route::get('/gallery', 'GalleryController@index')->name('gallery.index');
    Route::post('/gallery', 'GalleryController@store')->name('gallery.store');
    Route::post('/gallery/delete', 'GalleryController@destroy')->name('galleries.destroys');

    // Menu
    Route::get('/menu', 'MenuController@index')->name('menu.index');
    Route::post('/menu', 'MenuController@store')->name('menu.store');
    Route::get('/menu/{id}', 'MenuController@show')->name('menu.show');
    Route::post('/menu/node', 'MenuController@MenuNodeStore')->name('menus.MenuNodeStore');
    Route::get('/menu/{id}/edit', 'MenuController@edit')->name('menu.edit');
    Route::put('/menu/{id}', 'MenuController@update')->name('menu.update');
    Route::post('/menu/delete', 'MenuController@destroy')->name('menues.destroy');

    // Language
    Route::get('/language', 'LanguageController@index')->name('language.index');
    Route::get('/language/create', 'LanguageController@create')->name('language.create');
    Route::post('/language', 'LanguageController@store')->name('language.store');
    Route::post('/language/add-key', 'LanguageController@add_key')->name('language.add_key');
    Route::get('/language/{id}', 'LanguageController@show')->name('language.show');
    Route::put('/language/{id}', 'LanguageController@update')->name('language.update');
    Route::post('/language/active', 'LanguageController@setActiveLanuguage')->name('languages.active');
    Route::post('/language/delete', 'LanguageController@destroy')->name('languages.delete');

    // Marketing
    Route::get('/marketing', 'MarketingController@index')->name('marketing.index');
    Route::post('/marketing', 'MarketingController@store')->name('marketing.store');

    // SEO
    Route::get('/seo', 'SeoController@index')->name('seo.index');
    Route::post('/seo', 'SeoController@store')->name('seo.store');
    Route::put('/seo/{id}', 'SeoController@update')->name('seo.update');

    // Email
    Route::post('/email', 'EmailController@store')->name('email.store');

    // Email Templates
    Route::get('/email-template', 'EmailtemplateController@index')->name('emailtemplate.index');
    Route::get('/email-template/create', 'EmailtemplateController@create')->name('emailtemplate.create');
    Route::post('/email-template', 'EmailtemplateController@store')->name('emailtemplate.store');
    Route::get('/email-template/{id}', 'EmailtemplateController@show')->name('emailtemplate.show');
    Route::get('/email-template/{id}/edit', 'EmailtemplateController@edit')->name('emailtemplate.edit');
    Route::put('/email-template/{id}', 'EmailtemplateController@update')->name('emailtemplate.update');
    Route::post('/email-template/delete', 'EmailtemplateController@destroy')->name('emailtemplate.destroy');

    // Payment Gateways
    Route::get('/payment-geteway', 'PaymentController@index')->name('payment-geteway.index');
    Route::get('/payment-geteway/{id}', 'PaymentController@show')->name('payment-geteway.show');
    Route::put('/payment-geteway/{id}', 'PaymentController@update')->name('payment-geteway.update');

    // Templates
    Route::get('/template', 'TemplateController@index')->name('template.index');
    Route::post('/template', 'TemplateController@store')->name('template.store');
    Route::post('/template/delete', 'TemplateController@destroy')->name('templates.delete');

    // Cron
    Route::get('/cron', 'CronController@index')->name('cron.index');
    Route::post('/cron', 'CronController@store')->name('cron.store');

    // Site Settings
    Route::get('/site-settings', 'SiteController@site_settings')->name('site.settings');
    Route::post('/site-settings', 'SiteController@site_settings_update')->name('site_settings.update');
    Route::get('/system-environment', 'SiteController@system_environment_view')->name('site.environment');
    Route::post('/env-update', 'SiteController@env_update')->name('env.update');

    // Appearance / Frontend content
    Route::get('/appearance', 'FrontendController@show')->name('appearance.show');
    Route::post('/appearance', 'FrontendController@store')->name('appearance.store');
    Route::put('/appearance/{id}', 'FrontendController@update')->name('appearance.update');
    Route::post('/appearance/delete', 'FrontendController@destroy')->name('appearance.destroy');

    // Profile
    Route::get('/profile', 'SettingController@show')->name('profile.settings');
    Route::post('/profile', 'SettingController@store');

    // Scripts
    Route::get('/script', 'ScriptController@index')->name('script.index');
    Route::get('/script/create', 'ScriptController@create')->name('script.create');
    Route::post('/script', 'ScriptController@store')->name('script.store');
    Route::get('/script/{id}', 'ScriptController@show')->name('script.show');
    Route::get('/script/{id}/edit', 'ScriptController@edit')->name('script.edit');
    Route::put('/script/{id}', 'ScriptController@update')->name('script.update');
    Route::post('/script/delete', 'ScriptController@destroy')->name('script.destroy');

    // Categories (admin content categories)
    Route::get('/category', 'CategoryController@index')->name('categorie.index');
    Route::post('/category/delete', 'CategoryController@destroy')->name('categorie.destroys');

    // Ads
    Route::get('/ads', 'AdsController@index')->name('ads.index');
    Route::post('/ads', 'AdsController@store')->name('ads.store');
    Route::get('/ads/{id}', 'AdsController@show')->name('ads.show');
    Route::put('/ads/{id}', 'AdsController@update')->name('ads.update');
    Route::post('/ads/delete', 'AdsController@destroy')->name('ads.destroy');
});

// ============================================================
// SELLER PANEL ROUTES
// ============================================================
Route::group([
    'prefix'     => 'seller',
    'as'         => 'seller.',
    'middleware' => ['web', 'auth', 'seller'],
    'namespace'  => 'Seller',
], function () {

    // Dashboard
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/dashboard/static', 'DashboardController@staticData')->name('dashboard.static');
    Route::get('/dashboard/performance/{period}', 'DashboardController@perfomance');
    Route::get('/dashboard/order-statics/{month}', 'DashboardController@order_statics');
    Route::get('/dashboard/google-analytics/{days}', 'DashboardController@google_analytics');

    // Products
    Route::get('/product', 'ProductController@index')->name('product.index');
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product', 'ProductController@store')->name('product.store');
    Route::post('/product/store-group', 'ProductController@store_group')->name('product.store_group');
    Route::get('/product/list', 'ProductController@list')->name('product.list');
    Route::get('/product/{id}/edit', 'ProductController@edit')->name('product.edit');
    Route::get('/product/{id}/variation', 'ProductController@variation')->name('product.variation');
    Route::put('/product/{id}', 'ProductController@update')->name('product.update');
    Route::get('/product/{id}/price', 'ProductController@price')->name('products.price');
    Route::get('/product/{id}/seo', 'ProductController@seo')->name('products.seo');
    Route::post('/product/delete', 'ProductController@destroy')->name('products.destroys');
    Route::post('/product/add-row', 'ProductController@add_row')->name('product.add_row');
    Route::post('/product/row-update', 'ProductController@row_update')->name('product.row_update');
    Route::post('/product/option-delete', 'ProductController@option_delete')->name('product.option_delete');
    Route::post('/product/option-update', 'ProductController@option_update')->name('product.option_update');
    Route::post('/products/stock-update', 'ProductController@stock_update')->name('products.stock_update');
    Route::post('/products/import', 'ProductController@import')->name('products.import');

    // Orders
    Route::get('/order', 'OrderController@index')->name('order.index');
    Route::get('/order/create', 'OrderController@create')->name('order.create');
    Route::post('/order', 'OrderController@store')->name('order.store');
    Route::get('/order/{id}', 'OrderController@show')->name('order.show');
    Route::get('/order/{id}/invoice', 'OrderController@invoice')->name('order.invoice');
    Route::get('/order/{id}/edit', 'OrderController@edit')->name('order.edit');
    Route::put('/order/{id}', 'OrderController@update')->name('order.update');
    Route::post('/order/delete', 'OrderController@destroy')->name('orders.destroys');
    Route::post('/order/apply-coupon', 'OrderController@apply_coupon')->name('orders.apply_coupon');
    Route::post('/order/make-order', 'OrderController@make_order')->name('orders.make_order');
    Route::post('/order/method', 'OrderController@calculateShipping')->name('orders.method');
    Route::post('/order/status', 'OrderController@update')->name('orders.status');
    Route::get('/checkout', 'OrderController@checkout')->name('checkout');
    Route::post('/cart/remove', 'OrderController@cartRemove')->name('cart.remove');

    // Customers
    Route::get('/customer', 'CustomerController@index')->name('customer.index');
    Route::get('/customer/create', 'CustomerController@create')->name('customer.create');
    Route::post('/customer', 'CustomerController@store')->name('customer.store');
    Route::get('/customer/{id}', 'CustomerController@show')->name('customer.show');
    Route::get('/customer/{id}/edit', 'CustomerController@edit')->name('customer.edit');
    Route::put('/customer/{id}', 'CustomerController@update')->name('customer.update');
    Route::get('/customer/{id}/login', 'CustomerController@login')->name('customer.login');
    Route::post('/customer/delete', 'CustomerController@destroy')->name('customers.destroys');

    // Categories
    Route::get('/category', 'CategoryController@index')->name('category.index');
    Route::get('/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/category', 'CategoryController@store')->name('category.store');
    Route::get('/category/{id}/edit', 'CategoryController@edit')->name('category.edit');
    Route::put('/category/{id}', 'CategoryController@update')->name('category.update');
    Route::post('/category/delete', 'CategoryController@destroy')->name('categorie.destroys');

    // Attributes
    Route::get('/attribute', 'AttributeController@index')->name('attribute.index');
    Route::get('/attribute/create', 'AttributeController@create')->name('attribute.create');
    Route::post('/attribute', 'AttributeController@store')->name('attribute.store');
    Route::get('/attribute/{id}/edit', 'AttributeController@edit')->name('attribute.edit');
    Route::put('/attribute/{id}', 'AttributeController@update')->name('attribute.update');
    Route::post('/attribute/delete', 'AttributeController@destroy')->name('attributes.destroy');

    // Attribute Terms (Child Attributes)
    Route::get('/attribute/{id}/terms', 'ChildattributeController@show')->name('attribute-term.show');
    Route::post('/attribute-term', 'ChildattributeController@store')->name('attribute-term.store');
    Route::get('/attribute-term/{id}/edit', 'ChildattributeController@edit')->name('attribute-term.edit');
    Route::put('/attribute-term/{id}', 'ChildattributeController@update')->name('attribute-term.update');
    Route::post('/attribute-term/delete', 'ChildattributeController@destroy')->name('attributes-terms.destroy');

    // Brands
    Route::get('/brand', 'BrandController@index')->name('brand.index');
    Route::get('/brand/create', 'BrandController@create')->name('brand.create');
    Route::post('/brand', 'BrandController@store')->name('brand.store');
    Route::get('/brand/{id}/edit', 'BrandController@edit')->name('brand.edit');
    Route::put('/brand/{id}', 'BrandController@update')->name('brand.update');
    Route::post('/brand/delete', 'BrandController@destroy')->name('brands.destroys');

    // Coupons
    Route::get('/coupon', 'CouponController@index')->name('coupon.index');
    Route::get('/coupon/create', 'CouponController@create')->name('coupon.create');
    Route::post('/coupon', 'CouponController@store')->name('coupon.store');
    Route::get('/coupon/{id}/edit', 'CouponController@edit')->name('coupon.edit');
    Route::put('/coupon/{id}', 'CouponController@update')->name('coupon.update');
    Route::post('/coupon/delete', 'CouponController@destroy')->name('coupons.destroy');

    // Locations
    Route::get('/location', 'LocationController@index')->name('location.index');
    Route::get('/location/create', 'LocationController@create')->name('location.create');
    Route::post('/location', 'LocationController@store')->name('location.store');
    Route::get('/location/{id}/edit', 'LocationController@edit')->name('location.edit');
    Route::put('/location/{id}', 'LocationController@update')->name('location.update');
    Route::post('/location/delete', 'LocationController@destroy')->name('locations.destroy');

    // Shipping
    Route::get('/shipping', 'ShippingController@index')->name('shipping.index');
    Route::get('/shipping/create', 'ShippingController@create')->name('shipping.create');
    Route::post('/shipping', 'ShippingController@store')->name('shipping.store');
    Route::get('/shipping/{id}/edit', 'ShippingController@edit')->name('shipping.edit');
    Route::put('/shipping/{id}', 'ShippingController@update')->name('shipping.update');
    Route::post('/shipping/delete', 'ShippingController@destroy')->name('shippings.destroy');

    // Pages
    Route::get('/page', 'PageController@index')->name('page.index');
    Route::get('/page/create', 'PageController@create')->name('page.create');
    Route::post('/page', 'PageController@store')->name('page.store');
    Route::get('/page/{id}/edit', 'PageController@edit')->name('page.edit');
    Route::put('/page/{id}', 'PageController@update')->name('page.update');
    Route::post('/page/delete', 'PageController@destroy')->name('pages.destroys');

    // Files
    Route::post('/file', 'FileController@store')->name('file.store');
    Route::put('/file/{id}', 'FileController@update')->name('files.update');
    Route::post('/file/delete', 'FileController@destroy')->name('files.destroy');

    // Product Media
    Route::post('/media', 'ProductmediaController@store')->name('media.store');
    Route::post('/media/delete', 'ProductmediaController@destroy')->name('medias.destroy');

    // Ads
    Route::get('/ads', 'AdsController@index')->name('ads.index');
    Route::post('/ads', 'AdsController@store')->name('ads.store');
    Route::get('/ads/{id}', 'AdsController@show')->name('ads.show');
    Route::put('/ads/{id}', 'AdsController@update')->name('ads.update');
    Route::post('/ads/delete', 'AdsController@destroy')->name('ad.destroy');

    // Slider
    Route::get('/slider', 'SliderController@index')->name('slider.index');
    Route::post('/slider', 'SliderController@store')->name('slider.store');
    Route::get('/slider/{id}', 'SliderController@show')->name('slider.show');

    // Menu
    Route::get('/menu', 'MenuController@index')->name('menu.index');
    Route::get('/menu/{id}', 'MenuController@show')->name('menu.show');
    Route::put('/menu/{id}', 'MenuController@update')->name('menu.update');

    // Theme
    Route::get('/theme', 'ThemeController@index')->name('theme.index');
    Route::put('/theme/{id}', 'ThemeController@update')->name('theme.update');

    // SEO
    Route::get('/seo', 'SeoController@index')->name('seo.index');
    Route::post('/seo', 'SeoController@store')->name('seo.store');
    Route::put('/seo/{id}', 'SeoController@update')->name('seo.update');

    // Marketing
    Route::get('/marketing/{id}', 'MarketingController@show')->name('marketing.show');
    Route::post('/marketing', 'MarketingController@store')->name('marketing.store');

    // Inventory
    Route::get('/inventory', 'InventoryController@index')->name('inventory.index');
    Route::put('/inventory/{id}', 'InventoryController@update')->name('inventory.update');

    // Reviews
    Route::get('/review', 'ReviewController@index')->name('review.index');
    Route::post('/review/delete', 'ReviewController@destroy')->name('reviews.destroys');

    // Payment Gateways
    Route::get('/payment', 'GetwayController@show')->name('payment.show');
    Route::post('/payment', 'GetwayController@store')->name('payment.store');
    Route::put('/payment/{id}', 'GetwayController@update')->name('payment.update');

    // Transactions
    Route::get('/transection', 'TransectionController@index')->name('transection.index');
    Route::post('/transection', 'TransectionController@store')->name('transection.store');

    // Reports
    Route::get('/report', 'ReportController@index')->name('report.index');

    // Settings
    Route::get('/settings', 'SettingController@settings_view')->name('seller.settings');
    Route::post('/settings', 'SettingController@store')->name('settings.store');
    Route::get('/settings/{id}', 'SettingController@show')->name('settings.show');
    Route::post('/profile/update', 'SettingController@profile_update')->name('my.profile.update');
    Route::get('/support', 'SettingController@support_view')->name('support');

    // Plan / Subscription
    Route::get('/plan/payment/{id}', 'PlanController@make_payment');
    Route::get('/plan/renew/{id}', 'PlanController@renew');
    Route::post('/plan/charge/{id}', 'PlanController@make_charge');
    Route::get('/plan/success', 'PlanController@success');
    Route::get('/plan/fail', 'PlanController@fail');
});

// ============================================================
// CRON / SCHEDULED TASK ROUTES
// ============================================================
Route::get('/cron/expire', 'CronController@makeExpireAbleCustomer');
Route::get('/cron/expired-tenant', 'CronController@expiredTenant');
Route::get('/cron/reset-price', 'CronController@reset_product_price');
Route::get('/cron/expire-soon', 'CronController@expireSoon');
Route::get('/cron/send-mail', 'CronController@send_mail_to_will_expire_plan_soon');
