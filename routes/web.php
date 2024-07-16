<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $visitorCountry = $_SERVER["HTTP_CF_IPCOUNTRY"] ?? null; // Get the visitor's country from Cloudflare (or null if not available)

    if ($visitorCountry === 'TR') { // 'TR' is the ISO code for Turkey
        return redirect('https://www.alsahabapp.com/en/category/shop');
    }

    return redirect(app()->getLocale());
});
//  I commit this route page because later , we will use it
// Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale','check-ip'], function () {
    Auth::routes();
    Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'home'])->name('home');
    Route::get('/category/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'category'])->name('category');
    Route::get('/product/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'product']);
    Route::get('/blogs', [App\Http\Controllers\Frontend\IndexController::class, 'blogs'])->name('blogs');
    Route::get('/blog-detail/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'blogDetail']);
    Route::get('/page/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'page']);
    // service 
    Route::get('/services', [App\Http\Controllers\Frontend\IndexController::class, 'services']);

    Route::get('/service/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'service']);
    // Authentications 
    Route::match(['post', 'get'], 'user/login', [App\Http\Controllers\Frontend\UserController::class, 'login'])->name('user.login');

    // Cart Section 
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'cart'])->name('cart');
     Route::post('cart/delete', [App\Http\Controllers\Frontend\CartController::class, 'cartDelete'])->name('cart.delete');
    Route::post('cart/store', [App\Http\Controllers\Frontend\CartController::class, 'cartStore'])->name('cart.store');
    Route::post('cart/update', [App\Http\Controllers\Frontend\CartController::class, 'cartUpdate'])->name('cart.update');

    // Checkout Section 
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('checkout/store', [App\Http\Controllers\Frontend\CheckoutController::class, 'checkoutStore'])->name('checkout.store');
    Route::get('complete', [App\Http\Controllers\Frontend\CheckoutController::class, 'complete'])->name('complete');


    //  Shop
    Route::get('shop', [App\Http\Controllers\Frontend\IndexController::class, 'shop'])->name('shop');
    Route::post('shop-filter', [App\Http\Controllers\Frontend\IndexController::class, 'shopFilter'])->name('shop.filter');
    Route::match(['get', 'post'], 'search', [App\Http\Controllers\Frontend\IndexController::class, 'search'])->name('search');
    Route::post('show', [App\Http\Controllers\Frontend\IndexController::class, 'showProduct'])->name('product.detail');
    Route::match(['get', 'post'], 'contact', [App\Http\Controllers\Frontend\IndexController::class, 'contact'])->name('contact');

    // add site map 
    Route::get('sitemap', [App\Http\Controllers\Frontend\IndexController::class, 'siteMap']);

    // generate thumbNail
    Route::get('generate-thumbs', [App\Http\Controllers\Frontend\IndexController::class, 'generateThumbnails']);
    Route::get('generate-thumbs-banner', [App\Http\Controllers\Frontend\IndexController::class, 'generateBannerImage']);

    
    // apply applyCoupon
    Route::post('apply-coupon', [App\Http\Controllers\Frontend\CartController::class, 'applyCoupon'])->name('apply-coupon');
});

// Admin Dashboard
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

    //  Banner Management
    Route::resource('/banner', App\Http\Controllers\BannerController::class);
    Route::post('banner_status', [App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');
    //  Blog Management
    Route::resource('/blog', App\Http\Controllers\BlogController::class);
    Route::post('blog_status', [App\Http\Controllers\BlogController::class,'blogStatus'])->name('blog.status');
    //  Category Management
    Route::resource('/category', App\Http\Controllers\CategoryController::class);
    Route::post('category_status', [App\Http\Controllers\CategoryController::class, 'categoryStatus'])->name('category.status');
    Route::post('category/{id}/child', [App\Http\Controllers\CategoryController::class, 'getChildByParentId']);
    //  Product Management
    Route::resource('/product', App\Http\Controllers\ProductController::class);
    Route::post('product_status', [App\Http\Controllers\ProductController::class, 'productStatus'])->name('product.status');
    Route::post('show', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
    //  User Management
    Route::resource('/user', App\Http\Controllers\UserController::class);
    Route::post('user_status', [App\Http\Controllers\UserController::class, 'userStatus'])->name('user.status');
    // Route::post('show', [App\Http\Controllers\UserController::class, 'show'])->name('product.show');
    //  Page Management
    Route::resource('/page', App\Http\Controllers\PageController::class);
    Route::post('page_status', [App\Http\Controllers\PageController::class, 'pageStatus'])->name('page.status');
    //  language Management
    Route::resource('/language', App\Http\Controllers\LanguageController::class);
    //  setting Management
    Route::resource('/setting', App\Http\Controllers\SettingController::class);
    //  cart Management
    Route::post('order/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');
    Route::resource('/order/{status}/', App\Http\Controllers\OrderController::class);
    Route::post('order-detail', [App\Http\Controllers\OrderController::class, 'show'])->name('order.detail');
    Route::post('order-status', [App\Http\Controllers\OrderController::class, 'orderStatus'])->name('order.status');
    //  Brand Management
    Route::resource('/brand', App\Http\Controllers\BrandController::class);
    Route::post('brand_status', [App\Http\Controllers\BrandController::class, 'brandStatus'])->name('brand.status');
    //  Service Management
    Route::resource('/service', App\Http\Controllers\ServiceController::class);
    Route::post('service_status', [App\Http\Controllers\ServiceController::class, 'serviceStatus'])->name('service.status');
    Route::post('service/{id}/child', [App\Http\Controllers\ServiceController::class, 'getChildByParentId']);
    //  properties Management
    Route::resource('/properties', App\Http\Controllers\PropertyController::class);
    Route::post('property_status', [App\Http\Controllers\PropertyController::class, 'propertyStatus'])->name('property.status');

    //  coupons Management
    Route::resource('/discounts', App\Http\Controllers\DiscountController::class);
    Route::post('discounts-status', [App\Http\Controllers\DiscountController::class, 'discountStatus'])->name('discounts.status');
     //  offers Management
     Route::resource('/offer', App\Http\Controllers\OfferController::class);
     Route::post('offer-status', [App\Http\Controllers\OfferController::class, 'offerStatus'])->name('offer.status');
});

Route::get('/view-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return '<h1>View cache cleared</h1>';
});
