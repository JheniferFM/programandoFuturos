{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="auth-container">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        .auth-container {
            min-height: 100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background-color: #1a1a2e; /* background-dark-blue */
            padding: 1rem;
        }
        .auth-card {
            background-color: #16213e;
            padding: 2.5rem;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            color: #e0e0e0;
            box-shadow: 0 5px 20px rgba(0,188,212,0.3);
        }
        @media (max-width: 480px) {
            .auth-card {
                padding: 1.5rem;
            }
        }
        .auth-card h2 {
            font-family: 'Orbitron', sans-serif;
            text-align:center;
            color: #00bcd4;
            margin-bottom: 1.5rem;
        }
        .auth-card label { display:block; margin-bottom:0.5rem; }
        .auth-card input {
            display: block;
            width:100%;
            max-width: 100%;
            padding:0.8rem;
            margin-bottom:1rem;
            border-radius:10px;
            border:1px solid #00796b;
            background-color:#1a1a2e;
            color:#e0e0e0;
        }
        .auth-card button {
            display: block;
            width:100%;
            padding:0.9rem;
            border:none;
            border-radius:30px;
            background-color:#ff8c00;
            color:#1a1a2e;
            font-weight:700;
            cursor:pointer;
            transition:0.3s;
        }
        .auth-card button:hover { background-color:#ffa500; }
        .auth-card .register-link { text-align:center; margin-top:1rem; display:block; color:#00bcd4; }
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #00bcd4;
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            transition: color 0.3s ease;
        }
        .back-button:hover { color: #00e5ff; }
        .back-button i { font-size: 1rem; }
    </style>

    <div class="auth-card">
        <a href="{{ route('home') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Voltar ao início
        </a>
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>

            @error('email')
                <p style="color:#ff8c00;">{{ $message }}</p>
            @enderror

            <button type="submit">Entrar</button>
        </form>
        <a href="{{ route('register') }}" class="register-link">Não tem conta? Cadastre-se</a>
    </div>
</div>
@endsection
