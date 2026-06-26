<?php

use App\Http\Controllers\VehicleManagement\VehicleController;
use App\Http\Controllers\VehicleManagement\VehicleUsageController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'access_permission'])->group(function () {

    Route::group(["controller" => VehicleController::class, "prefix" => "vehicle", "as" => "vehicle."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => VehicleUsageController::class, "prefix" => "vehicle-usage", "as" => "vehicle-usage."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
});
Route::group(["controller" => VehicleUsageController::class, "prefix" => "pricing", "as" => "pricing."], function () {
    Route::get('/', 'pricing')->name('pricing');
});
