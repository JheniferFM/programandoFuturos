<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // carrega resources/views/home.blade.php
});

Route::get('/teste', function() {
    return view('test');
});


