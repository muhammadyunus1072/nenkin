<?php

use App\Http\Controllers\MasterData\RegencyController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'access_permission'])->group(function () {

    Route::group(["controller" => RegencyController::class, "prefix" => "regency", "as" => "regency."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
});
