@extends('layouts.app')

@section('content')
<div class="quiz-question-container">
    <!-- Botão de voltar -->
    <div class="quiz-back-button">
        @if($step > 1)
            <a href="{{ route('quiz.question', ['step' => $step - 1]) }}" class="back-button">
                <i class="fas fa-arrow-left"></i>
                Pergunta Anterior
            </a>
        @else
            <a href="{{ route('quiz.index') }}" class="back-button">
                <i class="fas fa-arrow-left"></i>
                Voltar ao Quiz
            </a>
        @endif
    </div>
    
    <!-- Elementos de gamificação -->
    <div class="gamification-elements">
        <div class="points-badge">
            <i class="fas fa-star"></i> {{ auth()->user()->gamification_points ?? 0 }} pts
        </div>
        <div class="level-badge">
            <i class="fas fa-trophy"></i> Nível {{ floor((auth()->user()->gamification_points ?? 0) / 100) + 1 }}
        </div>
    </div>

    <div class="quiz-progress-bar">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="progress-text">
            <span><i class="fas fa-question-circle"></i> Pergunta {{ $step }} de {{ $totalSteps }}</span>
            <span><i class="fas fa-chart-line"></i> {{ number_format($progress, 0) }}% Completo</span>
        </div>
    </div>
    
    <div class="quiz-question-card">
        <div class="quiz-question-header">
            <h2>{{ $question['question'] }}</h2>
            <p class="quiz-subtitle">Escolha a opção que mais combina com você</p>
        </div>
        
        <form action="{{ route('quiz.submit', ['step' => $step]) }}" method="POST" class="quiz-options-form">
            @csrf
            <div class="quiz-options">
                @foreach($question['options'] as $value => $label)
                    <div class="quiz-option">
                        <input type="radio" name="answer" id="option-{{ $value }}" value="{{ $value }}" required>
                        <label for="option-{{ $value }}">
                            <div class="option-content">
                                <div class="option-icon">
                                    @if($value == 'visual')
                                        <i class="fas fa-paint-brush"></i>
                                    @elseif($value == 'logica')
                                        <i class="fas fa-brain"></i>
                                    @elseif($value == 'ambos')
                                        <i class="fas fa-code-branch"></i>
                                    @elseif($value == 'interfaces')
                                        <i class="fas fa-desktop"></i>
                                    @elseif($value == 'dados')
                                        <i class="fas fa-database"></i>
                                    @elseif($value == 'sistemas')
                                        <i class="fas fa-server"></i>
                                    @elseif($value == 'apps')
                                        <i class="fas fa-mobile-alt"></i>
                                    @elseif($value == 'criativo')
                                        <i class="fas fa-lightbulb"></i>
                                    @elseif($value == 'analitico')
                                        <i class="fas fa-chart-line"></i>
                                    @elseif($value == 'pratico')
                                        <i class="fas fa-tools"></i>
                                    @elseif($value == 'infraestrutura')
                                        <i class="fas fa-network-wired"></i>
                                    @else
                                        <i class="fas fa-code"></i>
                                    @endif
                                </div>
                                <div class="option-text">
                                    <span>{{ $label }}</span>
                                </div>
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>
            
            <div class="quiz-actions">
                <button type="submit" class="btn btn-primary">Próxima Pergunta</button>
            </div>
        </form>
    </div>
</div>

<style>
    .quiz-question-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px;
        font-family: var(--font-family);
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(26, 26, 46, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    /* Botão de voltar */
    .quiz-back-button {
        margin-bottom: 20px;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #1a1a2e;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 20px;
        background: rgba(26, 26, 46, 0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(26, 26, 46, 0.2);
    }
    
    .back-button:hover {
        background: rgba(26, 26, 46, 0.15);
        transform: translateX(-2px);
        color: #ff6f61;
    }
    
    .back-button i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }
    
    .back-button:hover i {
        transform: translateX(-2px);
    }
    
    /* Elementos de gamificação */
    .gamification-elements {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .points-badge, .level-badge {
        background: linear-gradient(135deg, #ff6f61 0%, #e55b4d 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 4px 15px rgba(255, 111, 97, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
        animation: bounceIn 0.8s ease-out;
        transition: all 0.3s ease;
    }
    
    .points-badge:hover, .level-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 111, 97, 0.4);
    }
    
    .points-badge i, .level-badge i {
        font-size: 18px;
        animation: sparkle 2s infinite;
    }
    
    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    @keyframes sparkle {
        0%, 100% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.2) rotate(180deg); }
    }
    
    .quiz-question-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ff6f61, #1a1a2e, #ff6f61);
        background-size: 200% 100%;
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    .quiz-progress-bar {
        margin-bottom: 40px;
    }
    
    .progress {
        height: 12px;
        background: rgba(26, 26, 46, 0.1);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar {
        background: linear-gradient(90deg, #ff6f61 0%, #e55b4d 50%, #ff6f61 100%);
        height: 100%;
        border-radius: 20px;
        transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: progressShine 2s infinite;
    }
    
    @keyframes progressShine {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .progress-text {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        color: #1a1a2e;
        font-size: 16px;
        font-weight: 600;
        padding: 15px;
        background: linear-gradient(135deg, rgba(255, 111, 97, 0.1) 0%, rgba(26, 26, 46, 0.1) 100%);
        border-radius: 15px;
        border: 2px solid rgba(255, 111, 97, 0.2);
    }
    
    .quiz-question-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 40px;
        position: relative;
    }
    
    .quiz-question-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 111, 97, 0.05) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }
    
    .quiz-question-header {
        text-align: center;
        margin-bottom: 30px;
        position: relative;
        z-index: 1;
    }
    
    .quiz-question-header h2 {
        color: #1a1a2e;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .quiz-subtitle {
        color: #1a1a2e;
        opacity: 0.8;
        font-size: 16px;
    }
    
    .quiz-options {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 40px;
    }
    
    .quiz-option {
        position: relative;
    }
    
    .quiz-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .quiz-option label {
        display: block;
        cursor: pointer;
        border-radius: 15px;
        border: 3px solid rgba(26, 26, 46, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        transform: translateY(0);
    }
    
    .quiz-option label::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 111, 97, 0.1), transparent);
        transition: left 0.5s;
    }
    
    .quiz-option label:hover {
        border-color: #ff6f61;
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 30px rgba(255, 111, 97, 0.2);
    }
    
    .quiz-option label:hover::before {
        left: 100%;
    }
    
    .quiz-option input[type="radio"]:checked + label {
        border-color: #ff6f61;
        background: linear-gradient(135deg, #fff5f4 0%, #ffe8e6 100%);
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 20px 40px rgba(255, 111, 97, 0.3);
    }
    
    .quiz-option input[type="radio"]:checked + label .option-icon {
        animation: bounce 0.6s ease;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    .option-content {
        display: flex;
        align-items: center;
        padding: 25px;
        position: relative;
        z-index: 1;
    }
    
    .option-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ff6f61, #e55b4d);
        border-radius: 50%;
        margin-right: 20px;
        color: white;
        font-size: 24px;
        transition: all 0.3s ease;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }
    
    .option-text {
        flex: 1;
        font-size: 16px;
        font-weight: 600;
        color: #1a1a2e;
    }
    
    .quiz-actions {
        display: flex;
        justify-content: center;
    }
    
    .btn {
        padding: 15px 35px;
        border-radius: 30px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
        font-size: 16px;
        position: relative;
        overflow: hidden;
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
        background: linear-gradient(135deg, #ff6f61 0%, #e55b4d 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(255, 111, 97, 0.3);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #e55b4d 0%, #d14a3d 100%);
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(255, 111, 97, 0.4);
    }
    
    @media (min-width: 768px) {
        .quiz-options {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    }
    
    /* Efeitos de gamificação */
    .quiz-option.selected {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(255, 111, 97, 0.4);
        border: 3px solid #ff6f61;
    }
    
    .quiz-option.achievement-unlocked {
        animation: achievementPulse 0.6s ease-in-out;
    }
    
    @keyframes achievementPulse {
        0% { transform: scale(1.05); }
        50% { transform: scale(1.15); box-shadow: 0 12px 30px rgba(255, 111, 97, 0.6); }
        100% { transform: scale(1.05); }
    }
    
    @keyframes screenShake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-2px); }
        75% { transform: translateX(2px); }
    }
    
    .celebration-particle {
        position: fixed;
        font-size: 24px;
        pointer-events: none;
        z-index: 9999;
        user-select: none;
    }
    
    @media (max-width: 768px) {
        .quiz-question-container {
            margin: 15px;
            padding: 20px;
        }
        
        .quiz-question-header h2 {
            font-size: 24px;
        }
        
        .option-content {
            padding: 20px;
        }
        
        .option-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
        
        .option-text {
            font-size: 14px;
        }
        
        .gamification-elements {
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        
        .points-badge, .level-badge {
             font-size: 14px;
             padding: 10px 16px;
         }
     }
    
    /* Animação para as opções */
    .quiz-option {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(30px);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .quiz-option:nth-child(1) { animation-delay: 0.1s; }
    .quiz-option:nth-child(2) { animation-delay: 0.2s; }
    .quiz-option:nth-child(3) { animation-delay: 0.3s; }
    .quiz-option:nth-child(4) { animation-delay: 0.4s; }
    
    .quiz-question-card {
        animation: slideInDown 0.8s ease;
    }
    
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const options = document.querySelectorAll('.quiz-option input[type="radio"]');
    const form = document.querySelector('.quiz-options-form');
    
    // Adicionar efeitos de gamificação
    options.forEach(option => {
        option.addEventListener('change', function() {
            // Remover seleção anterior
            document.querySelectorAll('.quiz-option').forEach(opt => {
                opt.classList.remove('selected', 'achievement-unlocked');
            });
            
            // Adicionar efeito de seleção
            const selectedOption = this.closest('.quiz-option');
            selectedOption.classList.add('selected');
            
            // Efeito de conquista
            setTimeout(() => {
                selectedOption.classList.add('achievement-unlocked');
                
                // Criar partículas de celebração
                createCelebrationParticles(selectedOption);
                
                // Som visual (vibração da tela)
                document.body.style.animation = 'screenShake 0.3s ease-in-out';
                setTimeout(() => {
                    document.body.style.animation = '';
                }, 300);
            }, 100);
        });
    });
    
    // Função para criar partículas de celebração
    function createCelebrationParticles(element) {
        for (let i = 0; i < 6; i++) {
            const particle = document.createElement('div');
            particle.className = 'celebration-particle';
            particle.innerHTML = ['⭐', '🎉', '✨', '🏆', '💫'][Math.floor(Math.random() * 5)];
            
            const rect = element.getBoundingClientRect();
            particle.style.left = (rect.left + rect.width / 2) + 'px';
            particle.style.top = (rect.top + rect.height / 2) + 'px';
            
            document.body.appendChild(particle);
            
            // Animar partícula
            const angle = (Math.PI * 2 * i) / 6;
            const distance = 100 + Math.random() * 50;
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance;
            
            particle.animate([
                { transform: 'translate(0, 0) scale(0)', opacity: 1 },
                { transform: `translate(${x}px, ${y}px) scale(1)`, opacity: 0 }
            ], {
                duration: 1000,
                easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
            }).onfinish = () => particle.remove();
        }
    }
});
</script>

@endsection