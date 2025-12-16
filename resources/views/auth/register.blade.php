{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    /* ------------------ Registro - Estilos ------------------ */
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #1a1a2e;
        font-family: 'Montserrat', sans-serif;
        margin: 0;
    }

    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem;
        background: linear-gradient(135deg, #16213e, #1a1a2e);
    }

    .auth-card {
        background-color: #16213e;
        border: 1px solid #00796b;
        padding: 2.5rem;
        border-radius: 15px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 10px 25px rgba(0, 188, 212, 0.2);
        color: #e0e0e0;
    }

    @media (max-width: 480px) {
        .auth-container {
            padding: 1rem;
        }
        .auth-card {
            padding: 1.5rem;
        }
        .auth-card h2 {
            font-size: 1.5rem;
        }
    }

    .auth-card h2 {
        text-align: center;
        font-family: 'Orbitron', sans-serif;
        font-size: 2rem;
        color: #ff8c00;
        margin-bottom: 1.5rem;
    }

    form label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.3rem;
        color: #e0e0e0;
    }

    form input {
        display: block;
        width: 100%;
        max-width: 100%;
        padding: 0.8rem;
        margin-bottom: 1rem;
        border-radius: 8px;
        border: 1px solid #00796b;
        background-color: #1a1a2e;
        color: #f0f0f0;
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }

    form input:focus {
        outline: none;
        border-color: #00bcd4;
        box-shadow: 0 0 8px rgba(0, 188, 212, 0.5);
    }

    button {
        width: 100%;
        padding: 0.9rem;
        background-color: #ff8c00;
        color: #1a1a2e;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    button:hover {
        background-color: #ffa500;
        transform: translateY(-2px);
    }

    .register-link {
        display: block;
        text-align: center;
        margin-top: 1rem;
        color: #00bcd4;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link:hover {
        color: #ffa500;
    }

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

<div class="auth-container">
    <div class="auth-card">
        <a href="{{ route('home') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Voltar ao início
        </a>
        <h2>Cadastro</h2>
        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirmar Senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p style="color:#ff8c00;">{{ $error }}</p>
                @endforeach
            @endif

            <button type="submit">Cadastrar</button>
        </form>
        <a href="{{ route('login') }}" class="register-link">Já tem conta? Faça login</a>
    </div>
</div>
@endsection
