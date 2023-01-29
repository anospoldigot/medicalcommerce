<?php

use App\Http\Controllers\Admin\{
    AuthController,
    ProductController,
    DashboardController,
    CategoryController,
    DuitkuController,
    OrderController,
    PostController,
    SettingWebController,
    ShippingController,
    StoreController,
    TransactionController
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




Route::get('test', [DuitkuController::class, 'index']);
Route::get('test2', [DuitkuController::class, 'test2']);
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
    Route::controller(TransactionController::class)->group(function () {
        Route::get('transactions', 'index')->name('transaction.index');
    });
    
    Route::delete('orders/{id}', [OrderController::class, 'destroy']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('searchAdminOrder', [OrderController::class, 'searchAdminOrder']);
    Route::put('orders', [OrderController::class, 'update']);
    Route::post('filterOrder', [OrderController::class, 'filterOrder']);
    Route::post('updateStatusOrder', [OrderController::class, 'updateStatusOrder']);

    Route::post('paymentAccepted/{id}', [OrderController::class, 'paymentAccepted']);
    Route::post('inputResi', [OrderController::class, 'inputResi']);


    // Ajax CRUD
    Route::apiResources([
        'category' => CategoryController::class,
        'chats'     => ChatController::class
    ]);

    //CRUD
    Route::resources([
        'post'      => PostController::class,
        'product'   => ProductController::class,
    ]);
    
    Route::post('post/assets', [PostController::class, 'storeAssets'])->name('post.storeAssets');
    Route::delete('post/assets', [PostController::class, 'destroyAssets'])->name('post.destroyAssets');
});

Route::get('shipping/get_province', [ShippingController::class, 'getProvince'])->name('getProvince');
Route::get('shipping/get_city/{province_id}', [ShippingController::class, 'getCity'])->name('getCity');
Route::get('shipping/get_subdistict/{city_id}', [ShippingController::class, 'getSubdistrict']);
Route::post('shipping/get_cost', [ShippingController::class, 'getCost']);
?>
