@extends('layouts.app')

@section('content')
<div class="quiz-question-container">
    <div class="quiz-progress-bar">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="progress-text">
            <span>Pergunta {{ $step }} de {{ $totalSteps }}</span>
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
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        font-family: var(--font-family);
    }
    
    .quiz-progress-bar {
        margin-bottom: 2rem;
    }
    
    .progress {
        height: 10px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
        overflow: hidden;
    }
    
    .progress-bar {
        background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
        height: 100%;
        border-radius: 5px;
        transition: width 0.3s ease;
    }
    
    .progress-text {
        display: flex;
        justify-content: space-between;
        margin-top: 0.5rem;
        color: var(--text-color);
        font-size: 0.9rem;
    }
    
    .quiz-question-card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 2rem;
    }
    
    .quiz-question-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .quiz-question-header h2 {
        color: var(--primary-color);
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }
    
    .quiz-subtitle {
        color: var(--text-color);
        opacity: 0.8;
    }
    
    .quiz-options {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
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
        border-radius: 8px;
        border: 2px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .quiz-option input[type="radio"]:checked + label {
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .option-content {
        display: flex;
        align-items: center;
        padding: 1.2rem;
    }
    
    .option-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 50%;
        margin-right: 1rem;
        color: white;
        font-size: 1.2rem;
    }
    
    .option-text {
        flex: 1;
        font-size: 1.1rem;
    }
    
    .quiz-actions {
        display: flex;
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
    
    @media (min-width: 768px) {
        .quiz-options {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .quiz-question-container {
            padding: 1rem;
        }
        
        .quiz-question-header h2 {
            font-size: 1.5rem;
        }
        
        .option-content {
            padding: 1rem;
        }
        
        .option-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }
    
    /* Animação para as opções */
    .quiz-option {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
        transform: translateY(10px);
    }
    
    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .quiz-option:nth-child(1) { animation-delay: 0.1s; }
    .quiz-option:nth-child(2) { animation-delay: 0.2s; }
    .quiz-option:nth-child(3) { animation-delay: 0.3s; }
    .quiz-option:nth-child(4) { animation-delay: 0.4s; }
</style>
@endsection