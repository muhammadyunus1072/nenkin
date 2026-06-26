<?php

use App\Http\Controllers\ConvertDataIchijikinController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'access_permission'])->group(function () {

    Route::group(["controller" => ConvertDataIchijikinController::class, "prefix" => "convert-data-ichijikin", "as" => "convert-data-ichijikin."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
});
