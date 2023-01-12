<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\FrontendController;
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
});


Route::controller(FrontendController::class)->group(function(){
    Route::get('/', 'index');
});


// Route::get('/', function () {
//     return view('welcome');
// });
