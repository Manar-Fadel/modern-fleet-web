<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OurHeavyVehiclesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::middleware('localization')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'index'])->name('login');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');
            Route::get('/activate-email/{id}', [UserController::class, 'activateEmail'])->name('activate-email');
            Route::get('/activate-account/{id}', [UserController::class, 'activateAccount'])->name('activate-account');

            Route::group(['prefix' => 'logs', 'as' => 'logs.'], function () {
                Route::get('/', [IndexController::class, 'logs'])->name('index');
            });

            Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
                Route::get('/', [ContactController::class, 'index'])->name('index');
                Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('delete');
            });

            Route::group(['prefix' => 'cars', 'as' => 'cars.'], function () {
                Route::get('/', [OurHeavyVehiclesController::class, 'index'])->name('index');
                Route::get('/slider', [OurHeavyVehiclesController::class, 'slider'])->name('slider');
                Route::get('/news', [OurHeavyVehiclesController::class, 'news'])->name('news');
                Route::post('/store', [OurHeavyVehiclesController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [OurHeavyVehiclesController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [OurHeavyVehiclesController::class, 'update'])->name('update');
                Route::get('/delete-slider/{id}', [OurHeavyVehiclesController::class, 'deleteSlider'])->name('delete-slider');
                Route::get('/delete/{id}', [OurHeavyVehiclesController::class, 'delete'])->name('delete');
            });

            Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
                Route::get('/', [OrderController::class, 'index'])->name('index');
                Route::get('/export', [OrderController::class, 'export'])->name('export');
            });

            Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
                Route::get('/', [OfferController::class, 'index'])->name('index');
            });

            Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
                Route::get('/', [BrandController::class, 'index'])->name('index');
                Route::get('/models/{id}', [BrandController::class, 'brandModels'])->name('brand-models');
                Route::post('/store', [BrandController::class, 'store'])->name('store');
                Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('delete');
                Route::get('/delete-model/{id}', [BrandController::class, 'deleteModel'])->name('delete-model');
                Route::post('/store-model', [BrandController::class, 'storeModel'])->name('store-model');
            });

            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/enable-trusted/{id}', [UserController::class, 'enableTrusted'])->name('enable-trusted');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
                Route::get('/view/{id}', [UserController::class, 'view'])->name('view');
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
            });

            Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
                Route::get('/', [SettingsController::class, 'index'])->name('index');
                Route::post('/update', [SettingsController::class, 'update'])->name('update');

                Route::get('/list', [SettingsController::class, 'list'])->name('list');
                Route::get('/delete/{id}', [SettingsController::class, 'delete'])->name('delete');
            });

            Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {
                Route::get('/', [NotificationController::class, 'index'])->name('index');
                Route::get('/delete/{id}', [NotificationController::class, 'delete'])->name('delete');
            });

        });

    });
});



Route::get('/unlink-storage', function () {
    $exitCode = Artisan::call('storage:unlink');
    if ($exitCode === 0) {
        return "Storage symbolic link successfully unlinked.";
    } else {
        return "Failed to unlink storage symbolic link.";
    }
});
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear'); // Clears all cached optimizations
    return 'Cache cleared!';
});
