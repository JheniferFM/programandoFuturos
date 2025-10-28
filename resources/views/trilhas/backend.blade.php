@extends('layouts.app')

@section('content')
<div class="trilha-container">
    {{-- Mantivemos seu CSS diretamente aqui para facilitar --}}
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

        /* Barra de Progresso Geral */
        .trilha-progress {
            background-color: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .progress-stats {
            display: flex;
            gap: 2rem;
            font-size: 0.9rem;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-orange);
        }

        .overall-progress-bar {
            height: 12px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .overall-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary-orange));
            border-radius: 6px;
            transition: width 0.5s ease;
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

        /* Trilha Interativa */
        .trilha-interactive {
            display: flex;
            gap: 2rem;
            position: relative;
        }

        .trilha-path {
            flex: 1;
        }

        .path-title {
            font-family: var(--font-display);
            font-size: 2rem;
            color: var(--heading-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        .topics-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .topic-item {
            display: flex;
            align-items: center;
            background-color: var(--card-background);
            border: 2px solid var(--border-blue);
            border-radius: 15px;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .topic-item:hover {
            border-color: var(--primary-blue);
            transform: translateX(10px);
            box-shadow: 0 8px 25px rgba(0,188,212,0.3);
        }

        .topic-item.active {
            border-color: var(--secondary-orange);
            background-color: rgba(255, 140, 0, 0.1);
        }

        .topic-item.completed {
            border-color: #4caf50;
            background-color: rgba(76, 175, 80, 0.1);
        }

        .topic-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background-color: var(--primary-blue);
            color: var(--background-dark-blue);
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.2rem;
            margin-right: 1.5rem;
        }

        .topic-content {
            flex: 1;
        }

        .topic-content h3 {
            font-family: var(--font-display);
            font-size: 1.4rem;
            color: var(--heading-color);
            margin-bottom: 0.5rem;
        }

        .topic-progress {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .progress-bar {
            flex: 1;
            height: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }
        
        .progress-text {
            font-size: 12px;
            color: #666;
            font-weight: 500;
            min-width: 80px;
            white-space: nowrap;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary-orange));
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .points {
            font-weight: 700;
            color: var(--secondary-orange);
            font-size: 0.9rem;
        }

        .topic-status {
            font-size: 1.5rem;
            margin-left: 1rem;
        }

        /* Painel Lateral */
        .side-panel {
            position: fixed;
            top: 0;
            right: -500px;
            width: 500px;
            height: 100vh;
            background-color: var(--card-background);
            border-left: 2px solid var(--border-blue);
            z-index: 1000;
            transition: right 0.3s ease;
            overflow-y: auto;
        }

        .side-panel.active {
            right: 0;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
            border-bottom: 1px solid var(--border-blue);
            background-color: var(--background-dark-blue);
        }

        .panel-header h3 {
            font-family: var(--font-display);
            color: var(--heading-color);
            margin: 0;
        }

        .close-panel {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 2rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-panel:hover {
            color: var(--secondary-orange);
        }

        .panel-content {
            padding: 2rem;
        }

        .resource-section {
            margin-bottom: 2rem;
        }

        .resource-section h4 {
            font-family: var(--font-display);
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .resource-list {
            list-style: none;
            padding: 0;
        }

        .resource-item {
            background-color: rgba(0, 188, 212, 0.1);
            border: 1px solid var(--primary-blue);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .resource-item:hover {
            background-color: rgba(0, 188, 212, 0.2);
            transform: translateY(-2px);
        }

        .resource-link {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .resource-link:hover {
            color: var(--secondary-orange);
        }

        .start-topic-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-orange));
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .start-topic-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,188,212,0.4);
        }

        /* Modal de Exercícios */
        .exercise-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .exercise-modal.active {
            display: flex;
        }

        .exercise-content {
            background-color: var(--card-background);
            border: 2px solid var(--border-blue);
            border-radius: 15px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .exercise-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-blue);
        }

        .exercise-question {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .exercise-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .option-btn {
            padding: 1rem;
            background-color: rgba(0, 188, 212, 0.1);
            border: 2px solid var(--primary-blue);
            border-radius: 10px;
            color: var(--text-color);
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
        }

        .option-btn:hover {
            background-color: rgba(0, 188, 212, 0.2);
            transform: translateX(5px);
        }

        .option-btn.selected {
            background-color: rgba(255, 140, 0, 0.2);
            border-color: var(--secondary-orange);
        }

        .option-btn.correct {
            background-color: rgba(76, 175, 80, 0.2);
            border-color: #4caf50;
        }

        .option-btn.incorrect {
            background-color: rgba(244, 67, 54, 0.2);
            border-color: #f44336;
        }

        .exercise-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn-secondary {
            padding: 0.8rem 1.5rem;
            background-color: transparent;
            border: 2px solid var(--border-blue);
            color: var(--text-color);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--border-blue);
        }

        .btn-primary {
            padding: 0.8rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-orange));
            border: none;
            color: white;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,188,212,0.4);
        }

        .exercise-feedback {
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 10px;
            display: none;
        }

        .exercise-feedback.correct {
            background-color: rgba(76, 175, 80, 0.2);
            border: 1px solid #4caf50;
            color: #4caf50;
        }

        .exercise-feedback.incorrect {
            background-color: rgba(244, 67, 54, 0.2);
            border: 1px solid #f44336;
            color: #f44336;
        }

        /* Animação de Celebração */
        .celebration-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .celebration-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .celebration-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            border-radius: 25px;
            text-align: center;
            color: white;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.5);
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
            border: 3px solid rgba(255, 215, 0, 0.3);
        }

        .celebration-overlay.show .celebration-content {
            transform: scale(1);
        }

        .celebration-header {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .celebration-icon-container {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .celebration-icon {
            font-size: 4rem;
            animation: bounce 1s infinite;
            filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.5));
        }

        .celebration-sparkles {
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 1.5rem;
            animation: sparkle 2s ease-in-out infinite;
        }

        .celebration-title {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #FFD700, #FFA500, #FFD700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
            letter-spacing: 2px;
        }

        .celebration-subtitle {
            font-size: 1.3rem;
            font-weight: bold;
            color: #FFD700;
            margin-bottom: 1.5rem;
            animation: glow 2s ease-in-out infinite alternate;
        }

        .achievement-banner {
            background: linear-gradient(45deg, rgba(255, 215, 0, 0.2), rgba(255, 165, 0, 0.2));
            border: 2px solid #FFD700;
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .achievement-icon {
            font-size: 2.5rem;
            animation: rotate 3s linear infinite;
        }

        .achievement-text {
            text-align: left;
        }

        .achievement-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #FFD700;
            margin-bottom: 0.3rem;
        }

        .achievement-desc {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .celebration-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        .celebration-stat {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 215, 0, 0.3);
            flex: 1;
        }

        .stat-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .celebration-stat-value {
            font-size: 2.2rem;
            font-weight: bold;
            color: #FFD700;
            margin-bottom: 0.3rem;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .celebration-stat-label {
            font-size: 0.85rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .level-up-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 2px solid rgba(255, 215, 0, 0.4);
        }

        .level-badge {
            background: linear-gradient(45deg, #FF6B6B, #FF8E53);
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            display: inline-block;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }

        .level-number {
            font-size: 0.8rem;
            font-weight: bold;
            opacity: 0.9;
        }

        .level-value {
            font-size: 1.5rem;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .level-message p {
            margin: 0.5rem 0;
            font-size: 1.1rem;
        }

        .next-steps {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .next-steps h4 {
            margin: 0 0 1rem 0;
            font-size: 1.2rem;
            color: #FFD700;
        }

        .unlock-list {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .unlock-item {
            background: rgba(76, 175, 80, 0.2);
            border: 1px solid #4CAF50;
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: 500;
            animation: unlock-glow 2s ease-in-out infinite alternate;
        }

        .celebration-close {
            background: linear-gradient(45deg, #FF6B6B, #FF8E53, #FF6B6B);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 auto;
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .celebration-close:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 35px rgba(255, 107, 107, 0.6);
        }

        .celebration-close:active {
            transform: translateY(-1px) scale(1.02);
        }

        .btn-icon {
            font-size: 1.3rem;
            animation: pulse 2s ease-in-out infinite;
        }

        /* Estilos do Patinho da TI */
        .patinho-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 2px solid rgba(255, 215, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .patinho-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 215, 0, 0.1), transparent);
            animation: shimmer 3s ease-in-out infinite;
        }

        .patinho-character {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            position: relative;
            z-index: 1;
        }

        .patinho-avatar {
            width: 80px;
            height: 80px;
            animation: duck-bob 2s ease-in-out infinite;
            filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.5));
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .patinho-avatar .duck-svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(3px 3px 6px rgba(0,0,0,0.3));
        }

        .patinho-speech-bubble {
            background: rgba(255, 255, 255, 0.95);
            color: #333;
            border-radius: 15px;
            padding: 1rem;
            position: relative;
            flex: 1;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .patinho-speech-bubble::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 20px;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-right: 15px solid rgba(255, 255, 255, 0.95);
        }

        .speech-text {
            font-size: 1rem;
            line-height: 1.4;
            margin-bottom: 0.5rem;
            font-style: italic;
        }

        .patinho-name {
            font-size: 0.85rem;
            font-weight: bold;
            color: #666;
            text-align: right;
        }

        /* Animações */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        @keyframes sparkle {
            0%, 100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
            50% {
                transform: scale(1.2) rotate(180deg);
                opacity: 0.7;
            }
        }

        @keyframes glow {
            0% {
                text-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
            }
            100% {
                text-shadow: 0 0 20px rgba(255, 215, 0, 0.8), 0 0 30px rgba(255, 215, 0, 0.6);
            }
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes unlock-glow {
            0% {
                box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
            }
            100% {
                box-shadow: 0 0 15px rgba(76, 175, 80, 0.6), 0 0 25px rgba(76, 175, 80, 0.4);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        @keyframes duck-bob {
            0%, 100% {
                transform: translateY(0) rotate(-2deg);
            }
            50% {
                transform: translateY(-8px) rotate(2deg);
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }
            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        /* Estilos do Patinho Helper */
        .patinho-helper {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .patinho-container {
            position: relative;
        }

        .patinho-avatar-small {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
            transition: all 0.3s ease;
            animation: duck-bob 2s ease-in-out infinite;
            padding: 8px;
        }

        .duck-svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.2));
        }

        .patinho-avatar-small:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.6);
        }

        .patinho-tooltip {
            position: absolute;
            bottom: 70px;
            right: 0;
            background: white;
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            min-width: 250px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .patinho-tooltip.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .patinho-tooltip::after {
            content: '';
            position: absolute;
            bottom: -8px;
            right: 20px;
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-top: 8px solid white;
        }

        .patinho-message {
            color: #333;
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: 1rem;
        }

        .patinho-btn {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-orange));
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            margin: 0.2rem;
            transition: all 0.3s ease;
        }

        .patinho-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Modal de Dicas */
        .patinho-tips-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .patinho-tips-modal.show {
            display: flex;
        }

        .patinho-tips-content {
            background: white;
            border-radius: 20px;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .patinho-tips-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-orange));
            color: white;
            padding: 1.5rem;
            border-radius: 20px 20px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .patinho-tips-header h3 {
            margin: 0;
            font-size: 1.5rem;
        }

        .close-patinho-tips {
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
        }

        .patinho-tips-body {
            padding: 2rem;
        }

        .tip-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(0, 188, 212, 0.1);
            border-radius: 15px;
            border-left: 4px solid var(--primary-blue);
        }

        .tip-icon {
            font-size: 2rem;
            flex-shrink: 0;
        }

        .tip-content h4 {
            margin: 0 0 0.5rem 0;
            color: var(--primary-blue);
        }

        .tip-content p {
            margin: 0;
            color: #666;
            line-height: 1.4;
        }



        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        .confetti {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #FFD700;
            animation: confetti-fall 3s linear infinite;
        }

        .confetti:nth-child(2n) { background: #FF6B6B; animation-delay: -0.5s; }
        .confetti:nth-child(3n) { background: #4ECDC4; animation-delay: -1s; }
        .confetti:nth-child(4n) { background: #45B7D1; animation-delay: -1.5s; }
        .confetti:nth-child(5n) { background: #96CEB4; animation-delay: -2s; }

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

    <div class="trilha-progress">
        <div class="progress-header">
            <h3>Progresso da Trilha</h3>
            <div class="progress-stats">
                <div class="stat-item">
                    <span class="stat-value" id="currentPoints">0</span>
                    <span>XP Atual</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="totalPoints">700</span>
                    <span>XP Total</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="completedTopics">0/5</span>
                    <span>Tópicos</span>
                </div>
            </div>
        </div>
        <div class="overall-progress-bar">
            <div class="overall-progress-fill" id="overallProgressFill" style="width: 0%"></div>
        </div>
        <div style="text-align: center; font-size: 0.9rem; color: var(--text-color);">
            <span id="progressPercentage">0%</span> concluído - <span id="remainingPoints">700 XP</span> restantes
        </div>
    </div>


    <div class="trilha-interactive">
        <div class="trilha-path">
            <h2 class="path-title">Caminho de Aprendizado</h2>
            <div class="topics-container">
                <div class="topic-item" data-topic="logica" data-points="100">
                    <div class="topic-number">1</div>
                    <div class="topic-content">
                        <h3>Lógica de Programação</h3>
                        <div class="topic-progress">
                            <span class="points">+100 XP</span>
                        </div>
                    </div>
                    <div id="status-logica" class="topic-status">⭕</div>
                </div>

                <div class="topic-item" data-topic="linguagem" data-points="150">
                    <div class="topic-number">2</div>
                    <div class="topic-content">
                        <h3>Linguagem (PHP & Laravel)</h3>
                        <div class="topic-progress">
                            <span class="points">+150 XP</span>
                        </div>
                    </div>
                    <div id="status-linguagem" class="topic-status">🔒</div>
                </div>

                <div class="topic-item" data-topic="banco_dados" data-points="150">
                    <div class="topic-number">3</div>
                    <div class="topic-content">
                        <h3>Bancos de Dados & SQL</h3>
                        <div class="topic-progress">
                            <span class="points">+150 XP</span>
                        </div>
                    </div>
                    <div id="status-banco_dados" class="topic-status">🔒</div>
                </div>

                <div class="topic-item" data-topic="apis" data-points="150">
                    <div class="topic-number">4</div>
                    <div class="topic-content">
                        <h3>APIs e Serviços (REST)</h3>
                        <div class="topic-progress">
                            <span class="points">+150 XP</span>
                        </div>
                    </div>
                    <div id="status-apis" class="topic-status">🔒</div>
                </div>

                <div class="topic-item" data-topic="testes_devops" data-points="150">
                    <div class="topic-number">5</div>
                    <div class="topic-content">
                        <h3>Testes e Boas Práticas</h3>
                        <div class="topic-progress">
                            <span class="points">+150 XP</span>
                        </div>
                    </div>
                    <div id="status-testes_devops" class="topic-status">🔒</div>
                </div>
            </div>
        </div>

        <div class="side-panel" id="sidePanel">
            <div class="panel-header">
                <h3 id="panelTitle">Selecione um tópico</h3>
                <button class="close-panel" id="closePanel">×</button>
            </div>
            <div class="panel-content" id="panelContent">
                <p>Clique em um tópico para ver os detalhes, recursos de aprendizado e começar sua jornada!</p>
            </div>
        </div>
    </div>

    <div class="patinho-helper" id="patinhoHelper">
        <div class="patinho-container">
            <div class="patinho-avatar-small" onclick="togglePatinhoTips()">
                <svg class="duck-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="50" cy="65" rx="35" ry="25" fill="#FFD700" stroke="#FFA500" stroke-width="1"/>
                    <circle cx="50" cy="35" r="20" fill="#FFD700" stroke="#FFA500" stroke-width="1"/>
                    <ellipse cx="65" cy="38" rx="8" ry="4" fill="#FF8C00"/>
                    <circle cx="45" cy="30" r="3" fill="#000"/>
                    <circle cx="46" cy="29" r="1" fill="#FFF"/>
                    <ellipse cx="35" cy="55" rx="12" ry="8" fill="#FFA500" transform="rotate(-20 35 55)"/>
                    <ellipse cx="40" cy="25" rx="6" ry="8" fill="#FFFF99" opacity="0.6"/>
                    <ellipse cx="35" cy="55" rx="15" ry="10" fill="#FFFF99" opacity="0.4"/>
                </svg>
            </div>
            <div class="patinho-tooltip" id="patinhoTooltip">
                <div class="tooltip-content">
                    <div class="patinho-message" id="patinhoMessage">
                        Olá! Sou o Patinho da TI! 🦆<br>
                        Precisa de uma dica ou quer conversar sobre algum problema? Clique em mim!
                    </div>
                    <button class="patinho-btn" onclick="showPatinhoTips()">💡 Dicas</button>
                </div>
            </div>
        </div>
    </div>

    <div class="patinho-tips-modal" id="patinhoTipsModal">
        <div class="patinho-tips-content">
            <div class="patinho-tips-header">
                <h3>💡 Dicas do Patinho da TI</h3>
                <button class="close-patinho-tips" onclick="closePatinhoTips()">×</button>
            </div>
            <div class="patinho-tips-body">
                <div class="tip-item">
                    <div class="tip-icon">🎯</div>
                    <div class="tip-content">
                        <h4>Foque na Lógica</h4>
                        <p>A linguagem pode mudar, mas uma boa lógica de programação é universal!</p>
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">🔄</div>
                    <div class="tip-content">
                        <h4>Pense em 'Request/Response'</h4>
                        <p>No back-end, quase tudo se resume a receber um pedido (request) e devolver uma resposta (response).</p>
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">🐛</div>
                    <div class="tip-content">
                        <h4>Aprenda a Ler Logs</h4>
                        <p>Os logs de erro são seus melhores amigos para debugar. Não tenha medo deles!</p>
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">📚</div>
                    <div class="tip-content">
                        <h4>Entenda o Básico de SQL</h4>
                        <p>Saber como seus dados são guardados e acessados é crucial para um bom back-end.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="exercise-modal" id="exerciseModal">
        <div class="exercise-content">
            <div class="exercise-header">
                <h3 id="exerciseTitle">Exercício</h3>
                <button class="close-panel" onclick="closeExerciseModal()">&times;</button>
            </div>
            <div class="exercise-question" id="exerciseQuestion"></div>
            <div class="exercise-options" id="exerciseOptions"></div>
            <div class="exercise-feedback" id="exerciseFeedback"></div>
            <div class="exercise-actions">
                <button class="btn-secondary" id="cancelExercise" onclick="closeExerciseModal()">Cancelar</button>
                <button class="btn-primary" id="submitAnswer" disabled>Responder</button>
            </div>
        </div>
    </div>

    <div class="celebration-overlay" id="celebrationOverlay">
        <div class="celebration-content">
            <div class="celebration-header">
                <div class="celebration-icon-container">
                    <div class="celebration-icon">🎯</div>
                    <div class="celebration-sparkles">✨</div>
                </div>
                <h2 class="celebration-title">TRILHA CONCLUÍDA!</h2>
                <div class="celebration-subtitle">🚀 JORNADA BACK-END FINALIZADA! 🚀</div>
            </div>
            
            <div class="achievement-banner">
                <div class="achievement-icon">🏅</div>
                <div class="achievement-text">
                    <div class="achievement-name">"Arquiteto(a) de Servidores"</div>
                    <div class="achievement-desc">Completou todos os módulos da trilha</div>
                </div>
            </div>
            
            <div class="celebration-stats">
                <div class="celebration-stat">
                    <div class="stat-icon">⚡</div>
                    <div class="celebration-stat-value">700</div>
                    <div class="celebration-stat-label">XP Coletados</div>
                </div>
                <div class="celebration-stat">
                    <div class="stat-icon">📚</div>
                    <div class="celebration-stat-value">5</div>
                    <div class="celebration-stat-label">Módulos Concluídos</div>
                </div>
                <div class="celebration-stat">
                    <div class="stat-icon">✅</div>
                    <div class="celebration-stat-value">15</div>
                    <div class="celebration-stat-label">Exercícios Resolvidos</div>
                </div>
            </div>
            
            <div class="patinho-section">
                <div class="patinho-character">
                    <div class="patinho-avatar">
                        <svg class="duck-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <ellipse cx="50" cy="65" rx="35" ry="25" fill="#FFD700" stroke="#FFA500" stroke-width="1.5"/>
                            <circle cx="50" cy="35" r="20" fill="#FFD700" stroke="#FFA500" stroke-width="1.5"/>
                            <ellipse cx="65" cy="38" rx="8" ry="4" fill="#FF8C00"/>
                            <circle cx="45" cy="30" r="3" fill="#000"/>
                            <circle cx="46" cy="29" r="1" fill="#FFF"/>
                            <ellipse cx="35" cy="55" rx="12" ry="8" fill="#FFA500" transform="rotate(-20 35 55)"/>
                            <ellipse cx="40" cy="25" rx="6" ry="8" fill="#FFFF99" opacity="0.6"/>
                            <ellipse cx="35" cy="55" rx="15" ry="10" fill="#FFFF99" opacity="0.4"/>
                            <ellipse cx="50" cy="70" rx="30" ry="20" fill="#FFA500" opacity="0.3"/>
                        </svg>
                    </div>
                    <div class="patinho-speech-bubble">
                        <div class="speech-text">
                            "Quack! Parabéns, dev! Você dominou os servidores! Como seu Patinho da TI, estou impressionado com suas habilidades de back-end! 🎉"
                        </div>
                        <div class="patinho-name">- Patinho da TI</div>
                    </div>
                </div>
            </div>
            
            <div class="level-up-section">
                <div class="level-badge">
                    <div class="level-number">PROGRESSO</div>
                    <div class="level-value">TRILHA 1/5</div>
                </div>
                <div class="level-message">
                    <p>🎉 <strong>PRIMEIRA TRILHA COMPLETA!</strong></p>
                    <p>Você construiu a fundação para aplicações robustas!</p>
                </div>
            </div>
            
            <div class="next-steps">
                <h4>🎯 Próximas Trilhas Disponíveis:</h4>
                <div class="unlock-list">
                    <div class="unlock-item">🔓 Trilha de Front-End (Fullstack)</div>
                    <div class="unlock-item">🔓 Trilha de DevOps Avançado</div>
                    <div class="unlock-item">🔓 Trilha de Microsserviços</div>
                </div>
            </div>
            
            <button class="celebration-close" onclick="closeCelebration()">
                <span class="btn-icon">🎮</span>
                Continuar Aventura
            </button>
        </div>
    </div>

    <script>
        // Sistema de Persistência
        class TrackProgress {
            constructor() {
                const userId = {{ $user ? $user->id : 'guest' }};
                // Chave de armazenamento alterada para 'backend'
                this.storageKey = `backend_track_progress_user_${userId}`;
                this.data = this.loadProgress();
                this.updateUI();
            }

            loadProgress() {
                const saved = localStorage.getItem(this.storageKey);
                return saved ? JSON.parse(saved) : {
                    totalPoints: 0,
                    completedTopics: 0,
                    topicProgress: {},
                    exercisesCompleted: {}
                };
            }

            saveProgress() {
                localStorage.setItem(this.storageKey, JSON.stringify(this.data));
                this.updateUI();
            }

            resetProgress() {
                localStorage.removeItem(this.storageKey);
                this.data = {
                    totalPoints: 0,
                    completedTopics: 0,
                    topicProgress: {},
                    exercisesCompleted: {}
                };
                this.updateUI();
            }

            addPoints(points, topicKey) {
                this.data.totalPoints += points;
                if (!this.data.topicProgress[topicKey]) {
                    this.data.topicProgress[topicKey] = { points: 0, completed: false };
                }
                this.data.topicProgress[topicKey].points += points;
                // Salvar sem chamar updateUI (será chamado manualmente)
                localStorage.setItem(this.storageKey, JSON.stringify(this.data));

                // Sincronizar pontos com o backend para refletir no ranking
                if (window.syncTrailPoints) {
                    // Sincronização alterada para 'backend'
                    window.syncTrailPoints(points, `backend:${topicKey}`);
                }
            }

            completeExercise(topicKey, exerciseId) {
                if (!this.data.exercisesCompleted[topicKey]) {
                    this.data.exercisesCompleted[topicKey] = [];
                }
                
                if (!this.data.exercisesCompleted[topicKey].includes(exerciseId)) {
                    this.data.exercisesCompleted[topicKey].push(exerciseId);
                    // Pontos por exercício (ex: 20xp)
                    this.addPoints(20, topicKey); 
                    this.updateUI(); // Atualizar UI imediatamente após completar exercício
                }
            }

            completeTopic(topicKey) {
                if (!this.data.topicProgress[topicKey]?.completed) {
                    this.data.completedTopics++;
                    this.data.topicProgress[topicKey] = this.data.topicProgress[topicKey] || { points: 0 };
                    this.data.topicProgress[topicKey].completed = true;
                    // Adiciona os pontos principais do tópico ao completar
                    this.addPoints(topicsData[topicKey].points, topicKey); 
                    this.updateUI(); // Atualizar UI imediatamente após completar tópico
                }
            }

            updateUI() {
                // Pontuação total alterada para 700 (100 + 150 + 150 + 150 + 150)
                const totalPossiblePoints = 700; 
                const progressPercentage = Math.round((this.data.totalPoints / totalPossiblePoints) * 100);
                
                document.getElementById('currentPoints').textContent = this.data.totalPoints;
                document.getElementById('totalPoints').textContent = totalPossiblePoints;
                document.getElementById('completedTopics').textContent = `${this.data.completedTopics}/5`;
                document.getElementById('progressPercentage').textContent = `${progressPercentage}%`;
                document.getElementById('remainingPoints').textContent = `${totalPossiblePoints - this.data.totalPoints} XP`;
                document.getElementById('overallProgressFill').style.width = `${progressPercentage}%`;
                
                // Atualizar estado visual dos tópicos
                Object.keys(topicsData).forEach(topicKey => {
                    const topicElement = document.querySelector(`[data-topic="${topicKey}"]`);
                    if (topicElement) {
                        const progress = this.data.topicProgress[topicKey];
                        const status = topicElement.querySelector('.topic-status');
                        
                        if (progress && progress.completed) {
                            topicElement.classList.add('completed');
                            if (status) status.textContent = '✅';
                        } else {
                            topicElement.classList.remove('completed');
                            const exerciseCount = this.data.exercisesCompleted[topicKey]?.length || 0;
                            if (status) {
                                if (exerciseCount > 0) {
                                    status.textContent = '📖'; // Em progresso
                                } else if (topicKey === 'logica') { // Chave do primeiro tópico
                                    status.textContent = '▶️'; // Pronto para começar
                                } else {
                                    status.textContent = '🔒'; // Bloqueado
                                }
                            }
                        }
                    }
                });
                
                // Verificar se a trilha foi completada
                if (this.data.totalPoints >= totalPossiblePoints && !this.data.celebrationShown) {
                    this.data.celebrationShown = true;
                    this.saveProgress();
                    setTimeout(() => {
                        showCelebration();
                    }, 1000);
                }
                
            }
        }

        // Dados dos tópicos com exercícios (Totalmente novos para Back-end)
        const topicsData = {
            logica: {
                title: 'Lógica de Programação',
                description: 'A base de tudo. Aprenda sobre variáveis, condicionais, loops e funções que se aplicam a qualquer linguagem.',
                points: 100,
                resources: [
                    { name: 'Curso em Vídeo - Lógica', url: 'https://www.youtube.com/watch?v=8mei6uVttho&list=PLHz_AreHm4dmSj0MbbE4PiYFkN1adSgZc', type: 'Vídeo' },
                    { name: 'O que são Algoritmos?', url: 'https://algol.dev/algoritmo-o-que-e/?utm_source=chatgpt.com', type: 'Artigo' },
                    { name: 'Exercícios de Lógica', url: 'https://www.hackerrank.com/domains/algorithms', type: 'Prática' }
                ],
                topics: [
                    'O que é um algoritmo?',
                    'Variáveis e Tipos de Dados',
                    'Operadores (Aritméticos, Lógicos)',
                    'Estruturas Condicionais (if, else, switch)',
                    'Estruturas de Repetição (for, while)',
                    'Funções e Escopo'
                ],
                exercises: [
                    {
                        id: 'logica_1',
                        question: 'Qual estrutura é usada para tomar decisões no código?',
                        options: ['for', 'while', 'if/else', 'function'],
                        correct: 2,
                        explanation: 'A estrutura "if/else" (Se/Senão) é usada para executar blocos de código diferentes com base em uma condição.'
                    },
                    {
                        id: 'logica_2',
                        question: 'Qual estrutura é ideal para repetir um bloco de código um número conhecido de vezes?',
                        options: ['while', 'if', 'switch', 'for'],
                        correct: 3,
                        explanation: 'O loop "for" é comumente usado quando sabemos o número de iterações, como "para i de 0 a 10".'
                    },
                    {
                        id: 'logica_3',
                        question: 'O que uma "variável" faz em programação?',
                        options: ['Executa uma ação', 'Armazena um valor na memória', 'Toma uma decisão', 'Define um estilo'],
                        correct: 1,
                        explanation: 'Uma variável é como uma "caixa" na memória do computador que guarda um valor (número, texto, etc.) com um nome.'
                    }
                ]
            },
            linguagem: {
                title: 'Linguagem (PHP & Laravel)',
                description: 'Aprenda a sintaxe da linguagem PHP e o poder do framework Laravel para construir aplicações web robustas.',
                points: 150,
                resources: [
                    { name: 'Documentação Oficial do PHP', url: 'https://www.php.net/manual/pt_BR/', type: 'Documentação' },
                    { name: 'Laravel - Do Zero', url: 'https://www.youtube.com/watch?v=Mgd0S-n0d4A&list=PL_NmtP-Q-sFqF32Tj-i0C-d-eQfA0-mYd', type: 'Vídeo' },
                    { name: 'Documentação do Laravel', url: 'https://laravel.com/docs/10.x', type: 'Documentação' }
                ],
                topics: [
                    'Sintaxe básica do PHP',
                    'Programação Orientada a Objetos (OOP) em PHP',
                    'O que é o Laravel (MVC)',
                    'Rotas e Controllers',
                    'Views (Blade Templates)',
                    'Models e Eloquent (ORM)'
                ],
                exercises: [
                    {
                        id: 'lang_1',
                        question: 'No PHP, qual símbolo precede uma variável?',
                        options: ['@', '#', '$', '&'],
                        correct: 2,
                        explanation: 'Todas as variáveis em PHP começam com o símbolo de cifrão ($), como $minhaVariavel.'
                    },
                    {
                        id: 'lang_2',
                        question: 'O que é o Eloquent no Laravel?',
                        options: ['Um sistema de rotas', 'Um motor de template', 'Um ORM para banco de dados', 'Um servidor web'],
                        correct: 2,
                        explanation: 'Eloquent é o ORM (Object-Relational Mapper) do Laravel, que facilita a interação com o banco de dados usando objetos.'
                    },
                    {
                        id: 'lang_3',
                        question: 'Qual padrão de arquitetura o Laravel segue predominantemente?',
                        options: ['MVC (Model-View-Controller)', 'MVP (Model-View-Presenter)', 'MVVM (Model-View-ViewModel)', 'Nenhuma das anteriores'],
                        correct: 0,
                        explanation: 'O Laravel é estruturado em torno do padrão MVC, separando a lógica de negócios (Model), da apresentação (View) e do controle (Controller).'
                    }
                ]
            },
            banco_dados: {
                title: 'Bancos de Dados & SQL',
                description: 'Aprenda a modelar, armazenar e consultar dados usando SQL, o padrão de linguagem para bancos de dados relacionais.',
                points: 150,
                resources: [
                    { name: 'W3Schools - SQL', url: 'https://www.w3schools.com/sql/', type: 'Tutorial' },
                    { name: 'Curso em Vídeo - Banco de Dados', url: 'https://www.youtube.com/watch?v=Ofktsne-utM&list=PLHz_AreHm4dkBs-7jYIfUIiyLQAoTwS5M', type: 'Vídeo' },
                    { name: 'Migrations no Laravel', url: 'https://laravel.com/docs/10.x/migrations', type: 'Documentação' }
                ],
                topics: [
                    'O que é um Banco de Dados Relacional?',
                    'Modelagem de Dados (Entidade-Relacionamento)',
                    'Linguagem SQL (DDL, DML)',
                    'Comandos: SELECT, INSERT, UPDATE, DELETE',
                    'Relacionamentos (JOINs)',
                    'Migrations e Seeders (Laravel)'
                ],
                exercises: [
                    {
                        id: 'db_1',
                        question: 'Qual comando SQL é usado para consultar dados em uma tabela?',
                        options: ['GET', 'SELECT', 'FETCH', 'QUERY'],
                        correct: 1,
                        explanation: 'O comando "SELECT" é usado para selecionar (consultar) dados de um banco de dados.'
                    },
                    {
                        id: 'db_2',
                        question: 'Qual comando é usado para ligar duas tabelas em uma consulta SQL?',
                        options: ['CONNECT', 'LINK', 'JOIN', 'RELATE'],
                        correct: 2,
                        explanation: 'O comando "JOIN" é usado para combinar linhas de duas ou mais tabelas com base em uma coluna relacionada entre elas.'
                    },
                    {
                        id: 'db_3',
                        question: 'No Laravel, o que são "Migrations"?',
                        options: ['Um backup do banco', 'Um sistema de cache', 'Um controle de versão para o banco de dados', 'Um tipo de Controller'],
                        correct: 2,
                        explanation: 'Migrations funcionam como um controle de versão para o esquema do seu banco de dados, permitindo modificar e compartilhar a estrutura das tabelas.'
                    }
                ]
            },
            apis: {
                title: 'APIs e Serviços (REST)',
                description: 'Aprenda como seu back-end pode se comunicar com outras aplicações (como um app mobile ou um front-end) através de APIs REST.',
                points: 150,
                resources: [
                    { name: 'O que é uma API REST?', url: 'https://www.redhat.com/pt-br/topics/api/what-is-a-rest-api', type: 'Artigo' },
                    { name: 'Construindo APIs no Laravel', url: 'https://laravel.com/docs/10.x/controllers#restful-resource-controllers', type: 'Documentação' },
                    { name: 'Postman (Ferramenta)', url: 'https://www.postman.com/', type: 'Ferramenta' }
                ],
                topics: [
                    'O que é uma API?',
                    'Princípios do REST',
                    'Métodos HTTP (GET, POST, PUT, DELETE)',
                    'Formato JSON',
                    'Autenticação (ex: Tokens)',
                    'Criando rotas de API no Laravel'
                ],
                exercises: [
                    {
                        id: 'api_1',
                        question: 'Qual método HTTP é usado para buscar (ler) dados de um servidor?',
                        options: ['POST', 'GET', 'PUT', 'DELETE'],
                        correct: 1,
                        explanation: 'GET é usado para requisitar dados. É o método que seu navegador usa para buscar uma página web, por exemplo.'
                    },
                    {
                        id: 'api_2',
                        question: 'Qual método HTTP é usado para criar um novo recurso (ex: um novo usuário)?',
                        options: ['POST', 'GET', 'PUT', 'DELETE'],
                        correct: 0,
                        explanation: 'POST é usado para enviar dados para criar um novo recurso no servidor.'
                    },
                    {
                        id: 'api_3',
                        question: 'Qual é o formato de dados mais comum usado em APIs REST hoje?',
                        options: ['XML', 'HTML', 'CSV', 'JSON'],
                        correct: 3,
                        explanation: 'JSON (JavaScript Object Notation) é o padrão de fato para APIs REST devido à sua leveza e facilidade de leitura.'
                    }
                ]
            },
            testes_devops: {
                title: 'Testes e Boas Práticas',
                description: 'Garanta a qualidade e a estabilidade do seu código com testes automatizados e entenda o básico de deploy.',
                points: 150,
                resources: [
                    { name: 'Testes no Laravel (PHPUnit)', url: 'https://laravel.com/docs/10.x/testing', type: 'Documentação' },
                    { name: 'Clean Code (Conceitos)', url: 'https://www.alura.com.br/artigos/o-que-e-clean-code', type: 'Artigo' },
                    { name: 'Deploy com Laravel Forge', url: 'https://forge.laravel.com/', type: 'Ferramenta' }
                ],
                topics: [
                    'Por que testar?',
                    'Testes Unitários (PHPUnit)',
                    'Testes de Feature (TDD)',
                    'Princípios (Clean Code, SOLID)',
                    'O que é Deploy?',
                    'Ambientes (Desenvolvimento, Produção)'
                ],
                exercises: [
                    {
                        id: 'test_1',
                        question: 'O que é um "Teste Unitário"?',
                        options: ['Testar a aplicação inteira', 'Testar uma pequena parte (unidade) do código, como uma função', 'Testar o visual do site', 'Testar a conexão de rede'],
                        correct: 1,
                        explanation: 'Teste Unitário foca em testar a menor parte possível do código (uma "unidade"), como um método ou função, de forma isolada.'
                    },
                    {
                        id: 'test_2',
                        question: 'O que significa "TDD"?',
                        options: ['Test Driven Development', 'Total Data Drive', 'Test Driven Database', 'Time Driven Development'],
                        correct: 0,
                        explanation: 'TDD (Test-Driven Development) é uma prática onde você escreve o teste *antes* de escrever o código que faz o teste passar.'
                    },
                    {
                        id: 'test_3',
                        question: 'O que é o "Deploy" de uma aplicação?',
                        options: ['Desenhar a interface', 'Escrever o código', 'Colocar a aplicação no ar (em produção)', 'Corrigir bugs'],
                        correct: 2,
                        explanation: 'Deploy é o processo de pegar o código que funciona na sua máquina e colocá-lo em um servidor para que os usuários possam acessá-lo.'
                    }
                ]
            }
        };

        // Sistema de Exercícios
        class ExerciseSystem {
            constructor(progressTracker) {
                this.progressTracker = progressTracker;
                this.currentExercise = null;
                this.currentTopic = null;
                this.selectedAnswer = null;
            }

            startExercise(topicKey, exerciseIndex = 0) {
                const topic = topicsData[topicKey];
                if (!topic || !topic.exercises || !topic.exercises[exerciseIndex]) return;

                this.currentTopic = topicKey;
                this.currentExercise = topic.exercises[exerciseIndex];
                this.selectedAnswer = null;

                this.showExerciseModal();
            }

            showExerciseModal() {
                const modal = document.getElementById('exerciseModal');
                const title = document.getElementById('exerciseTitle');
                const question = document.getElementById('exerciseQuestion');
                const options = document.getElementById('exerciseOptions');
                const feedback = document.getElementById('exerciseFeedback');
                const submitBtn = document.getElementById('submitAnswer');

                title.textContent = `${topicsData[this.currentTopic].title} - Exercício`;
                question.textContent = this.currentExercise.question;
                feedback.style.display = 'none';
                submitBtn.disabled = true;
                
                // Remover event listeners anteriores e adicionar novo
                submitBtn.onclick = () => this.submitAnswer();

                // Renderizar opções usando criação de elementos e textContent para evitar interpretar tags HTML como elementos
                options.innerHTML = '';
                this.currentExercise.options.forEach((option, index) => {
                    const btn = document.createElement('button');
                    btn.className = 'option-btn';
                    btn.setAttribute('data-index', index);
                    btn.onclick = () => selectAnswer(index);
                    // Exibir literalmente strings como "<div>" sem que virem elementos HTML
                    btn.textContent = `${String.fromCharCode(65 + index)}) ${option}`;
                    options.appendChild(btn);
                });

                modal.classList.add('active');
            }

            selectAnswer(index) {
                this.selectedAnswer = index;
                
                // Remover seleção anterior
                document.querySelectorAll('.option-btn').forEach(btn => {
                    btn.classList.remove('selected');
                });
                
                // Adicionar seleção atual
                document.querySelector(`[data-index="${index}"]`).classList.add('selected');
                document.getElementById('submitAnswer').disabled = false;
            }

            submitAnswer() {
                if (this.selectedAnswer === null) return;

                const isCorrect = this.selectedAnswer === this.currentExercise.correct;
                const feedback = document.getElementById('exerciseFeedback');
                const options = document.querySelectorAll('.option-btn');

                // Mostrar resultado visual
                options.forEach((btn, index) => {
                    if (index === this.currentExercise.correct) {
                        btn.classList.add('correct');
                    } else if (index === this.selectedAnswer && !isCorrect) {
                        btn.classList.add('incorrect');
                    }
                    btn.disabled = true;
                });

                // Mostrar feedback
                feedback.className = `exercise-feedback ${isCorrect ? 'correct' : 'incorrect'}`;
                feedback.innerHTML = `
                    <strong>${isCorrect ? '✅ Correto!' : '❌ Incorreto!'}</strong><br>
                    ${this.currentExercise.explanation}
                `;
                feedback.style.display = 'block';

                // Atualizar progresso
                if (isCorrect) {
                    this.progressTracker.completeExercise(this.currentTopic, this.currentExercise.id);
                    // Atualizar painel lateral se estiver aberto
                    const sidePanel = document.getElementById('sidePanel');
                    if (sidePanel.classList.contains('active')) {
                        openSidePanel(this.currentTopic);
                    }
                }

                // Alterar botão para "Próximo" ou "Concluir"
                const submitBtn = document.getElementById('submitAnswer');
                submitBtn.textContent = 'Continuar';
                submitBtn.onclick = () => this.nextExercise();
            }

            nextExercise() {
                const topic = topicsData[this.currentTopic];
                const currentIndex = topic.exercises.findIndex(ex => ex.id === this.currentExercise.id);
                
                if (currentIndex < topic.exercises.length - 1) {
                    this.startExercise(this.currentTopic, currentIndex + 1);
                } else {
                    this.completeTopicExercises();
                }
            }

            completeTopicExercises() {
                this.progressTracker.completeTopic(this.currentTopic);
                this.closeModal();
                this.showCompletionAnimation();
                // Atualizar painel lateral se estiver aberto
                const sidePanel = document.getElementById('sidePanel');
                if (sidePanel.classList.contains('active')) {
                    setTimeout(() => openSidePanel(this.currentTopic), 100);
                }
            }

            closeModal() {
                document.getElementById('exerciseModal').classList.remove('active');
            }

            showCompletionAnimation() {
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: linear-gradient(135deg, var(--primary-blue), var(--secondary-orange));
                    color: white;
                    padding: 2rem;
                    border-radius: 15px;
                    font-size: 1.5rem;
                    font-weight: 700;
                    z-index: 2000;
                    animation: pointsAnimation 3s ease-out forwards;
                    text-align: center;
                `;
                notification.innerHTML = `
                    🎉 Tópico Concluído!<br>
                    <span style="font-size: 1.2rem;">+${topicsData[this.currentTopic].points} XP</span>
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 3000);
            }
        }

        // Variáveis globais
        let progressTracker;
        let exerciseSystem;

        // Elementos DOM
        const sidePanel = document.getElementById('sidePanel');
        const panelTitle = document.getElementById('panelTitle');
        const panelContent = document.getElementById('panelContent');
        const closePanel = document.getElementById('closePanel');
        const topicItems = document.querySelectorAll('.topic-item');

        // Função para abrir o painel lateral
        function openSidePanel(topicKey) {
            const topic = topicsData[topicKey];
            if (!topic) return;

            const completedExercises = progressTracker.data.exercisesCompleted[topicKey]?.length || 0;
            const totalExercises = topic.exercises?.length || 0;
            const isCompleted = progressTracker.data.topicProgress[topicKey]?.completed || false;

            panelTitle.textContent = topic.title;
            
            panelContent.innerHTML = `
                <div class="topic-overview">
                    <p>${topic.description}</p>
                    <div class="points-display">
                        <strong>🎯 Pontos: ${topic.points} XP</strong>
                    </div>
                </div>

                <div class="resource-section">
                    <h4>📚 O que você vai aprender:</h4>
                    <ul class="topic-list">
                        ${topic.topics.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                </div>

                <div class="resource-section">
                    <h4>🔗 Recursos de Aprendizado:</h4>
                    <ul class="resource-list">
                        ${topic.resources.map(resource => `
                            <li class="resource-item">
                                <a href="${resource.url}" class="resource-link" target="_blank">
                                    ${resource.name}
                                </a>
                                <span class="resource-type">${resource.type}</span>
                            </li>
                        `).join('')}
                    </ul>
                </div>

                ${!isCompleted ? `
                    <button class="start-topic-btn" onclick="startTopic('${topicKey}')">
                        ${completedExercises > 0 ? '📖 Continuar Exercícios' : '🚀 Começar Exercícios'}
                    </button>
                ` : `
                    <div class="completed-topic">
                        <p style="text-align: center; color: #4caf50; font-weight: bold;">
                            ✅ Tópico Concluído!
                        </p>
                    </div>
                `}
            `;

            sidePanel.classList.add('active');
        }

        // Função para fechar o painel lateral
        function closeSidePanel() {
            sidePanel.classList.remove('active');
        }

        // Função para iniciar um tópico
        function startTopic(topicKey) {
            closeSidePanel();
            exerciseSystem.startExercise(topicKey);
        }

        // Funções globais para exercícios
        function selectAnswer(index) {
            exerciseSystem.selectAnswer(index);
        }

        function submitExerciseAnswer() {
            exerciseSystem.submitAnswer();
        }

        function closeExerciseModal() {
            exerciseSystem.closeModal();
        }

        // Event listeners
        topicItems.forEach(item => {
            item.addEventListener('click', () => {
                const topicKey = item.getAttribute('data-topic');
                openSidePanel(topicKey);
            });
        });

        closePanel.addEventListener('click', closeSidePanel);

        // Fechar painel ao clicar fora
        document.addEventListener('click', (e) => {
            if (sidePanel.classList.contains('active') && 
                !sidePanel.contains(e.target) && 
                !e.target.closest('.topic-item')) {
                closeSidePanel();
            }
        });

        // Fechar modal de exercício ao clicar fora
        document.addEventListener('click', (e) => {
            const modal = document.getElementById('exerciseModal');
            if (modal.classList.contains('active') && e.target === modal) {
                closeExerciseModal();
            }
        });

        // Adicionar listeners para teclas de atalho
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (document.getElementById('exerciseModal').classList.contains('active')) {
                    closeExerciseModal();
                } else if (sidePanel.classList.contains('active')) {
                    closeSidePanel();
                }
            }
        });

        // Adicionar animação CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pointsAnimation {
                0% {
                    opacity: 0;
                    transform: translate(-50%, -50%) scale(0.5);
                }
                50% {
                    opacity: 1;
                    transform: translate(-50%, -50%) scale(1.1);
                }
                100% {
                    opacity: 0;
                    transform: translate(-50%, -50%) scale(1) translateY(-50px);
                }
            }
            
            .topic-list {
                list-style: none;
                padding: 0;
            }
            
            .topic-list li {
                background-color: rgba(0, 188, 212, 0.1);
                padding: 0.5rem 1rem;
                margin-bottom: 0.5rem;
                border-radius: 8px;
                border-left: 3px solid var(--primary-blue);
            }
            
            .resource-type {
                display: inline-block;
                background-color: var(--secondary-orange);
                color: var(--background-dark-blue);
                padding: 0.2rem 0.5rem;
                border-radius: 12px;
                font-size: 0.8rem;
                font-weight: 600;
                margin-left: 0.5rem;
            }
            
            .points-display {
                background: linear-gradient(135deg, var(--primary-blue), var(--secondary-orange));
                color: white;
                padding: 1rem;
                border-radius: 10px;
                text-align: center;
                margin: 1rem 0;
            }
            
            .exercise-progress {
                background-color: rgba(0, 188, 212, 0.1);
                padding: 1rem;
                border-radius: 10px;
                margin: 1rem 0;
                border: 1px solid var(--primary-blue);
            }
            
            .completed-topic {
                background-color: rgba(76, 175, 80, 0.1);
                padding: 1.5rem;
                border-radius: 10px;
                margin: 1rem 0;
                border: 1px solid #4caf50;
            }
        `;
        document.head.appendChild(style);

        // Funções de Celebração
        function showCelebration() {
            const overlay = document.getElementById('celebrationOverlay');
            overlay.classList.add('show');
            createConfetti();
            
            // Som de celebração (opcional)
            try {
                const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIG2m98OScTgwOUarm7blmGgU7k9n1unEiBC13yO/eizEIHWq+8+OWT');
                audio.volume = 0.3;
                audio.play().catch(() => {});
            } catch (e) {}
        }
        
        function createConfetti() {
            const overlay = document.getElementById('celebrationOverlay');
            const colors = ['#FFD700', '#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8'];
            
            for (let i = 0; i < 50; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDelay = Math.random() * 3 + 's';
                    confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                    overlay.appendChild(confetti);
                    
                    setTimeout(() => {
                        if (confetti.parentNode) {
                            confetti.parentNode.removeChild(confetti);
                        }
                    }, 5000);
                }, i * 100);
            }
        }
        
        function closeCelebration() {
            const overlay = document.getElementById('celebrationOverlay');
            overlay.classList.remove('show');
            
            // Limpar confetes
            const confettis = overlay.querySelectorAll('.confetti');
            confettis.forEach(confetti => {
                if (confetti.parentNode) {
                    confetti.parentNode.removeChild(confetti);
                }
            });
        }

        // Funções do Patinho da TI
        let patinhoTooltipVisible = false;
        let patinhoMessages = [
            "Quack! Lembre-se: a prática leva à perfeição! 🦆",
            "Dica do patinho: sempre teste seu código! 🧪",
            "Quack! Não desista, todo programador já passou por isso! 💪",
            "Patinho diz: documente seu código para o futuro você! 📝",
            "Quack! Pequenos passos levam a grandes conquistas! 🚀"
        ];
        
        function togglePatinhoTips() {
            const tooltip = document.getElementById('patinhoTooltip');
            patinhoTooltipVisible = !patinhoTooltipVisible;
            
            if (patinhoTooltipVisible) {
                // Mostrar mensagem aleatória
                const randomMessage = patinhoMessages[Math.floor(Math.random() * patinhoMessages.length)];
                document.getElementById('patinhoMessage').innerHTML = randomMessage;
                tooltip.classList.add('show');
                
                // Esconder após 5 segundos se não interagir
                setTimeout(() => {
                    if (patinhoTooltipVisible) {
                        tooltip.classList.remove('show');
                        patinhoTooltipVisible = false;
                    }
                }, 5000);
            } else {
                tooltip.classList.remove('show');
            }
        }
        
        function showPatinhoTips() {
            document.getElementById('patinhoTipsModal').classList.add('show');
            document.getElementById('patinhoTooltip').classList.remove('show');
            patinhoTooltipVisible = false;
        }
        
        function closePatinhoTips() {
            document.getElementById('patinhoTipsModal').classList.remove('show');
        }
        
        // Fechar modais ao clicar fora
        document.addEventListener('click', function(event) {
            const patinhoHelper = document.getElementById('patinhoHelper');
            const patinhoTooltip = document.getElementById('patinhoTooltip');
            
            if (!patinhoHelper.contains(event.target) && patinhoTooltipVisible) {
                patinhoTooltip.classList.remove('show');
                patinhoTooltipVisible = false;
            }
        });
        


        // Função global para sincronizar pontos da trilha com o ranking do usuário
        function syncTrailPoints(points, source = 'backend') { // Default source alterado para 'backend'
            try {
                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = tokenMeta ? tokenMeta.getAttribute('content') : null;

                fetch('/trilhas/sync-points', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    },
                    body: JSON.stringify({ points: Number(points) || 0, source })
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        console.warn('Falha ao sincronizar pontos da trilha:', data);
                    } else {
                        console.log('Pontos sincronizados com sucesso. Total do usuário:', data.new_points);
                    }
                })
                .catch(err => console.error('Erro na sincronização de pontos:', err));
            } catch (e) {
                console.error('Erro ao preparar sincronização de pontos:', e);
            }
        }
        window.syncTrailPoints = syncTrailPoints;

        // Inicialização
        document.addEventListener('DOMContentLoaded', () => {
            progressTracker = new TrackProgress();
            exerciseSystem = new ExerciseSystem(progressTracker);
            
            // Primeiro tópico sempre disponível (alterado para 'logica')
            const firstTopic = document.querySelector('.topic-item[data-topic="logica"]');
            if (firstTopic && !progressTracker.data.topicProgress['logica']) {
                firstTopic.querySelector('.topic-status').textContent = '▶️';
            }
            
            // Forçar atualização inicial da UI
            progressTracker.updateUI();
            
            // Mostrar dica inicial do patinho após 3 segundos
            setTimeout(() => {
                const patinhoHelper = document.getElementById('patinhoHelper');
                if (patinhoHelper) {
                    patinhoHelper.style.animation = 'duck-bob 1s ease-in-out 3';
                }
            }, 3000);
        });
    </script>
</div>
@endsection@