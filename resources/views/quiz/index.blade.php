@extends('layouts.app')

@section('content')
<div class="quiz-hero">
    <div class="quiz-container">
        <!-- Back Button -->
        <div class="quiz-back-button">
            <a href="{{ route('home') }}" class="back-button">
                <i class="fas fa-arrow-left"></i>
                Voltar ao início
            </a>
        </div>
        
        <div class="quiz-intro">
            <div class="hero-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
            <h1>Descubra seu Perfil em TI</h1>
            <p>Responda algumas perguntas simples e descubra quais trilhas de Tecnologia da Informação combinam mais com você!</p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">10</span>
                    <span class="stat-label">Perguntas</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">10min</span>
                    <span class="stat-label">Duração</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100%</span>
                    <span class="stat-label">Gratuito</span>
                </div>
            </div>
        
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        @auth
            <div class="quiz-start-card">
                <div class="quiz-card-content">
                    <h2>Questionário de Interesses</h2>
                    <p>Este questionário gamificado vai te ajudar a descobrir quais áreas da programação combinam mais com seus interesses e habilidades.</p>
                    
                    @if(auth()->user()->quiz_completed)
                        <div class="quiz-status completed">
                            <span class="badge">Questionário Concluído</span>
                            <p>Você já completou o questionário! Veja seus resultados ou reinicie para tentar novamente.</p>
                            <div class="quiz-actions">
                                <a href="{{ route('quiz.results') }}" class="btn btn-primary">Ver Resultados</a>
                                <form action="{{ route('quiz.reset') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Reiniciar Questionário</button>
                                </form>
                            </div>
                        </div>
                    @elseif(auth()->user()->quiz_progress > 0)
                        <div class="quiz-status in-progress">
                            <span class="badge">Em Andamento</span>
                            <p>Você já começou o questionário! Continue de onde parou.</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ (auth()->user()->quiz_progress / 10) * 100 }}%" aria-valuenow="{{ auth()->user()->quiz_progress }}" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                            <div class="quiz-actions">
                                <a href="{{ route('quiz.question', ['step' => auth()->user()->quiz_progress + 1]) }}" class="btn btn-primary">Continuar Questionário</a>
                            </div>
                        </div>
                    @else
                        <div class="quiz-status not-started">
                            <span class="badge">Novo Questionário</span>
                            <p>Responda 10 perguntas simples e descubra seu perfil em programação!</p>
                            <div class="quiz-actions">
                                <a href="{{ route('quiz.question', ['step' => 1]) }}" class="btn btn-primary">Iniciar Questionário</a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="quiz-benefits">
                    <h3>Benefícios do Questionário</h3>
                    <ul>
                        <li><i class="fas fa-check"></i> Descubra suas áreas de interesse em TI</li>
                        <li><i class="fas fa-check"></i> Receba recomendações personalizadas de trilhas</li>
                        <li><i class="fas fa-check"></i> Ganhe pontos de gamificação</li>
                        <li><i class="fas fa-check"></i> Acompanhe seu progresso nas trilhas recomendadas</li>
                    </ul>
                </div>
            </div>
        @else
            <div class="quiz-login-required">
                <p>Você precisa estar logado para fazer o questionário e descobrir seu perfil.</p>
                <div class="quiz-actions">
                    <a href="{{ route('login') }}" class="btn btn-primary">Fazer Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Criar Conta</a>
                </div>
            </div>
        @endauth
    </div>
</div>

<style>
    :root {
        --primary-blue: #00bcd4;
        --secondary-orange: #ff8c00;
        --background-dark-blue: #1a1a2e;
        --card-background: #16213e;
        --text-color: #e0e0e0;
        --heading-color: #f0f0f0;
        --accent-blue: #0f3460;
        --border-blue: #00796b;
        --hover-light-blue: #00e5ff;
        --hover-light-orange: #ffa500;
        --success-color: #4facfe;
        --warning-color: #43e97b;
        --danger-color: #fa709a;
        --text-muted: #a0a0a0;
    }

    .quiz-hero {
        min-height: 100vh;
        background: radial-gradient(circle at center, rgba(0,188,212,0.1) 0%, var(--background-dark-blue) 70%);
        position: relative;
        overflow: hidden;
    }
    
    .quiz-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
        pointer-events: none;
    }
    
    .quiz-container {
        background: var(--card-background);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        border: 1px solid var(--border-blue);
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    .quiz-intro {
        text-align: center;
        margin-bottom: 3rem;
        color: white;
    }
    
    .hero-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        animation: float 3s ease-in-out infinite;
    }
    
    .hero-icon i {
        font-size: 2rem;
        color: var(--primary-blue);
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .quiz-intro h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: var(--heading-color);
        text-shadow: 0 0 20px rgba(0,188,212,0.5);
    }
    
    .quiz-intro p {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.9;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
        color: var(--text-color);
    }
    
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
        margin-bottom: 3rem;
    }
    
    .stat-item {
        text-align: center;
        background: var(--card-background);
        padding: 1.5rem;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-blue);
        transition: transform 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,188,212,0.2);
        border-color: var(--primary-blue);
    }
    
    .stat-number {
        display: block;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: var(--primary-blue);
    }
    
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .quiz-start-card {
        background: var(--card-background);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-blue);
        animation: slideUp 0.8s ease-out;
        transition: all 0.3s ease;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .quiz-card-content {
        padding: 3rem;
    }
    
    .quiz-card-content h2 {
        color: var(--heading-color);
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
        text-align: center;
    }
    
    .quiz-card-content p {
        color: var(--text-color);
        font-size: 1.1rem;
        line-height: 1.6;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .quiz-status {
        margin-top: 2rem;
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .quiz-status::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.1;
        z-index: 0;
    }
    
    .quiz-status > * {
        position: relative;
        z-index: 1;
    }
    
    .quiz-status.completed {
        background-color: var(--card-background);
        border: 2px solid var(--border-blue);
    }

    .quiz-status.completed .badge {
        background: linear-gradient(135deg, #4CAF50, #45a049) !important;
        color: white !important;
        animation: pulse-glow 2s ease-in-out infinite;
        box-shadow: 0 0 20px rgba(76, 175, 80, 0.4);
        border: 2px solid #4CAF50 !important;
    }

    @keyframes pulse-glow {
        0% {
            transform: scale(1);
            box-shadow: 0 0 20px rgba(76, 175, 80, 0.4);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(76, 175, 80, 0.6);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 20px rgba(76, 175, 80, 0.4);
        }
    }
    
    .quiz-status.in-progress {
        background-color: var(--secondary-orange);
        color: var(--background-dark-blue);
    }
    
    .quiz-status.not-started {
        background-color: var(--background-dark-blue);
        color: var(--secondary-orange);
    }
    
    .badge {
        display: inline-block;
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .progress {
        height: 8px;
        background: rgba(0,121,107,0.2);
        border-radius: 10px;
        margin: 1.5rem 0;
        overflow: hidden;
        position: relative;
    }
    
    .progress-bar {
        background: linear-gradient(90deg, var(--primary-blue), var(--secondary-orange));
        height: 100%;
        border-radius: 10px;
        transition: width 0.5s ease;
        position: relative;
    }
    
    .progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .quiz-actions {
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1.1rem;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn:hover::before {
        left: 100%;
    }
    
    .btn-primary {
        background: var(--secondary-orange);
        color: var(--background-dark-blue);
        border: 2px solid var(--secondary-orange);
        box-shadow: 0 5px 15px rgba(255,140,0,0.3);
    }
    
    .btn-primary:hover {
        background-color: var(--hover-light-orange);
        border-color: var(--hover-light-orange);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(255,140,0,0.4);
    }
    
    .btn-secondary {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .quiz-benefits {
        background: var(--card-background);
        color: white;
        padding: 3rem;
        position: relative;
        overflow: hidden;
        border: 1px solid var(--border-blue);
        border-radius: 15px;
    }
    
    .quiz-benefits::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }
    
    .quiz-benefits h3 {
        font-size: 1.8rem;
        margin-bottom: 2rem;
        text-align: center;
        font-weight: 700;
        position: relative;
        z-index: 1;
        color: var(--primary-blue);
    }
    
    .quiz-benefits ul {
        list-style: none;
        padding: 0;
        position: relative;
        z-index: 1;
    }
    
    .quiz-benefits li {
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        padding: 0.8rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease;
    }
    
    .quiz-benefits li:hover {
        transform: translateX(10px);
    }
    
    .quiz-benefits li i {
        margin-right: 1rem;
        color: var(--secondary-orange);
        font-size: 1.2rem;
        width: 20px;
        text-align: center;
    }
    
    .quiz-login-required {
        background: var(--card-background);
        border-radius: 20px;
        padding: 3rem;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-blue);
        animation: slideUp 0.8s ease-out;
    }
    
    .quiz-login-required p {
        color: var(--text-color);
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }
    
    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }
    
    .alert-success {
        background: rgba(76, 175, 80, 0.1);
        color: #4CAF50;
        border: 1px solid rgba(76, 175, 80, 0.3);
    }
    
    @media (max-width: 768px) {
        .quiz-container {
            padding: 1rem;
        }
        
        .quiz-intro h1 {
            font-size: 2.5rem;
        }
        
        .hero-stats {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }
        
        .stat-item {
            width: 200px;
        }
        
        .quiz-card-content {
            padding: 2rem;
        }
        
        .quiz-benefits {
            padding: 2rem;
        }
        
        .quiz-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            max-width: 300px;
        }
    }
    
    @media (max-width: 480px) {
        .quiz-intro h1 {
            font-size: 2rem;
        }
        
        .quiz-intro p {
            font-size: 1.1rem;
        }
        
        .hero-icon {
            width: 60px;
            height: 60px;
        }
        
        .hero-icon i {
            font-size: 1.5rem;
        }
    }
    
    /* Back Button Styles */
    .quiz-back-button {
        margin-bottom: 2rem;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: rgba(0, 188, 212, 0.1);
        color: var(--primary-blue);
        text-decoration: none;
        border-radius: 10px;
        border: 1px solid var(--primary-blue);
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .back-button:hover {
        background: var(--primary-blue);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 188, 212, 0.3);
        text-decoration: none;
    }
    
    .back-button i {
        font-size: 0.9rem;
        transition: transform 0.3s ease;
    }
    
    .back-button:hover i {
        transform: translateX(-3px);
    }
</style>
@endsection