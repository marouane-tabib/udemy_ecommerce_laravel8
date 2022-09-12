<?php

use App\Http\Controllers\Back\BackController;
use App\Http\Controllers\Back\CustomerController;
use App\Http\Controllers\Back\CustomerAddressController;
use App\Http\Controllers\Back\ProductCategoriesController;
use App\Http\Controllers\Back\ProductController;
use App\Http\Controllers\Back\ProductCouponController;
use App\Http\Controllers\Back\ProductReviewController;
use App\Http\Controllers\Back\SupervisorController;
use App\Http\Controllers\Back\TagController;
use App\Http\Controllers\Back\CountryController;
use App\Http\Controllers\Back\StateController;
use App\Http\Controllers\Back\CityController;
use App\Http\Controllers\Front\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [FrontendController::class , 'index'])->name('front.index');
Route::get('/cart', [FrontendController::class , 'cart'])->name('front.cart');
Route::get('/checkout', [FrontendController::class , 'checkout'])->name('front.checkout');
Route::get('/detail', [FrontendController::class , 'detail'])->name('front.detail');
Route::get('/shop', [FrontendController::class , 'shop'])->name('front.shop');

Route::group(['prefix' => 'admin' , 'as' => 'admin.'] ,  function(){
    Route::group(['middleware' => 'guest'] , function (){
        Route::get('/login', [BackController::class , 'login'])->name('login');
        Route::get('/forgot-password', [BackController::class , 'forgot_password'])->name('forgot_password');
    });
    Route::group(['middleware' => ['roles' , 'role:admin|supervisor']] , function (){
        // Route::get('/', [BackController::class , 'index'])->name('route_index');
        Route::get('/index', [BackController::class , 'index'])->name('index');

        Route::resource('product_categories' , ProductCategoriesController::class);
        Route::post('/product_categories/remove-image' , [ProductCategoriesController::class , 'remove_image'])->name('product_categories.remove_image');
        Route::resource('products' , ProductController::class);
        Route::post('/products/remove-image' , [ProductController::class , 'remove_image'])->name('products.remove_image');
        Route::resource('tags' , TagController::class);
        Route::resource('product_coupons' , ProductCouponController::class);
        Route::resource('product_reviews' , ProductReviewController::class);

        Route::resource('customers' , CustomerController::class);
        Route::post('/customers/remove-image' , [CustomerController::class , 'remove_image'])->name('customers.remove_image');
        Route::post('/customers/get_customers' , [CustomerController::class , 'get_customers'])->name('customers.get_customers');
        Route::resource('customer_address' , CustomerAddressController::class);

        Route::resource('supervisors' , SupervisorController::class);
        Route::post('/supervisors/remove-image' , [SupervisorController::class , 'remove_image'])->name('supervisors.remove_image');
        
        Route::resource('countries' , CountryController::class);
        Route::resource('states' , StateController::class);
        Route::resource('cities' , CityController::class);
    });
});
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
