<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\DB;



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
Route::get('/check-database', function () {
    return DB::connection()->getDatabaseName();
});

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

require __DIR__.'/auth.php';

// Admin

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route :: namespace ('Auth')->middleware('guest:admin')->group(function (){
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']) ->name('adminlogin');
        
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        //Students Routes
        Route::get('/students', [StudentController::class, 'index'])->name('students');
        Route::post('/add-student', [StudentController::class, 'addStudent'])->name('addStudent');
        Route::post('/edit-student', [StudentController::class, 'editStudent'])->name('editStudent');
        Route::post('/delete-student', [StudentController::class, 'deleteStudent'])->name('deleteStudent');
        Route::get('/search-student', [StudentController::class, 'searchStudents'])->name('searchStudents');

        Route::get('/student-results', [ResultController::class, 'index'])->name('studentResults');
        Route :: get ('/delete-result', [ResultController::class, 'deleteResult'])->name('deleteResult');

        // Subjects Routes
        Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects');
        Route::post('/add-subject', [SubjectController::class, 'addSubject'])->name('addSubject');
        Route::post('/edit-subject', [SubjectController::class, 'editSubject'])->name('editSubject');
        Route::post('/delete-subject', [SubjectController::class, 'deleteSubject'])->name('deleteSubject');

        Route::get('/search-subject', [SubjectController::class, 'searchSubjects'])->name('searchSubjects');
    
    });
   
});