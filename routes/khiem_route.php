<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhiemController;


Route::prefix('test')->group(function(){
    Route::get('index', [KhiemController::class, 'showdata'])->name('showdata.get');
    Route::get('them_data', [KhiemController::class, 'themdulieu_get'])->name('themdulieu.get');
    Route::post('them_data', [KhiemController::class, 'themdulieu_post'])->name('themdulieu.post');

    Route::get('sua_data/{id}', [KhiemController::class, 'suadulieu_get'])->name('suadulieu.get');
    Route::post('sua_data/{id}', [KhiemController::class, 'suadulieu_post'])->name('suadulieu.post');

    Route::delete('xoa_data/{id}', [KhiemController::class, 'xoadulieu'])->name('xoadulieu.post');

});