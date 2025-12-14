<?php

use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\CarRequestsController;
use App\Http\Controllers\Api\Admin\HeavyVehicleRequestsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/***********************     ADMIN          ***************************/
Route::prefix('admin')->group(function () {
    Route::post('/brands', [BrandController::class, 'store']);
    Route::post('/brands/{id}', [BrandController::class, 'update']);
    Route::delete('/brands/{id}', [BrandController::class, 'destroy']);

    Route::group(['prefix' => 'car-requests', 'as' => 'car-requests.'], function () {
        Route::get('/', [CarRequestsController::class, 'index'])->name('index');
        Route::post('/update/{id}', [CarRequestsController::class, 'update'])->name('update');
        Route::post('/change-status/{id}', [CarRequestsController::class, 'changeStatus'])->name('changeStatus');
        Route::get('/delete/{id}', [CarRequestsController::class, 'delete'])->name('delete');
        Route::get('/delete-image/{id}', [CarRequestsController::class, 'deleteImage'])->name('deleteImage');
        Route::get('/images/{id}', [CarRequestsController::class, 'orderImages'])->name('orderImages');
        Route::get('/offers/{id}', [CarRequestsController::class, 'offers'])->name('offers');
    });

    Route::group(['prefix' => 'heavy-vehicle-requests', 'as' => 'car-requests.'], function () {
        Route::get('/', [HeavyVehicleRequestsController::class, 'index'])->name('index');
        Route::post('/update/{id}', [HeavyVehicleRequestsController::class, 'update'])->name('update');
        Route::post('/change-status/{id}', [HeavyVehicleRequestsController::class, 'changeStatus'])->name('changeStatus');
        Route::get('/delete/{id}', [HeavyVehicleRequestsController::class, 'delete'])->name('delete');
        Route::get('/delete-image/{id}', [HeavyVehicleRequestsController::class, 'deleteImage'])->name('deleteImage');
        Route::get('/images/{id}', [HeavyVehicleRequestsController::class, 'orderImages'])->name('orderImages');
        Route::get('/offers/{id}', [HeavyVehicleRequestsController::class, 'offers'])->name('offers');
    });


});

