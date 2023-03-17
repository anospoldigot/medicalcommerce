<?php

use App\Http\Controllers\Frontend\{
    AuthController,
    CategoryProductController,
    CategoryController,
    DuitkuController,
    BroadcastController,
    AboutController,
    AddressController,
    ArticleController,
    ProductController,
    CartController,
    ChatController,
    ContactController,
    CouponController,
    OrderController,
    PaymentController,
    ProfileController,
    ShipperController
};
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Payment\{
    CancelPayment, ChargeCreditCard, CheckPayment, RequestCPay, RequestCVS, RequestEWallet,
    RequestVA
};
use App\Mail\ExceptionMail;
use App\Mail\ExceptionOccured;
use App\Mail\test;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

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
    Route::get('/auth/google', 'authGoogle');
    Route::get('/callback/google', 'callbackGoogle');
    Route::get('/auth/facebook', 'authFacebook');
    Route::get('/callback/facebook', 'callbackFacebook');
    Route::get('/auth/twitter', 'authTwitter');
    Route::get('/callback/twitter', 'callbackTwitter');
});


Route::controller(AdminAuthController::class)->prefix('admin')->group(function () {
    Route::get('login', 'login')->name('admin.login');
    Route::post('login', 'loginPost')->name('admin.loginPost');
});


Route::controller(FrontendController::class)->group(function(){
    Route::get('/', 'index')->name('landing');
    // Route::get('product', 'product')->name('product');
    // Route::get('product/{product:slug}', 'product_detail')->name('product_detail');
    // Route::get('cart', 'cart')->name('cart');
});
 
Route::name('fe.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories.products', CategoryProductController::class);
    Route::get('carts/count', [CartController::class, 'count'])->name('carts.count')->middleware('auth');
    Route::resource('carts', CartController::class)->middleware('auth');
    Route::resource('addresses', AddressController::class)->middleware('auth');
    // Route::resource('shipping', ShipperController::class)->middleware('auth');
    Route::post('shipping/check', [ShipperController::class, 'check'])->name('shipping.check')->middleware('auth');
    Route::get('shipping/couriers', [ShipperController::class, 'couriers'])->name('shipping.couriers')->middleware('auth');
    Route::post('payment/checkout', [PaymentController::class, 'checkout']);
    Route::resource('payment', PaymentController::class);
    Route::resource('chats', ChatController::class);
    Route::resource('contact', ContactController::class)->only(['index', 'store']);
    Route::resource('about', AboutController::class)->only(['index']);
    Route::resource('profile', ProfileController::class)->only(['index']);
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('orders', OrderController::class);
    Route::resource('articles', ArticleController::class);
    Route::post('coupons/check', [CouponController::class, 'check'])->name('coupons.check');
    Route::resource('coupons', CouponController::class);
});



Route::get('/testing', function () {
    
});
