<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DuitkuController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ChatController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ShipperController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Payment\{
    CancelPayment, ChargeCreditCard, CheckPayment, RequestCPay, RequestCVS, RequestEWallet,
    RequestVA
};

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


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/my_account', 'myAccount')->name('myAccount');
    Route::patch('/user', 'update')->name('user.update');
    Route::post('/login', 'loginPost')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerPost')->name('register.post');
    Route::get('/email/verify', 'verify')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resendVerify')
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
});


Route::controller(FrontendController::class)->group(function(){
    Route::get('/', 'index')->name('landing');
    // Route::get('product', 'product')->name('product');
    // Route::get('product/{product:slug}', 'product_detail')->name('product_detail');
    // Route::get('cart', 'cart')->name('cart');
});
 
Route::name('fe.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('carts', CartController::class)->middleware('auth');
    Route::resource('addresses', AddressController::class)->middleware('auth');
    // Route::resource('shipping', ShipperController::class)->middleware('auth');
    Route::get('shipping/check', [ShipperController::class, 'check'])->name('shipping.check')->middleware('auth');
    Route::get('payment/callback', [PaymentController::class, 'callback']);
    Route::post('payment/checkout', [PaymentController::class, 'checkout']);
    Route::resource('payment', PaymentController::class);
    Route::resource('chats', ChatController::class);
    Route::resource('contact', ContactController::class)->only(['index', 'store']);
    Route::resource('orders', OrderController::class);
    Route::resource('articles', ArticleController::class);
    Route::get('duitku', [DuitkuController::class, 'index'])->name('duitku.index');
    Route::post('coupons/check', [CouponController::class, 'check'])->name('coupons.check');
    Route::resource('coupons', CouponController::class);
});



// Route::get('/', function () {
//     return view('welcome');
// });
