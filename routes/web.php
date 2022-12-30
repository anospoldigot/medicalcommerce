<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingWebController;
use App\Http\Controllers\ShippingController;
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


Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'login');
    Route::post('/login', 'loginPost')->name('login.post');
});


Route::middleware('auth')->group(function(){
    Route::get('dashboard', DashboardController::class);
    Route::controller(SettingWebController::class)->group(function(){
        Route::get('config', 'index')->name('setting.web');
        Route::patch('config', 'update')->name('setting.web.update');
    });
});

Route::get('shipping/getProvince', [ShippingController::class, 'getProvince']);
Route::get('shipping/getCity/{province_id}', [ShippingController::class, 'getCity']);
Route::get('shipping/getSubdistict/{city_id}', [ShippingController::class, 'getSubdistrict']);
Route::post('shipping/getCost', [ShippingController::class, 'getCost']);


Route::get('/', function () {
    return view('welcome');
});
