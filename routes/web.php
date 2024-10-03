<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserSellerController;
use App\Http\Controllers\DashboardController;


// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', function () {
    return view('signup.register');
});
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('register/store', [LoginController::class, 'store'])->name('register.store');



Route::middleware(['admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard_index'])->name('dashboard');

    //user routes
    Route::get('/user/index', [UserSellerController::class, 'user_index'])->name('user.index');
    Route::get('/seller/index', [UserSellerController::class, 'seller_index'])->name('seller.index');
    Route::get('/seller/create', [UserSellerController::class, 'seller_create'])->name('seller.create');
    Route::get('users/{id}', [UserSellerController::class, 'user_view'])->name('users.view');
    Route::get('/states/{countryId}', [UserSellerController::class, 'getStates']);
    Route::get('/cities/{stateId}', [UserSellerController::class, 'getCities']);
    Route::post('/seller_store', [UserSellerController::class, 'seller_store'])->name('seller.store');
    Route::post('/seller_update/{id}', [UserSellerController::class, 'seller_update'])->name('seller.update');
    Route::delete('/seller_destroy/{id}', [UserSellerController::class, 'seller_destroy'])->name('seller.delete');
    Route::delete('/user_destroy/{id}', [UserSellerController::class, 'user_destroy'])->name('user.delete');
    Route::any('/seller_edit/{id}', [UserSellerController::class, 'seller_edit'])->name('seller.edit');

    //admin profile route
    Route::get('/admin/profile/{id}', [UserSellerController::class, 'admin_profile'])->name('admin.profile');
    Route::get('/admin/edit/{id}', [UserSellerController::class, 'admin_edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [UserSellerController::class, 'admin_update'])->name('admin.update');

    // category route start
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::PATCH('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category/{id}/child', [CategoryController::class, 'getChildByParent'])->name('category.getChildByParent');


    // product route start

    Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
    Route::get('/product/add', [ProductController::class, 'product_add'])->name('product.add');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'product_edit'])->name('product.edit');
    Route::any('/product/update/{id}', [ProductController::class, 'product_update'])->name('product.update');
    Route::delete('/product/destroy/{id}', [ProductController::class, 'product_destroy'])->name('product.destroy');
    Route::delete('/product/image/remove/{id}', [ProductController::class, 'removeImage']);

    //brand route start
    Route::get('/brand/list', [BrandController::class, 'brandindex'])->name('brand.list');
    Route::get('/brand/create', [BrandController::class, 'brand_add'])->name('brand.create');
    Route::Post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
    Route::any('/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('brand.edit');
    Route::any('/brand/update/{id}', [BrandController::class, 'brand_update'])->name('brand.update');
    Route::any('/brand/delete/{id}', [BrandController::class, 'brand_delete'])->name('brand.delete');

    //orders route
    Route::get('/order/index', [OrdersController::class, 'order_index'])->name('order.index');
    Route::get('/order/show/{id}', [OrdersController::class, 'order_show'])->name('order.show');
    Route::post('/place-order', [OrdersController::class, 'store'])->name('place.order');
    Route::delete('/order/delete/{id}', [OrdersController::class, 'order_destroy'])->name('order.delete');
    Route::any('/order/download-Invoice/{id}', [OrdersController::class, 'downloadInvoice'])->name('downloal-invoice');


    //coupon routes
    Route::resource('coupons', CouponController::class);

    //shipping routes
    Route::resource('shippings', ShippingController::class);

 
    

    
});
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');









//frontend routes

Route::get('/trendora', [FrontendController::class, 'front_index'])->name('trendora');
Route::get('/trendora/about', [FrontendController::class, 'front_about'])->name('trendora.about');
Route::get('/trendora/shop', [FrontendController::class, 'front_shop'])->name('trendora.shop');
Route::get('/trendora/cart/{id}', [FrontendController::class, 'front_cart'])->name('trendora.cart');
// Route::get('/brand/list', [BrandController::class, 'brandindex'])->name('brand.list');



//cartcontroller routes
Route::any('/cart/add/{productId}', [CartController::class, 'cart_store'])->name('trendora.cart');
Route::any('/cart/update-all', [CartController::class, 'cart_update_all'])->name('cart.updateAll');
Route::delete('/cart/remove/{id}', [CartController::class, 'cart_destroy'])->name('cart.destroy');
Route::get('/cart/index', [CartController::class, 'cart_index'])->name('cart.index');
Route::get('/cart/checkout', [CartController::class, 'cart_checkout'])->name('cart.checkout');
Route::get('/cart/proceed-to-checkout', [CartController::class, 'proceedToCheckout'])->name('cart.proceedToCheckout');
Route::get('/search/cities', [CartController::class, 'searchCities'])->name('search.cities');
Route::get('/search/states', [CartController::class, 'searchStates'])->name('search.states');
