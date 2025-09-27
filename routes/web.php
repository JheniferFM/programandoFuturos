<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;


Route::get('/', function () {
    return view('home'); // carrega resources/views/home.blade.php
})->name('home');

Route::get('/teste', function() {
    return view('test');
});

// Trilhas
Route::get('/trilhas/frontend', function() {
    return view('trilhas.frontend');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Cadastro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Quiz routes
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/question/{step}', [QuizController::class, 'showQuestion'])->name('quiz.question');
Route::post('/quiz/question/{step}', [QuizController::class, 'submitAnswer'])->name('quiz.submit');
Route::get('/quiz/results', [QuizController::class, 'showResults'])->name('quiz.results');
Route::post('/quiz/reset', [QuizController::class, 'resetQuiz'])->name('quiz.reset');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Dashboard gamificado
    Route::get('/dashboard', function() {
        return view('dashboard.index');
    })->name('dashboard');
    

});
