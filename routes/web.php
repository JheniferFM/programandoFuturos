<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('home'); // carrega resources/views/home.blade.php
});

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

// Rotas do Questionário Gamificado
Route::prefix('quiz')->name('quiz.')->group(function () {
    Route::get('/', [QuizController::class, 'index'])->name('index');
    Route::get('/question/{step}', [QuizController::class, 'showQuestion'])->name('question');
    Route::post('/question/{step}', [QuizController::class, 'submitAnswer'])->name('submit');
    Route::get('/results', [QuizController::class, 'showResults'])->name('results');
    Route::post('/reset', [QuizController::class, 'resetQuiz'])->name('reset');
});
