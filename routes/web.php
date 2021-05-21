<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SslCommerzPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// sslcommerze
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

// profile routes
Route::middleware('auth')->group(function () {
  Route::get('updatePassword', 'Admin\UserController@editPassword')->name('updatePassword.edit');
  Route::post('updatePassword', 'Admin\UserController@updatePassword')->name('updatePassword.update');
});

// Dashboard routes
Route::namespace('Admin')->prefix('dashboard')->middleware('auth')->group(function () {
  Route::resource('tag', 'TagController');
  Route::resource('user', 'UserController');
  Route::resource('format', 'FormatController');
  Route::resource('coupon', 'CouponController');
  Route::resource('feature', 'FeatureController');
  Route::resource('product', 'ProductController');
  Route::resource('subject', 'SubjectController');
  Route::resource('language', 'LanguageController');
  Route::resource('category', 'CategoryController');
  Route::resource('subcategory', 'SubcategoryController');
  Route::resource('customer_support', 'CustomerSupportController');
  Route::resource('order', 'OrderController');
  Route::resource('post', 'PostController');
  Route::resource('post_category', 'PostCategoryController');
  Route::resource('post_tag', 'BlogTagController');
  Route::resource('slider', 'SliderController');
  Route::resource('review', 'ReviewController');
  Route::resource('feature-category', 'FeatureCategoryController');
  Route::resource('categorysection', 'CategorySectionController');
  Route::resource('address', 'ShippingAddressController');
  Route::get('banner', 'SliderController@bannerIndex')->name('ads.banner');
  Route::post('banner', 'SliderController@createBanner')->name('store.banner');
  Route::post('order/status', 'OrderController@changeStatus')->name('order.status');
  Route::post('order/return', 'OrderController@changeReturn')->name('order.return');
  Route::get('order/user/{id}', 'OrderController@userOrder')->name('user.orders');
  Route::resource('developer/permission', 'PermissionController');
  Route::get('/', 'DashboardController@index')->name('dashboard');
  Route::get('role/assign', 'RoleController@roleAssign')->name('role.assign');
  Route::post('role/assign', 'RoleController@storeAssign')->name('store.assign');
  Route::resource('role', 'RoleController');
  Route::get('company_settings', 'SettingController@editCompanySetting')->name('company.edit');
  Route::post('company_setting', 'SettingController@updateCompanySetting')->name('company.update');
  Route::get('ecommerce_settings', 'SettingController@editEcommerceSetting')->name('ecommerce.edit');
  Route::post('ecommerce_setting', 'SettingController@updateEcommerceSetting')->name('ecommerce.update');
  Route::get('stock', 'ProductController@showStock')->name('stock.index');
  Route::post('stock/{id}', 'ProductController@updateStock')->name('stock.update');

  //ajax
  Route::post('getSubcategory', 'ProductController@categorySubcategory')->name('load.subcategory');
});

// website routes
Route::namespace('Web')->middleware('web')->group(function () {
  Route::middleware('auth')->group(function () {
    Route::get('checkout', 'WebController@Checkout')->name('checkout');
  });

  Route::get('/', 'WebController@index');
   // cashpayment
   Route::resource('cash', 'CashController');
   // cashpayment
  Route::get('faq', 'WebController@faq');
  Route::get('cart', 'WebController@Cart');
  Route::get('compare', 'WebController@compare');
  Route::get('about-us', 'WebController@aboutus');
  Route::get('wish_list', 'WebController@wish_list');
  Route::get('my_account', 'WebController@my_account');
  Route::get('login_register', 'WebController@login_register');
  Route::get('product_details', 'WebController@product_details');
  Route::get('customer_support', 'WebController@customer_support');
  Route::post('customer_support', 'WebController@customer_support_store')->name('support.create');
  Route::get('shop_left_sidebar', 'WebController@shop_left_sidebar');
  Route::get('faq', 'WebController@faq');
  Route::get('terms', 'WebController@terms');
  Route::get('privacy_policy', 'WebController@privacy_policy');
  Route::get('refund', 'WebController@refund');
  Route::get('return', 'WebController@return');
  //Blog Links
  Route::get('all_posts', 'WebController@all_posts')->name('allPost.index');
  Route::get('all_posts/tag/{id}', 'WebController@all_posts_with_tag')->name('post.by_tag');
  Route::get('all_posts/category/{id}', 'WebController@all_posts_with_category')->name('post.by_category');
  Route::get('post_details/{id}', 'WebController@post_details')->name('post.view');

  Route::post('search', 'WebController@search')->name('mySearch');
  Route::get('all-author', 'WebController@allAuthor')->name('author.all');
  Route::get('all-category', 'WebController@allCategories')->name('category.all');
  Route::get('products/{for}/{id}', 'ProductController@allProducts')->name('all.products');
  Route::get('productdetails/{id}', 'ProductController@productDetails')->name('product.details');

  // imported from other project for cart
  Route::get('login-check', 'CartController@logCheck')->name('login_check');
  Route::post('addToCart', 'CartController@addToCookies')->name('addToCart.cookies');
  Route::get('/cancel-order/{id}', 'CartController@cancel_order')->name('cancel.order');
  Route::post('/confirm-cancel-order', 'CartController@confirm_cancel')->name('confirm.cancel_order');
  Route::get('/remove-cancel/{id}', 'CartController@remove_cancel')->name('remove.cancellation');
  Route::get('order-product', 'CartController@order_product')->name('order.product');
  Route::name('cart.')->group(function () {
    Route::post("/save-cart-item", "CartController@store")->name('store');
    Route::post('/update-cart-item', 'CartController@updateCart')->name('update');
    Route::get('/carts', 'CartController@carts')->name('items');
    Route::post('/remove-cart-item', 'CartController@removeItem')->name('destroy');
    Route::post('/location-store', 'CartController@locationStore')->name('orderLocation');
    Route::get('/recheck-order', 'CartController@order_check')->name('check');
    Route::post('/get-coupon', 'CartController@get_coupon')->name('get_coupon');
    Route::get('/payment-option', 'CartController@paymentPage')->name('payment');
    Route::post('/confirm-order', 'CartController@confirmOrder')->name('complete-order');
    Route::get('/delivery-method/{id}', 'CartController@delivery_method')->name('delivery_method');
    Route::get('/place-order/{id}', 'CartController@placeOrder')->name('placeorder');
    Route::post("/favourite", "CartController@favourite")->name('favourite');
    Route::post("/favourite-storage", "CartController@favourite_storage")->name('favourite_storage');
  });

});

// cache clear
Route::get('reboot', function () {
  Artisan::call('cache:clear');
  Artisan::call('view:clear');
  Artisan::call('route:clear');
  Artisan::call('config:cache');
  Artisan::call('view:cache');
  dd('Done');
});

Route::get('storageLink', function () {
  Artisan::call('storage:link');
  dd('Done');
});

Route::get('migrate', function () {
  Artisan::call('migrate');
  dd('Done');
});
