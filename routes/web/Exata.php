<?php

use App\Http\Controllers\Exata\ExataAttachmentController;
use App\Http\Controllers\Exata\ExataController;
use App\Http\Controllers\Exata\ExataFormCandidateController;
use App\Http\Controllers\Exata\ExataHistoryFilePreviewController;
use App\Http\Controllers\Exata\ExataPermissionController;
use App\Http\Controllers\Exata\ExataPreviewCandidateController;
use App\Http\Controllers\MasterData\RegencyController;
use Illuminate\Support\Facades\Route;


Route::group(["controller" => ExataController::class, "prefix" => "exata", "as" => "exata."], function () {
    Route::get('{id}/edit', 'edit')->name('edit');
});
Route::group(["controller" => RegencyController::class, "prefix" => "public", "as" => "public."], function () {
    Route::get('/regency/get', 'search')->name('get.regency');
});
Route::group(["controller" => ExataFormCandidateController::class, "prefix" => "exata_form_candidate", "as" => "exata_form_candidate."], function () {
    Route::get('{id}/form', 'form')->name('form');
});

Route::get('/file/download/{path}', [ExataHistoryFilePreviewController::class, 'download'])
    ->name('file.download')
    ->middleware('signed')
    ->where('path', '.*');
Route::middleware(['auth', 'access_permission'])->group(function () {

    Route::group(["controller" => ExataController::class, "prefix" => "exata", "as" => "exata."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('pdf/view/{id}/{type}', 'view_pdf')->name('view_pdf');

        Route::get('/regency/get', [RegencyController::class, 'search'])->name('get.regency');
    });
    Route::group(["controller" => ExataPermissionController::class, "prefix" => "permission_exata", "as" => "permission_exata."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => ExataFormCandidateController::class, "prefix" => "exata_form_candidate", "as" => "exata_form_candidate."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => ExataHistoryFilePreviewController::class, "prefix" => "exata_history_file_preview", "as" => "exata_history_file_preview."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => ExataPreviewCandidateController::class, "prefix" => "exata_preview_candidate", "as" => "exata_preview_candidate."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => ExataAttachmentController::class, "prefix" => "exata_attachment", "as" => "exata_attachment."], function () {
        Route::get('{exata_id}/{type}', 'detail')->name('index');
    });
});
