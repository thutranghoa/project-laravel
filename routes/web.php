<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\QuestionController;

Route::get('/', [QuizController::class, 'index']);

Route::resource('quizzes', QuizController::class);

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

    Route::get('/{exercise}/questions/search', [QuestionController::class, 'search'])->name('quizzes.exercises.questions.search');
});
