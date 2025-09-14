@extends('layouts.app')

@section('content')
<div class="quiz-results-container">
    <div class="quiz-results-header">
        <h1>Seus Resultados</h1>
        <p>Com base nas suas respostas, identificamos as trilhas que mais combinam com você!</p>
    </div>
    
    <div class="quiz-results-card">
        <div class="quiz-completion">
            <div class="completion-badge">
                <i class="fas fa-trophy"></i>
            </div>
            <div class="completion-text">
                <h2>Questionário Concluído!</h2>
                <p>Você ganhou <span class="points">+50</span> pontos de gamificação</p>
                <div class="user-points">
                    <i class="fas fa-star"></i> {{ $user->gamification_points }} pontos totais
                </div>
            </div>
        </div>
        
        <div class="quiz-recommendations">
            <h3>Trilhas Recomendadas para Você</h3>
            
            @if(count($recommendedTracks) > 0)
                <div class="recommended-tracks">
                    @foreach($recommendedTracks as $index => $track)
                        <div class="track-card track-{{ $index + 1 }}" data-track="{{ $track['track'] }}">
                            <div class="track-match">
                                <div class="match-percentage" style="--percentage: {{ $track['match_percentage'] }}%">
                                    <span>{{ $track['match_percentage'] }}%</span>
                                </div>
                                <div class="match-label">compatibilidade</div>
                            </div>
                            
                            <div class="track-info">
                                <div class="track-icon">
                                    @if($track['track'] == 'frontend')
                                        <i class="fas fa-desktop"></i>
                                    @elseif($track['track'] == 'backend')
                                        <i class="fas fa-server"></i>
                                    @elseif($track['track'] == 'mobile')
                                        <i class="fas fa-mobile-alt"></i>
                                    @elseif($track['track'] == 'data')
                                        <i class="fas fa-database"></i>
                                    @elseif($track['track'] == 'devops')
                                        <i class="fas fa-network-wired"></i>
                                    @elseif($track['track'] == 'design')
                                        <i class="fas fa-paint-brush"></i>
                                    @else
                                        <i class="fas fa-code"></i>
                                    @endif
                                </div>
                                
                                <div class="track-details">
                                    <h4>
                                        @if($track['track'] == 'frontend')
                                            Front-end
                                        @elseif($track['track'] == 'backend')
                                            Back-end
                                        @elseif($track['track'] == 'mobile')
                                            Desenvolvimento Mobile
                                        @elseif($track['track'] == 'data')
                                            Ciência de Dados
                                        @elseif($track['track'] == 'devops')
                                            DevOps
                                        @elseif($track['track'] == 'design')
                                            Design de Interface
                                        @else
                                            {{ ucfirst($track['track']) }}
                                        @endif
                                    </h4>
                                    <p>
                                        @if($track['track'] == 'frontend')
                                            Desenvolvimento de interfaces e experiências de usuário com HTML, CSS e JavaScript.
                                        @elseif($track['track'] == 'backend')
                                            Desenvolvimento de servidores, APIs e lógica de negócios.
                                        @elseif($track['track'] == 'mobile')
                                            Criação de aplicativos para dispositivos móveis.
                                        @elseif($track['track'] == 'data')
                                            Análise e processamento de dados, machine learning e IA.
                                        @elseif($track['track'] == 'devops')
                                            Infraestrutura, automação e entrega contínua.
                                        @elseif($track['track'] == 'design')
                                            Design de interfaces, UX/UI e experiência do usuário.
                                        @else
                                            Trilha de desenvolvimento de software.
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="track-action">
                                @if($track['track'] == 'frontend')
                                    <a href="{{ url('/trilhas/frontend') }}" class="btn btn-primary">Acessar Trilha</a>
                                @else
                                    <button class="btn btn-secondary" disabled>Em breve</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-recommendations">
                    <p>Não foi possível gerar recomendações. Por favor, tente reiniciar o questionário.</p>
                </div>
            @endif
        </div>
        
        <div class="quiz-badges">
            <h3>Suas Conquistas</h3>
            
            <div class="badges-container">
                @if(in_array('quiz_completed', $badges))
                    <div class="badge-item">
                        <div class="badge-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="badge-info">
                            <h4>Questionário Concluído</h4>
                            <p>Você completou o questionário de vocação!</p>
                        </div>
                    </div>
                @endif
                
                <!-- Badges futuros podem ser adicionados aqui -->
            </div>
        </div>
        
        <div class="quiz-actions">
            <form action="{{ route('quiz.reset') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary">Reiniciar Questionário</button>
            </form>
            <a href="{{ url('/') }}" class="btn btn-outline">Voltar para Home</a>
        </div>
    </div>
</div>

<style>
    .quiz-results-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem;
        font-family: var(--font-family);
    }
    
    .quiz-results-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .quiz-results-header h1 {
        color: var(--primary-color);
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .quiz-results-header p {
        font-size: 1.2rem;
        color: var(--text-color);
    }
    
    .quiz-results-card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 2rem;
    }
    
    .quiz-completion {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .completion-badge {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
    }
    
    .completion-badge i {
        font-size: 2.5rem;
        color: white;
    }
    
    .completion-text h2 {
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }
    
    .completion-text p {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    
    .points {
        color: #FFD700;
        font-weight: bold;
    }
    
    .user-points {
        display: inline-block;
        background: rgba(255, 215, 0, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        color: #FFD700;
        font-weight: bold;
    }
    
    .user-points i {
        margin-right: 0.3rem;
    }
    
    .quiz-recommendations {
        margin-bottom: 2rem;
    }
    
    .quiz-recommendations h3,
    .quiz-badges h3 {
        color: var(--primary-color);
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .quiz-recommendations h3:after,
    .quiz-badges h3:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--primary-color);
        border-radius: 3px;
    }
    
    .recommended-tracks {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .track-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
        transform: translateY(10px);
    }
    
    .track-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }
    
    .track-1 { animation-delay: 0.1s; }
    .track-2 { animation-delay: 0.3s; }
    .track-3 { animation-delay: 0.5s; }
    
    .track-match {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        text-align: center;
    }
    
    .match-percentage {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: conic-gradient(
            var(--primary-color) 0%, 
            var(--primary-color) var(--percentage), 
            rgba(255, 255, 255, 0.1) var(--percentage), 
            rgba(255, 255, 255, 0.1) 100%
        );
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin: 0 auto;
    }
    
    .match-percentage::before {
        content: '';
        position: absolute;
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: var(--card-bg);
    }
    
    .match-percentage span {
        position: relative;
        z-index: 1;
        font-weight: bold;
        font-size: 1rem;
    }
    
    .match-label {
        font-size: 0.8rem;
        margin-top: 0.3rem;
        opacity: 0.7;
    }
    
    .track-info {
        display: flex;
        margin-right: 80px;
    }
    
    .track-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.5rem;
    }
    
    .track-details h4 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    
    .track-details p {
        opacity: 0.8;
        font-size: 0.95rem;
        line-height: 1.4;
    }
    
    .track-action {
        margin-top: 1.5rem;
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
        display: inline-block;
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
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-color);
    }
    
    .btn-secondary:hover:not([disabled]) {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }
    
    .btn-secondary[disabled] {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--text-color);
    }
    
    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.3);
    }
    
    .quiz-badges {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .badges-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .badge-item {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 1rem;
        flex: 1;
        min-width: 250px;
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
        transform: translateY(10px);
        animation-delay: 0.7s;
    }
    
    .badge-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.2rem;
    }
    
    .badge-info h4 {
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
    }
    
    .badge-info p {
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    .quiz-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }
    
    .no-recommendations {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
    }
    
    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (min-width: 768px) {
        .recommended-tracks {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .quiz-results-container {
            padding: 1rem;
        }
        
        .quiz-completion {
            flex-direction: column;
            text-align: center;
        }
        
        .completion-badge {
            margin-right: 0;
            margin-bottom: 1rem;
        }
        
        .track-match {
            position: static;
            margin-bottom: 1rem;
        }
        
        .track-info {
            margin-right: 0;
        }
        
        .quiz-actions {
            flex-direction: column;
        }
    }
</style>

<script>
    // Animação para os cards de trilha
    document.addEventListener('DOMContentLoaded', function() {
        const trackCards = document.querySelectorAll('.track-card');
        
        // Adiciona classe para iniciar animação
        trackCards.forEach(card => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    });
</script>
@endsection