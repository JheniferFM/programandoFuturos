@extends('layouts.app')

@section('content')
<div class="quiz-container">
    <div class="quiz-intro">
        <h1>Descubra sua Vocação em Programação</h1>
        <p>Responda algumas perguntas simples e descubra quais trilhas de programação combinam mais com você!</p>
        
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
                                <div class="progress-bar" role="progressbar" style="width: {{ (auth()->user()->quiz_progress / 3) * 100 }}%" aria-valuenow="{{ auth()->user()->quiz_progress }}" aria-valuemin="0" aria-valuemax="3"></div>
                            </div>
                            <div class="quiz-actions">
                                <a href="{{ route('quiz.question', ['step' => auth()->user()->quiz_progress + 1]) }}" class="btn btn-primary">Continuar Questionário</a>
                            </div>
                        </div>
                    @else
                        <div class="quiz-status not-started">
                            <span class="badge">Novo Questionário</span>
                            <p>Responda 3 perguntas simples e descubra sua vocação em programação!</p>
                            <div class="quiz-actions">
                                <a href="{{ route('quiz.question', ['step' => 1]) }}" class="btn btn-primary">Iniciar Questionário</a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="quiz-benefits">
                    <h3>Benefícios do Questionário</h3>
                    <ul>
                        <li><i class="fas fa-check"></i> Descubra suas áreas de interesse na programação</li>
                        <li><i class="fas fa-check"></i> Receba recomendações personalizadas de trilhas</li>
                        <li><i class="fas fa-check"></i> Ganhe badges e pontos de gamificação</li>
                        <li><i class="fas fa-check"></i> Acompanhe seu progresso nas trilhas recomendadas</li>
                    </ul>
                </div>
            </div>
        @else
            <div class="quiz-login-required">
                <p>Você precisa estar logado para fazer o questionário e descobrir sua vocação.</p>
                <div class="quiz-actions">
                    <a href="{{ route('login') }}" class="btn btn-primary">Fazer Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Criar Conta</a>
                </div>
            </div>
        @endauth
    </div>
</div>

<style>
    .quiz-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem;
        font-family: var(--font-family);
    }
    
    .quiz-intro {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .quiz-intro h1 {
        color: var(--primary-color);
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .quiz-intro p {
        font-size: 1.2rem;
        color: var(--text-color);
        margin-bottom: 2rem;
    }
    
    .quiz-start-card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    
    .quiz-card-content {
        padding: 2rem;
    }
    
    .quiz-card-content h2 {
        color: var(--primary-color);
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }
    
    .quiz-status {
        margin-top: 1.5rem;
        padding: 1.5rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
    }
    
    .quiz-status.completed {
        background: rgba(76, 175, 80, 0.1);
    }
    
    .quiz-status.in-progress {
        background: rgba(33, 150, 243, 0.1);
    }
    
    .quiz-status.not-started {
        background: rgba(156, 39, 176, 0.1);
    }
    
    .badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: white;
    }
    
    .quiz-status.completed .badge {
        background: #4CAF50;
    }
    
    .quiz-status.in-progress .badge {
        background: #2196F3;
    }
    
    .quiz-status.not-started .badge {
        background: #9C27B0;
    }
    
    .progress {
        height: 10px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
        margin: 1rem 0;
        overflow: hidden;
    }
    
    .progress-bar {
        background: linear-gradient(to right, #2196F3, #9C27B0);
        height: 100%;
        border-radius: 5px;
    }
    
    .quiz-actions {
        margin-top: 1.5rem;
        display: flex;
        gap: 1rem;
        justify-content: center;
    }
    
    .btn {
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }
    
    .btn-primary {
        background: var(--primary-color);
        color: white;
    }
    
    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .btn-secondary {
        background: rgba(0, 0, 0, 0.1);
        color: var(--text-color);
    }
    
    .btn-secondary:hover {
        background: rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }
    
    .quiz-benefits {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 2rem;
    }
    
    .quiz-benefits h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .quiz-benefits ul {
        list-style: none;
        padding: 0;
    }
    
    .quiz-benefits li {
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
    }
    
    .quiz-benefits li i {
        margin-right: 0.5rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .quiz-login-required {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
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
        
        .quiz-actions {
            flex-direction: column;
        }
        
        .quiz-intro h1 {
            font-size: 2rem;
        }
    }
</style>
@endsection