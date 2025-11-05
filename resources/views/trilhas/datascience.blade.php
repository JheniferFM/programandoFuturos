@extends('layouts.app')

@section('content')
<div class="trilha-container">
    <style>
        :root {
            --background-dark-blue: #1a1a2e;
            --card-background: #16213e;
            --border-blue: #00796b;
            --primary-blue: #00bcd4;
            --secondary-orange: #ff8c00;
            --hover-light-orange: #ffa500;
            --text-color: #e0e0e0;
            --heading-color: #f0f0f0;
            --font-primary: 'Montserrat', sans-serif;
            --font-display: 'Orbitron', sans-serif;
        }

        /* Trilha Container */
        .trilha-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            color: var(--text-color);
        }

        /* Trilha Header */
        .trilha-header {
            background: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .trilha-title {
            font-family: var(--font-display);
            font-size: 2.5rem;
            color: var(--heading-color);
            margin: 0;
        }

        .back-button {
            color: var(--secondary-orange);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-button:hover {
            color: var(--hover-light-orange);
        }

        /* Description Section */
        .trilha-description {
            background: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .description-title {
            font-family: var(--font-display);
            color: var(--primary-blue);
            margin: 0 0 1rem 0;
        }

        .description-text {
            color: var(--text-color);
            line-height: 1.6;
            margin: 0 0 1.5rem 0;
        }

        .learning-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .learning-list li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .learning-list li i {
            color: var(--primary-blue);
        }

        /* Modules Section */
        .trilha-modules {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .module-card {
            background: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 15px;
            padding: 2rem;
            transition: transform 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
        }

        .module-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-blue);
        }

        .module-card h3 {
            font-family: var(--font-display);
            color: var(--heading-color);
            margin: 0 0 1rem 0;
        }

        .module-card p {
            margin: 0;
            color: var(--text-color);
            opacity: 0.9;
        }
    </style>

    <div class="trilha-header">
        <h1 class="trilha-title">{{ $trilha['titulo'] }}</h1>
        <a href="/" class="back-button"><i class="fas fa-arrow-left"></i> Voltar</a>
    </div>

    <div class="trilha-description">
        <h2 class="description-title">Sobre a Trilha</h2>
        @foreach($trilha['sobre'] as $paragrafo)
            <p class="description-text">{{ $paragrafo }}</p>
        @endforeach

        <h2 class="description-title">O que você vai aprender</h2>
        <ul class="learning-list">
            @foreach($trilha['aprendizados'] as $aprendizado)
                <li><i class="fas fa-check-circle"></i> {{ $aprendizado }}</li>
            @endforeach
        </ul>
    </div>

    <h2 class="description-title">Módulos do Curso</h2>
    <div class="trilha-modules">
        @foreach($modulos as $modulo)
            <div class="module-card">
                <h3>{{ $modulo['titulo'] }}</h3>
                <p>{{ $modulo['descricao'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection