<?php

use App\Http\Controllers\API\{
    AddressController,
    AuthController, CartController, CourierController, OrderController, PaymentController as APIPaymentController, ProductController, ProfileController, WilayahController,
    WishlistController
};
use App\Http\Controllers\Frontend\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('carts', CartController::class);
    Route::get('products/popular', [ProductController::class, 'popular']);
    Route::get('products/for-you', [ProductController::class, 'forYou']);
    Route::resource('products', ProductController::class);
    Route::resource('wishlists', WishlistController::class);
    Route::resource('payments', APIPaymentController::class);
    Route::post('couriers/check', [CourierController::class, 'check']);
    Route::resource('couriers', CourierController::class);
    Route::resource('address', AddressController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('profile', ProfileController::class);
});


Route::controller(WilayahController::class)->name('api.')->group(function(){
    Route::get('regencies/{province_id}', 'regencies')->name('regencies');
    Route::get('districts/{regency_id}', 'districts')->name('districts');
    Route::get('villages/{district_id}', 'villages')->name('villages');
});

Route::post('login', [AuthController::class, 'login']);


Route::post('payment/callback', [PaymentController::class, 'callback']);

