<?php

use App\Http\Controllers\Admin\{
    AuthController,
    ProductController,
    DashboardController,
    CategoryController,
    PostController,
    SettingWebController,
    ShippingController,
    StoreController
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
    Route::post('/login', 'loginPost')->name('login.post');
});


Route::middleware([])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::controller(SettingWebController::class)->prefix('setting')->group(function () {
        Route::get('web', 'index')->name('setting.web');
        Route::patch('web', 'update')->name('setting.web.update');
    });
    Route::controller(StoreController::class)->prefix('setting')->group(function () {
        Route::get('store', 'index')->name('setting.store');
        Route::patch('store', 'update')->name('setting.store.update');
    });
    Route::apiResources([
        'category' => CategoryController::class,
    ]);
    Route::resources([
        'post' => PostController::class,
        'product' => ProductController::class
    ]);
});

Route::get('shipping/get_province', [ShippingController::class, 'getProvince'])->name('getProvince');
Route::get('shipping/get_city/{province_id}', [ShippingController::class, 'getCity'])->name('getCity');
Route::get('shipping/get_subdistict/{city_id}', [ShippingController::class, 'getSubdistrict']);
Route::post('shipping/get_cost', [ShippingController::class, 'getCost']);
?>
