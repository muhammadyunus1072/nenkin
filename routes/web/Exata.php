<?php

use App\Http\Controllers\Exata\ExataController;
use App\Http\Controllers\Exata\ExataPermissionController;
use App\Http\Controllers\MasterData\RegencyController;
use Illuminate\Support\Facades\Route;


Route::group(["controller" => ExataController::class, "prefix" => "exata", "as" => "exata."], function () {
    Route::get('{id}/edit', 'edit')->name('edit');
});
Route::middleware(['auth', 'access_permission'])->group(function () {

    Route::group(["controller" => ExataController::class, "prefix" => "exata", "as" => "exata."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');

        Route::get('/regency/get', [RegencyController::class, 'search'])->name('get.regency');
    });
    Route::group(["controller" => ExataPermissionController::class, "prefix" => "permission_exata", "as" => "permission_exata."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
});
