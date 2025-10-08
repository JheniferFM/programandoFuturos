@extends('layouts.app')

@section('content')
<div class="trilha-container">
    {{-- Mantivemos o mesmo estilo visual da trilha de Front-end --}}
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

        body {
            font-family: var(--font-primary);
            background-color: var(--background-dark-blue);
            color: var(--text-color);
            line-height: 1.6;
        }

        .trilha-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .trilha-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-blue);
        }

        .trilha-title {
            font-family: var(--font-display);
            font-size: 2.5rem;
            color: var(--heading-color);
        }

        .back-button {
            display: inline-block;
            background-color: transparent;
            color: var(--primary-blue);
            padding: 0.5rem 1rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-blue);
        }

        .back-button:hover {
            background-color: var(--primary-blue);
            color: var(--background-dark-blue);
        }

        .trilha-description {
            background-color: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .trilha-description h2 {
            font-family: var(--font-display);
            font-size: 1.8rem;
            color: var(--heading-color);
            margin-bottom: 1rem;
        }

        .trilha-description h3 {
            font-family: var(--font-display);
            font-size: 1.4rem;
            color: var(--primary-blue);
            margin: 1.5rem 0 1rem;
        }

        .trilha-description p {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .trilha-description ul {
            list-style: none;
            padding-left: 1rem;
            margin-bottom: 1.5rem;
        }

        .trilha-description ul li {
            margin-bottom: 0.5rem;
            position: relative;
        }

        .trilha-description ul li::before {
            content: '•';
            color: var(--secondary-orange);
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        .modules-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .module-card {
            background-color: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 15px;
            padding: 2rem;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .module-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-blue);
            box-shadow: 0 12px 30px rgba(0,188,212,0.2);
        }

        .module-number {
            display: inline-block;
            background-color: var(--primary-blue);
            color: var(--background-dark-blue);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .module-card h3 {
            font-family: var(--font-display);
            font-size: 1.5rem;
            color: var(--heading-color);
            margin-bottom: 1rem;
        }

        .module-card p {
            margin-bottom: 1.5rem;
        }

        .module-button {
            display: inline-block;
            background-color: var(--secondary-orange);
            color: var(--background-dark-blue);
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: 2px solid var(--secondary-orange);
        }

        .module-button:hover {
            background-color: var(--hover-light-orange);
            border-color: var(--hover-light-orange);
        }

        .courses-section {
            margin-top: 3rem;
        }

        .section-title {
            font-family: var(--font-display);
            font-size: 2rem;
            color: var(--heading-color);
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 100px;
            height: 3px;
            background-color: var(--secondary-orange);
            margin: 0.5rem auto 0;
            border-radius: 3px;
        }

        .courses-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .course-card {
            background-color: rgba(255, 140, 0, 0.1);
            border: 1px solid var(--secondary-orange);
            border-radius: 15px;
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 140, 0, 0.2);
        }

        .course-card h3 {
            font-family: var(--font-display);
            font-size: 1.5rem;
            color: var(--secondary-orange);
            margin-bottom: 1rem;
        }

        .course-card p {
            margin-bottom: 1rem;
        }

        .course-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: var(--text-color);
            opacity: 0.8;
        }

        .course-button {
            display: inline-block;
            background-color: var(--secondary-orange);
            color: var(--background-dark-blue);
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: 2px solid var(--secondary-orange);
        }

        .course-button:hover {
            background-color: transparent;
            color: var(--secondary-orange);
        }
    </style>

    <div class="trilha-header">
        <h1 class="trilha-title">{{ $trilha['titulo'] }}</h1>
        <a href="/" class="back-button"><i class="fas fa-arrow-left"></i> Voltar</a>
    </div>

    <div class="trilha-description">
        <h2>Sobre esta trilha</h2>
        @foreach($trilha['sobre'] as $paragrafo)
            <p>{{ $paragrafo }}</p>
        @endforeach

        <h3>O que você vai aprender:</h3>
        <ul>
            @foreach($trilha['aprendizados'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>

    <div class="modules-container">
        @foreach($modulos as $modulo)
            <div class="module-card">
                <span class="module-number">{{ $modulo['numero'] }}</span>
                <h3>{{ $modulo['titulo'] }}</h3>
                <p>{{ $modulo['descricao'] }}</p>
                <a href="#" class="module-button">Explorar Módulo</a>
            </div>
        @endforeach
    </div>
    
    <div class="courses-section">
        <h2 class="section-title">Cursos Recomendados</h2>
        <div class="courses-container">
            @foreach($cursos as $curso)
                <div class="course-card">
                    <h3>{{ $curso['titulo'] }}</h3>
                    <p>{{ $curso['descricao'] }}</p>
                    <div class="course-info">
                        <span>Duração: {{ $curso['duracao'] }}</span>
                        <span>Nível: {{ $curso['nivel'] }}</span>
                    </div>
                    <a href="#" class="course-button">Ver Curso</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
