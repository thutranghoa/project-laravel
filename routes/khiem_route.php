<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhiemController;
use App\Http\Controllers\AnController;


Route::prefix('test')->group(function(){
    Route::get('index', [KhiemController::class, 'showdata'])->name('showdata.get');
    Route::get('them_data', [KhiemController::class, 'themdulieu_get'])->name('themdulieu.get');
    Route::post('them_data', [KhiemController::class, 'themdulieu_post'])->name('themdulieu.post');

    Route::get('sua_data/{id}', [KhiemController::class, 'suadulieu_get'])->name('suadulieu.get');
    Route::post('sua_data/{id}', [KhiemController::class, 'suadulieu_post'])->name('suadulieu.post');

    Route::delete('xoa_data/{id}', [KhiemController::class, 'xoadulieu'])->name('xoadulieu.post');

});

Route::get('/danh_sach_mon_hoc', [KhiemController::class, 'listmonhoc'])->middleware(['auth', 'verified'])->name('monhoc.show');
Route::prefix('lam_bai')->group(function(){

    Route::get('/danh_sach_bai_hoc/{id_mon}', [KhiemController::class, 'listbaihoc'])->middleware(['auth', 'verified'])->name('baihoc.show');

    
    Route::get('/quiz/{id_mon}/{ma_de}', [KhiemController::class, 'showQuestions'])->middleware(['auth', 'verified'])->name('quiz.show');
    Route::post('/quiz/{id_exercise}', [KhiemController::class, 'submitAnswers'])->middleware(['auth', 'verified'])->name('quiz.submit');



    Route::get('/lich_su_chi_tiet/{exam_historie_id}/{exercise_name}', [KhiemController::class, 'historical_details'])->middleware(['auth', 'verified'])->name('historicaldetails.show');


    Route::get('/bai_thi_vip', [KhiemController::class, 'baithichovip'])->middleware(['auth', 'verified','checkvip'])->name('baihocvip.show');

    Route::post('/thanh_toan_vnpay', [KhiemController::class, 'thanhtoanvnpay'])->middleware(['auth', 'verified'])->name('thanhtoan.submit');

    Route::get('/thanh_toan_thanh_cong', [KhiemController::class, 'thanhtoanthanhcong'])->middleware(['auth', 'verified'])->name('thanhtoanthanhcong.show');
});

Route::prefix('vip')->group(function(){

    Route::get('/danh_sach_bai_nghe/{id_mon}', [KhiemController::class, 'listbainghe'])->middleware(['auth', 'verified', 'checkvip'])->name('bainghe.show');
    Route::get('/quiz_audio/{id_mon}/{ma_de}/{id_audio}', [KhiemController::class, 'show_question_audio'])->middleware(['auth', 'verified', 'checkvip'])->name('quiznghe.show');


});






Route::prefix('them_bai')->group(function(){
    Route::get('/danh_sach_mon_hoc', [AnController::class, 'listmonhoc'])->name('admin.monhoc.show');

    Route::get('/them_bai_thi/{id_mon}', [AnController::class, 'thembaithiget'])->name('admin.thembaihoc.show');
    Route::post('/them_bai_thi', [AnController::class, 'submitBaiThi'])->name('admin.thembaihoc.submit');
});