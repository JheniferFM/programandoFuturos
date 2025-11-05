<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TrilhaController;

Route::get('/', function () {
    return view('home'); // carrega resources/views/home.blade.php
})->name('home');

Route::get('/teste', function() {
    return view('test');
});

Route::get('/contato', function () {
    return view('contact');
})->name('contact');

// Trilhas - apontando para o Controller
Route::get('/trilhas/frontend', [TrilhaController::class, 'showFrontend'])->middleware('auth')->name('trilhas.frontend');
Route::get('/trilhas/backend', [TrilhaController::class, 'showBackend'])->name('trilhas.backend');
Route::get('/trilhas/mobile', [TrilhaController::class, 'showMobile'])->name('trilhas.mobile');
Route::get('/trilhas/datascience', [TrilhaController::class, 'showDataScience'])->name('trilhas.datascience');

// Autenticação
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

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Dashboard gamificado
    Route::get('/dashboard', function() {
        return view('dashboard.index');
    })->name('dashboard');

    // Atualização de avatar de personagem
    Route::post('/avatar', [AuthController::class, 'updateAvatar'])->name('avatar.update');

    // Sincronização de pontos das trilhas com o ranking
    Route::post('/trilhas/sync-points', [TrilhaController::class, 'syncPoints'])->name('trilhas.syncPoints');
});
