/**
 * Sistema Base para Trilhas de Aprendizado
 * Funcionalidades comuns reutilizáveis entre todas as trilhas
 */

// Classe base para gerenciamento de progresso
class TrackProgressBase {
    constructor(trackName) {
        this.trackName = trackName;
        this.storageKey = `trilha_${trackName}_progress`;
        this.pointsKey = `trilha_${trackName}_points`;
        this.completedKey = `trilha_${trackName}_completed`;
        this.data = this.loadProgress();
    }

    loadProgress() {
        const saved = localStorage.getItem(this.storageKey);
        return saved ? JSON.parse(saved) : {};
    }

    saveProgress() {
        localStorage.setItem(this.storageKey, JSON.stringify(this.data));
    }

    updateTopicProgress(topicIndex, exerciseIndex) {
        if (!this.data[topicIndex]) {
            this.data[topicIndex] = { exercises: [], completed: false };
        }
        
        if (!this.data[topicIndex].exercises.includes(exerciseIndex)) {
            this.data[topicIndex].exercises.push(exerciseIndex);
        }
        
        this.saveProgress();
    }

    markTopicCompleted(topicIndex) {
        if (!this.data[topicIndex]) {
            this.data[topicIndex] = { exercises: [], completed: false };
        }
        this.data[topicIndex].completed = true;
        this.saveProgress();
    }

    getTopicProgress(topicIndex, totalExercises) {
        if (!this.data[topicIndex]) return 0;
        return (this.data[topicIndex].exercises.length / totalExercises) * 100;
    }

    isTopicCompleted(topicIndex) {
        return this.data[topicIndex] && this.data[topicIndex].completed;
    }

    getTotalPoints() {
        const saved = localStorage.getItem(this.pointsKey);
        return saved ? parseInt(saved) : 0;
    }

    addPoints(points) {
        const current = this.getTotalPoints();
        localStorage.setItem(this.pointsKey, (current + points).toString());
    }

    getCompletedTopics() {
        const saved = localStorage.getItem(this.completedKey);
        return saved ? JSON.parse(saved) : [];
    }

    addCompletedTopic(topicIndex) {
        const completed = this.getCompletedTopics();
        if (!completed.includes(topicIndex)) {
            completed.push(topicIndex);
            localStorage.setItem(this.completedKey, JSON.stringify(completed));
        }
    }
}

// Classe base para sistema de exercícios
class ExerciseSystemBase {
    constructor(trackName, topicsData) {
        this.trackName = trackName;
        this.topicsData = topicsData;
        this.currentTopic = null;
        this.currentExercise = 0;
        this.selectedAnswer = null;
        this.progress = new TrackProgressBase(trackName);
        this.initializeElements();
    }

    initializeElements() {
        // Elementos do modal de exercícios
        this.modal = document.getElementById('exerciseModal');
        this.questionElement = document.getElementById('exerciseQuestion');
        this.optionsContainer = document.getElementById('exerciseOptions');
        this.submitBtn = document.getElementById('submitAnswer');
        this.nextBtn = document.getElementById('nextExercise');
        this.closeBtn = document.getElementById('closeExercise');
        this.feedbackElement = document.getElementById('exerciseFeedback');
        
        // Elementos de progresso
        this.progressElements = {
            fill: document.querySelector('.overall-progress-fill'),
            topics: document.getElementById('topicsCompleted'),
            exercises: document.getElementById('exercisesCompleted'),
            points: document.getElementById('totalPoints')
        };
    }

    showExerciseModal(topicIndex, exerciseIndex = 0) {
        console.log('Iniciando exercício:', { topicIndex, exerciseIndex });
        
        if (!this.modal || !this.questionElement || !this.optionsContainer) {
            console.error('Elementos do modal não encontrados');
            return;
        }

        const topic = this.topicsData[topicIndex];
        if (!topic || !topic.exercises || !Array.isArray(topic.exercises)) {
            console.error('Tópico ou exercícios inválidos:', topic);
            return;
        }

        const exercise = topic.exercises[exerciseIndex];
        if (!exercise) {
            console.error('Exercício não encontrado:', exerciseIndex);
            return;
        }

        console.log('Exercício atual:', exercise);
        console.log('Opções do exercício:', exercise.options);

        this.currentTopic = topicIndex;
        this.currentExercise = exerciseIndex;
        this.selectedAnswer = null;

        // Configurar pergunta
        this.questionElement.textContent = exercise.question;

        // Limpar opções anteriores
        this.optionsContainer.innerHTML = '';
        console.log('Container de opções limpo');

        // Criar botões de opção
        if (Array.isArray(exercise.options)) {
            exercise.options.forEach((option, index) => {
                console.log(`Processando opção ${index}:`, option);
                
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = `${String.fromCharCode(65 + index)}) ${option}`;
                button.onclick = () => this.selectOption(index, button);
                
                this.optionsContainer.appendChild(button);
                console.log(`Botão criado para opção ${index}:`, button.textContent);
            });
        } else {
            console.warn('Opções não são um array:', exercise.options);
        }

        console.log('HTML final do container de opções:', this.optionsContainer.innerHTML);
        console.log('Conteúdo final do container:', this.optionsContainer.textContent);

        // Resetar botões
        if (this.submitBtn) {
            this.submitBtn.style.display = 'inline-block';
            this.submitBtn.disabled = true;
        }
        if (this.nextBtn) {
            this.nextBtn.style.display = 'none';
        }
        if (this.feedbackElement) {
            this.feedbackElement.style.display = 'none';
        }

        // Mostrar modal
        this.modal.classList.add('active');
        console.log('Modal de exercício exibido');
    }

    selectOption(optionIndex, buttonElement) {
        // Remover seleção anterior
        document.querySelectorAll('.option-btn').forEach(btn => {
            btn.classList.remove('selected');
        });
        
        // Selecionar nova opção
        buttonElement.classList.add('selected');
        this.selectedAnswer = optionIndex;
        
        // Habilitar botão de envio
        if (this.submitBtn) {
            this.submitBtn.disabled = false;
        }
    }

    submitAnswer() {
        if (this.selectedAnswer === null) return;

        const topic = this.topicsData[this.currentTopic];
        const exercise = topic.exercises[this.currentExercise];
        const isCorrect = this.selectedAnswer === exercise.correct;

        // Mostrar feedback visual
        document.querySelectorAll('.option-btn').forEach((btn, index) => {
            if (index === exercise.correct) {
                btn.classList.add('correct');
            } else if (index === this.selectedAnswer && !isCorrect) {
                btn.classList.add('incorrect');
            }
        });

        // Mostrar feedback textual
        if (this.feedbackElement) {
            this.feedbackElement.textContent = exercise.explanation || (isCorrect ? 'Correto!' : 'Incorreto!');
            this.feedbackElement.className = `exercise-feedback ${isCorrect ? 'correct' : 'incorrect'}`;
            this.feedbackElement.style.display = 'block';
        }

        // Atualizar progresso
        if (isCorrect) {
            this.progress.updateTopicProgress(this.currentTopic, this.currentExercise);
            this.progress.addPoints(10);
        }

        // Controlar botões
        if (this.submitBtn) {
            this.submitBtn.style.display = 'none';
        }
        if (this.nextBtn) {
            this.nextBtn.style.display = 'inline-block';
        }

        this.updateProgressDisplay();
    }

    nextExercise() {
        const topic = this.topicsData[this.currentTopic];
        
        if (this.currentExercise < topic.exercises.length - 1) {
            // Próximo exercício
            this.showExerciseModal(this.currentTopic, this.currentExercise + 1);
        } else {
            // Tópico concluído
            this.progress.markTopicCompleted(this.currentTopic);
            this.progress.addCompletedTopic(this.currentTopic);
            this.closeExerciseModal();
            this.showCelebration();
            this.updateProgressDisplay();
            this.updateTopicDisplay();
        }
    }

    closeExerciseModal() {
        if (this.modal) {
            this.modal.classList.remove('active');
        }
    }

    updateProgressDisplay() {
        const completedTopics = this.progress.getCompletedTopics();
        const totalTopics = this.topicsData.length;
        const totalPoints = this.progress.getTotalPoints();
        
        // Calcular exercícios completados
        let completedExercises = 0;
        let totalExercises = 0;
        
        this.topicsData.forEach((topic, index) => {
            totalExercises += topic.exercises.length;
            if (this.progress.data[index]) {
                completedExercises += this.progress.data[index].exercises.length;
            }
        });

        // Atualizar elementos de progresso
        if (this.progressElements.fill) {
            const overallProgress = (completedTopics.length / totalTopics) * 100;
            this.progressElements.fill.style.width = `${overallProgress}%`;
        }
        
        if (this.progressElements.topics) {
            this.progressElements.topics.textContent = `${completedTopics.length}/${totalTopics}`;
        }
        
        if (this.progressElements.exercises) {
            this.progressElements.exercises.textContent = `${completedExercises}/${totalExercises}`;
        }
        
        if (this.progressElements.points) {
            this.progressElements.points.textContent = totalPoints;
        }
    }

    updateTopicDisplay() {
        document.querySelectorAll('.topic-item').forEach((item, index) => {
            const progressBar = item.querySelector('.progress-fill');
            const statusIcon = item.querySelector('.topic-status');
            
            if (this.progress.isTopicCompleted(index)) {
                item.classList.add('completed');
                if (progressBar) progressBar.style.width = '100%';
                if (statusIcon) statusIcon.textContent = '✅';
            } else {
                const topic = this.topicsData[index];
                if (topic && topic.exercises) {
                    const progress = this.progress.getTopicProgress(index, topic.exercises.length);
                    if (progressBar) progressBar.style.width = `${progress}%`;
                    if (statusIcon) statusIcon.textContent = progress > 0 ? '🔄' : '⭕';
                }
            }
        });
    }

    showCelebration() {
        // Implementação básica de celebração
        // Pode ser sobrescrita por classes filhas
        console.log('🎉 Tópico concluído! Parabéns!');
    }
}

// Funções utilitárias globais
window.TrackUtils = {
    // Função para inicializar uma trilha
    initializeTrack: function(trackName, topicsData) {
        return new ExerciseSystemBase(trackName, topicsData);
    },
    
    // Função para mostrar painel lateral
    showSidePanel: function(topicIndex, topicsData) {
        const panel = document.getElementById('sidePanel');
        if (!panel) return;
        
        const topic = topicsData[topicIndex];
        if (!topic) return;
        
        // Atualizar conteúdo do painel
        const titleElement = panel.querySelector('.panel-header h3');
        if (titleElement) {
            titleElement.textContent = topic.title || `Tópico ${topicIndex + 1}`;
        }
        
        panel.classList.add('active');
    },
    
    // Função para fechar painel lateral
    closeSidePanel: function() {
        const panel = document.getElementById('sidePanel');
        if (panel) {
            panel.classList.remove('active');
        }
    },
    
    // Função para iniciar exercícios de um tópico
    startExercises: function(topicIndex, exerciseSystem) {
        if (exerciseSystem && typeof exerciseSystem.showExerciseModal === 'function') {
            exerciseSystem.showExerciseModal(topicIndex, 0);
        }
    }
};

// Exportar classes para uso global
window.TrackProgressBase = TrackProgressBase;
window.ExerciseSystemBase = ExerciseSystemBase;

console.log('Sistema base de trilhas carregado com sucesso!');