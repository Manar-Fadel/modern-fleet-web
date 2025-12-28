<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarCategoryController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CarImageController;
use App\Http\Controllers\Admin\CarQuotationController;
use App\Http\Controllers\Admin\CarRequestController;
use App\Http\Controllers\Admin\CompanyUsersController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\HeavyVehicleCategoryController;
use App\Http\Controllers\Admin\HeavyVehicleImageController;
use App\Http\Controllers\Admin\HeavyVehicleQuotationController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\HeavyVehicleRequestController;
use App\Http\Controllers\Admin\HeavyVehicleController;
use App\Http\Controllers\Admin\QueueMonitorController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\web\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::middleware('localization')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'index'])->name('search');

    Route::get('/change-language', [HomeController::class, 'changeLanguage'])->name('change-language');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
    Route::post('/save-contact-us', [HomeController::class, 'saveContactUs'])->name('save-contact-us');

    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');




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

            Route::resource('cars', CarController::class);
            Route::post('car-images/{image}/set-main', [CarImageController::class, 'setMain'])->name('car-images.set-main');
            Route::delete('car-images/{image}', [CarImageController::class, 'destroy'])->name('car-images.destroy');
            Route::resource('car-categories', CarCategoryController::class)->except(['show']);
            Route::resource('car-quotations', CarQuotationController::class)->except(['show']);

            Route::resource('heavy-vehicles', HeavyVehicleController::class);
            Route::post('/heavy-vehicle-images/{image}/set-main', [HeavyVehicleImageController::class, 'setMain'])->name('heavy-vehicle-images.set-main');
            Route::resource('heavy-vehicle-categories', HeavyVehicleCategoryController::class)->except(['show']);
            Route::resource('heavy-vehicle-quotations', HeavyVehicleQuotationController::class)->except(['show']);


            Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
                Route::get('/', [BrandController::class, 'index'])->name('index');
                Route::get('/models/{id}', [BrandController::class, 'brandModels'])->name('brand-models');
                Route::post('/store', [BrandController::class, 'store'])->name('store');
                Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('delete');
                Route::get('/delete-model/{id}', [BrandController::class, 'deleteModel'])->name('delete-model');
                Route::post('/store-model', [BrandController::class, 'storeModel'])->name('store-model');
            });

            Route::group(['prefix' => 'companies', 'as' => 'companies.'], function () {
                Route::get('/', [CompanyUsersController::class, 'index'])->name('index');
                Route::post('/store', [CompanyUsersController::class, 'store'])->name('store');
                Route::post('/update/{id}', [CompanyUsersController::class, 'update'])->name('update');
                Route::get('/view/{id}', [CompanyUsersController::class, 'view'])->name('view');
                Route::get('/delete/{id}', [CompanyUsersController::class, 'delete'])->name('delete');
            });
            Route::group(['prefix' => 'individuals', 'as' => 'individuals.'], function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
                Route::get('/view/{id}', [UserController::class, 'view'])->name('view');
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
            });

            Route::group(['prefix' => 'heavy-vehicle-orders', 'as' => 'heavy-vehicle-orders.'], function () {
                Route::get('/', [HeavyVehicleRequestController::class, 'index'])->name('index');
            });
            Route::group(['prefix' => 'car-orders', 'as' => 'car-orders.'], function () {
                Route::get('/', [CarRequestController::class, 'index'])->name('index');
            });

            Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
                Route::get('/', [SettingsController::class, 'index'])->name('index');
                Route::post('/update', [SettingsController::class, 'update'])->name('update');

                Route::get('/list', [SettingsController::class, 'list'])->name('list');
                Route::get('/delete/{id}', [SettingsController::class, 'delete'])->name('delete');
            });

            Route::group(['prefix' => 'queue-monitor', 'as' => 'queue-monitor.'], function () {
                Route::get('/', [QueueMonitorController::class, 'index'])->name('index');
                Route::get('/{monitor}', [QueueMonitorController::class, 'show'])->name('show');
                Route::post('/{monitor}/retry', [QueueMonitorController::class, 'retry'])->name('retry');
                Route::delete('/{monitor}', [QueueMonitorController::class, 'destroy'])->name('delete');
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
