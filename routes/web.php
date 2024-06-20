<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\ExerciseController;
use App\Http\Controllers\Admin\QuestionController;



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

        Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes');
        Route::get('/create-quiz', [QuizController::class, 'create'])->name('quizzes.create'); // Correct route definition
        Route::post('/store-quiz', [QuizController::class, 'store'])->name('quizzes.store');
        Route::get('/edit-quiz/{id}', [QuizController::class, 'edit'])->name('quizzes.edit');
        Route::put('/update-quiz/{id}', [QuizController::class, 'update'])->name('quizzes.update');
        Route::delete('/delete-quiz/{id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');



        Route::prefix('quizzes/{quiz}/exercises')->group(function () {
            Route::get('/', [ExerciseController::class, 'index'])->name('quizzes.exercises.index');
            Route::get('/create', [ExerciseController::class, 'create'])->name('quizzes.exercises.create');
            Route::post('/', [ExerciseController::class, 'store'])->name('quizzes.exercises.store');
            Route::get('/{exercise}', [ExerciseController::class, 'show'])->name('quizzes.exercises.show');
            Route::get('/{exercise}/edit', [ExerciseController::class, 'edit'])->name('quizzes.exercises.edit');
            Route::put('/{exercise}', [ExerciseController::class, 'update'])->name('quizzes.exercises.update');
            Route::delete('/{exercise}', [ExerciseController::class, 'destroy'])->name('quizzes.exercises.destroy');
        
            Route::get('/{exercise}/questions', [QuestionController::class, 'index'])->name('quizzes.exercises.questions.index');
            Route::get('/{exercise}/questions/create', [QuestionController::class, 'create'])->name('quizzes.exercises.questions.create');
            Route::post('/{exercise}/questions', [QuestionController::class, 'store'])->name('quizzes.exercises.questions.store');
            Route::get('/{exercise}/questions/{question}', [QuestionController::class, 'show'])->name('quizzes.exercises.questions.show');
            Route::get('/{exercise}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('quizzes.exercises.questions.edit');
            Route::put('/{exercise}/questions/{question}', [QuestionController::class, 'update'])->name('quizzes.exercises.questions.update');
            Route::delete('/{exercise}/questions/{question}', [QuestionController::class, 'destroy'])->name('quizzes.exercises.questions.destroy');
        });
    });

});

// Route::get('/', [QuizController::class, 'index']);

// Route::resource('quizzes', QuizController::class);

// Route::prefix('quizzes/{quiz}/exercises')->group(function () {
//     Route::get('/', [ExerciseController::class, 'index'])->name('quizzes.exercises.index');
//     Route::get('/create', [ExerciseController::class, 'create'])->name('quizzes.exercises.create');
//     Route::post('/', [ExerciseController::class, 'store'])->name('quizzes.exercises.store');
//     Route::get('/{exercise}', [ExerciseController::class, 'show'])->name('quizzes.exercises.show');
//     Route::get('/{exercise}/edit', [ExerciseController::class, 'edit'])->name('quizzes.exercises.edit');
//     Route::put('/{exercise}', [ExerciseController::class, 'update'])->name('quizzes.exercises.update');
//     Route::delete('/{exercise}', [ExerciseController::class, 'destroy'])->name('quizzes.exercises.destroy');

//     Route::get('/{exercise}/questions', [QuestionController::class, 'index'])->name('quizzes.exercises.questions.index');
//     Route::get('/{exercise}/questions/create', [QuestionController::class, 'create'])->name('quizzes.exercises.questions.create');
//     Route::post('/{exercise}/questions', [QuestionController::class, 'store'])->name('quizzes.exercises.questions.store');
//     Route::get('/{exercise}/questions/{question}', [QuestionController::class, 'show'])->name('quizzes.exercises.questions.show');
//     Route::get('/{exercise}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('quizzes.exercises.questions.edit');
//     Route::put('/{exercise}/questions/{question}', [QuestionController::class, 'update'])->name('quizzes.exercises.questions.update');
//     Route::delete('/{exercise}/questions/{question}', [QuestionController::class, 'destroy'])->name('quizzes.exercises.questions.destroy');
// });