<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhiemController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('test')->group(function(){
    Route::get('index', [KhiemController::class, 'showdata'])->name('showdata.get');
    Route::get('them_data', [KhiemController::class, 'themdulieu_get'])->name('themdulieu.get');
    Route::post('them_data', [KhiemController::class, 'themdulieu_post'])->name('themdulieu.post');

    Route::get('sua_data/{id}', [KhiemController::class, 'suadulieu_get'])->name('suadulieu.get');
    Route::post('sua_data/{id}', [KhiemController::class, 'suadulieu_post'])->name('suadulieu.post');

    Route::post('xoa_data/{id}', [KhiemController::class, 'xoadulieu'])->name('xoadulieu.post');
});

require __DIR__.'/auth.php';
