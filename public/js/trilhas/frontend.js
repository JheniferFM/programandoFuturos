/**
 * Sistema de Trilha Frontend - Programando Futuros
 * Gerencia progresso, exercícios e interações da trilha de Frontend
 * Estende o sistema base para funcionalidades específicas do Frontend
 */

// Configuração da trilha (será injetada pelo PHP)
let userId = null;
let topicsData = {};

// Função para inicializar a trilha com dados do servidor
function initializeFrontendTrack(userIdParam, topicsDataParam) {
    userId = userIdParam;
    topicsData = topicsDataParam;
    
    // Inicializar sistemas
    window.progressTracker = new FrontendTrackProgress();
    window.exerciseSystem = new FrontendExerciseSystem(window.progressTracker);
    
    // Configurar eventos
    setupEventListeners();
    
    // Habilitar primeiro tópico
    const firstTopic = document.querySelector('.topic-item');
    if (firstTopic) {
        firstTopic.classList.add('enabled');
    }
    
    // Mostrar dica inicial
    setTimeout(() => {
        showDuckHelper('Bem-vindo à trilha Frontend! Clique em um tópico para começar.');
    }, 1000);
}

// Classe específica para a trilha Frontend
class FrontendTrackProgress extends TrackProgressBase {
    constructor() {
        super('frontend');
        this.totalPossiblePoints = 600;
        this.totalTopics = 5;
        this.updateUI();
    }

    updateUI() {
        const progressPercentage = Math.round((this.data.totalPoints / this.totalPossiblePoints) * 100);
        
        const currentPointsEl = document.getElementById('currentPoints');
        const completedTopicsEl = document.getElementById('completedTopics');
        const progressPercentageEl = document.getElementById('progressPercentage');
        const remainingPointsEl = document.getElementById('remainingPoints');
        const overallProgressFillEl = document.getElementById('overallProgressFill');
        
        if (currentPointsEl) currentPointsEl.textContent = this.data.totalPoints;
        if (completedTopicsEl) completedTopicsEl.textContent = `${this.data.completedTopics}/${this.totalTopics}`;
        if (progressPercentageEl) progressPercentageEl.textContent = `${progressPercentage}%`;
        if (remainingPointsEl) remainingPointsEl.textContent = `${this.totalPossiblePoints - this.data.totalPoints} XP`;
        if (overallProgressFillEl) overallProgressFillEl.style.width = `${progressPercentage}%`;
        
        // Verificar se a trilha foi completada
        if (this.data.totalPoints >= this.totalPossiblePoints && !this.data.celebrationShown) {
            this.data.celebrationShown = true;
            this.saveProgress();
            setTimeout(() => {
                showCelebration();
            }, 1000);
        }
        
        // Atualizar progresso dos tópicos
        Object.keys(this.data.topicProgress).forEach(topicKey => {
            const topicElement = document.querySelector(`[data-topic="${topicKey}"]`);
            if (topicElement) {
                const progress = this.data.topicProgress[topicKey];
                const progressFill = topicElement.querySelector('.progress-fill');
                const status = topicElement.querySelector('.topic-status');
                
                if (progress.completed) {
                    topicElement.classList.add('completed');
                    if (progressFill) progressFill.style.width = '100%';
                    if (status) status.textContent = '✅';
                } else {
                    const exerciseCount = this.data.exercisesCompleted[topicKey]?.length || 0;
                    const totalExercises = topicsData[topicKey]?.exercises?.length || 3;
                    const progressPercent = (exerciseCount / totalExercises) * 100;
                    if (progressFill) progressFill.style.width = `${progressPercent}%`;
                    if (status) status.textContent = exerciseCount > 0 ? '📖' : '▶️';
                }
            }
        });
    }
}

// Sistema de Exercícios específico para Frontend
class FrontendExerciseSystem extends ExerciseSystemBase {
    constructor(progressTracker) {
        super(progressTracker);
    }

    showCelebration() {
        // Implementação específica de celebração para Frontend
        showDuckHelper('🎉 Parabéns! Você completou um tópico da trilha Frontend!');
        
        // Verificar se completou toda a trilha
        const completedTopics = this.progress.getCompletedTopics();
        if (completedTopics.length >= this.topicsData.length) {
            this.showTrackCompletionCelebration();
        }
    }
    
    showTrackCompletionCelebration() {
        // Celebração especial para conclusão da trilha completa
        showCelebrationModal({
            title: 'Trilha Frontend Concluída!',
            message: 'Parabéns! Você dominou os fundamentos do desenvolvimento Frontend!',
            achievements: [
                'HTML Semântico',
                'CSS Avançado', 
                'JavaScript Moderno',
                'Frameworks Frontend',
                'Técnicas Avançadas'
            ]
        });
    }

    onCorrectAnswer() {
        // Verificar se completou todos os exercícios do tópico
        const completedExercises = this.progressTracker.data.exercisesCompleted[this.currentTopic] || [];
        const totalExercises = topicsData[this.currentTopic].exercises.length;
        
        if (completedExercises.length >= totalExercises) {
            this.progressTracker.completeTopic(this.currentTopic);
            showDuckHelper(`Parabéns! Você completou o tópico ${topicsData[this.currentTopic].title}!`);
        }
    }
}

// Funções globais para compatibilidade
function startTopic(topicKey) {
    if (window.exerciseSystem) {
        window.exerciseSystem.startExercise(topicKey);
    }
}

function selectAnswer(optionIndex) {
    if (window.exerciseSystem) {
        window.exerciseSystem.selectAnswer(optionIndex);
    }
}

function submitExerciseAnswer() {
    if (window.exerciseSystem) {
        window.exerciseSystem.submitAnswer();
    }
}

function closeExerciseModal() {
    if (window.exerciseSystem) {
        window.exerciseSystem.closeExerciseModal();
    }
}

// Configurar event listeners
function setupEventListeners() {
    // Event listeners para tópicos
    const topicItems = document.querySelectorAll('.topic-item');
    topicItems.forEach(item => {
        item.addEventListener('click', function() {
            if (this.classList.contains('enabled')) {
                const topicKey = this.getAttribute('data-topic');
                startTopic(topicKey);
            }
        });
    });

    // Event listener para fechar painel
    const closePanel = document.getElementById('closePanel');
    if (closePanel) {
        closePanel.addEventListener('click', function() {
            document.getElementById('topicPanel').classList.remove('active');
        });
    }

    // Event listeners para fechar modais
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal')) {
            e.target.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal.active');
            if (activeModal) {
                activeModal.classList.remove('active');
            }
        }
    });
}

// Funções auxiliares
function showDuckHelper(message) {
    const helper = document.getElementById('duckHelper');
    const helperMessage = document.getElementById('helperMessage');
    
    if (helper && helperMessage) {
        helperMessage.textContent = message;
        helper.classList.add('active');
        
        setTimeout(() => {
            helper.classList.remove('active');
        }, 5000);
    }
}

function showCelebration() {
    const celebration = document.getElementById('celebration');
    if (celebration) {
        celebration.classList.add('active');
        
        // Criar confetes
        createConfetti();
        
        setTimeout(() => {
            celebration.classList.remove('active');
        }, 5000);
    }
}

function createConfetti() {
    const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3'];
    
    for (let i = 0; i < 50; i++) {
        setTimeout(() => {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDelay = Math.random() * 3 + 's';
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                confetti.remove();
            }, 3000);
        }, i * 100);
    }
}

// Exportar para uso global
window.initializeFrontendTrack = initializeFrontendTrack;
window.startTopic = startTopic;
window.selectAnswer = selectAnswer;
window.submitExerciseAnswer = submitExerciseAnswer;
window.closeExerciseModal = closeExerciseModal;
window.showDuckHelper = showDuckHelper;
window.showCelebration = showCelebration;