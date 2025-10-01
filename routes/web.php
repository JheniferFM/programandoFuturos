<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TrilhaController; // Adicionamos esta linha


Route::get('/', function () {
    return view('home'); // carrega resources/views/home.blade.php
})->name('home');

Route::get('/teste', function() {
    return view('test');
});

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
    return view('home');
});

Route::get('/teste', function() {
    return view('test');
});

// Trilhas - AGORA APONTANDO PARA O CONTROLLER
Route::get('/trilhas/frontend', [TrilhaController::class, 'showFrontend'])->name('trilhas.frontend');
Route::get('/trilhas/backend', [TrilhaController::class, 'showBackend'])->name('trilhas.backend');


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



Route::get('/trilha/backend', function() {
    return view('trilhas.backend');
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
