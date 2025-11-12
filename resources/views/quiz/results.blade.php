<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados do Questionário - Programando Futuros</title>
    
    <!-- Fontes Google -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@400;600&family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <style>
        /* ------------------ Variáveis CSS ------------------ */
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

            --font-primary: 'Montserrat', sans-serif;
            --font-display: 'Orbitron', sans-serif;
        }

        /* ------------------ Reset e Body ------------------ */
        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body {
            font-family: var(--font-primary);
            background-color: var(--background-dark-blue);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* ------------------ Cabeçalho ------------------ */
        .tech-header {
            background: linear-gradient(90deg, var(--card-background) 0%, rgba(22,33,62,0.8) 100%);
            padding: 1rem 2rem;
            display:flex;
            justify-content:space-between;
            align-items:center;
            position: sticky;
            top:0;
            z-index:1000;
            border-bottom:2px solid var(--border-blue);
        }
        .logo-wrapper { display:flex; align-items:center; }
        .site-logo { height:50px; margin-right:10px; }
        .logo-text .main-logo { font-family: var(--font-display); font-size:1.8rem; color: var(--heading-color); }
        .logo-text .highlight-logo { font-family: var(--font-display); font-size:1.8rem; color: var(--secondary-orange); }
        .tech-nav ul { list-style:none; display:flex; gap:1.5rem; }
        .tech-nav ul li a {
            color: var(--text-color);
            font-weight:700;
            text-decoration:none;
            position:relative;
            padding-bottom:5px;
        }
        .tech-nav ul li a::after {
            content:'';
            position:absolute;
            width:0;
            height:3px;
            background-color: var(--primary-blue);
            left:0;
            bottom:0;
            transition: width 0.3s ease-in-out;
        }
        .tech-nav ul li a:hover::after,
        .tech-nav ul li a.active::after { width:100%; }

        /* ------------------ Botões ------------------ */
        .tech-button {
            display:inline-block;
            background-color: var(--secondary-orange);
            color: var(--background-dark-blue);
            padding:0.9rem 2.2rem;
            border-radius:30px;
            text-decoration:none;
            font-weight:700;
            font-size:1.1rem;
            transition:all 0.3s ease;
            border:2px solid var(--secondary-orange);
            box-shadow: 0 5px 15px rgba(255,140,0,0.3);
        }
        .tech-button:hover { background-color: var(--hover-light-orange); border-color: var(--hover-light-orange); transform: translateY(-3px); }
        .tech-button.pulse { animation: pulse 2s infinite; }
        @keyframes pulse { 0%{transform:scale(1);box-shadow:0 0 0 0 rgba(255,140,0,0.7);} 70%{transform:scale(1.05);box-shadow:0 0 0 20px rgba(255,140,0,0);} 100%{transform:scale(1);box-shadow:0 0 0 0 rgba(255,140,0,0);} }

        /* ------------------ Seções ------------------ */
        section { padding:6rem 2rem; max-width:1200px; margin:auto; }
        .section-title { font-family: var(--font-display); font-size:2.8rem; color:var(--heading-color); text-align:center; margin-bottom:1.5rem; position:relative; padding-bottom:10px; }
        .section-title::after { content:''; position:absolute; left:50%; bottom:0; transform:translateX(-50%); width:80px; height:4px; background-color: var(--secondary-orange); border-radius:2px; }
        .section-subtitle { font-size:1.2rem; color:var(--text-color); text-align:center; margin-bottom:3rem; opacity:0.9; }

        /* ------------------ Página de Resultados ------------------ */
        .quiz-results-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .quiz-results-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 3rem 0;
        }
        
        .quiz-results-header h1 {
            font-family: var(--font-display);
            font-size: 3.2rem;
            color: var(--heading-color);
            margin-bottom: 1.5rem;
            text-shadow: 0 0 20px rgba(0,188,212,0.5);
        }
        
        .quiz-results-header p {
            font-size: 1.3rem;
            color: var(--text-color);
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <!-- Fundo animado -->
    <div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1;"></div>

    {{-- ------------------ Cabeçalho ------------------ --}}
    <header class="tech-header">
        <div class="logo-wrapper">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="site-logo">
            <div class="logo-text">
                <span class="main-logo">&lt;Programando</span>
                <span class="highlight-logo">Futuros/&gt;</span>
            </div>
        </div>
        <nav class="tech-nav">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('quiz.index') }}">Quiz</a></li>
                @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: var(--text-color); font-weight: 700; cursor: pointer;">Sair</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>

<div class="quiz-results-container">
    <!-- Botão de voltar -->
    <div class="results-back-button">
        <a href="{{ route('quiz.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Voltar ao Quiz
        </a>
    </div>
    
    <div class="quiz-results-header">
        <h1>🎉 Parabéns! Você completou o questionário!</h1>
        <p>Descubra suas trilhas recomendadas e continue sua jornada de aprendizado.</p>
    </div>

    <div class="results-content">
        <!-- User Stats -->
        <div class="user-stats">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>Pontos XP</h3>
                    <p>{{ $user->gamification_points ?? 0 }}</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Nível</h3>
                    <p>{{ $user->level ?? 1 }}</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3>XP Total</h3>
                    <p>{{ $user->gamification_points ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Recommended Tracks -->
        <div class="recommended-tracks">
            <h2 class="section-title">🚀 Suas Trilhas Recomendadas</h2>
            <p class="section-subtitle">Com base nas suas respostas, estas são as trilhas que mais combinam com você:</p>
            
            @if(!empty($recommendedTracks))
                <div class="tracks-grid">
                    @foreach($recommendedTracks as $index => $track)
                        @php
                            $availableTracks = ['frontend', 'backend'];
                            $isAvailable = in_array($track['track'], $availableTracks);
                            $trackNames = [
                                'frontend' => 'Desenvolvimento Front-end',
                                'backend' => 'Desenvolvimento Back-end',
                                'mobile' => 'Desenvolvimento Mobile',
                                'data' => 'Ciência de Dados',
                                'devops' => 'DevOps',
                                'design' => 'UI/UX Design'
                            ];
                            $trackTitle = $trackNames[$track['track']] ?? ucfirst($track['track']);
                        @endphp
                        <div class="track-card {{ $index === 0 ? 'primary' : '' }}">
                            <div class="track-rank">#{{ $index + 1 }}</div>
                            <div class="track-header">
                                <h3>{{ $trackTitle }}</h3>
                                <div class="match-percentage">{{ $track['match_percentage'] }}% Match</div>
                            </div>
                            <p class="track-description">
                                @switch($track['track'])
                                    @case('frontend')
                                        Desenvolvimento de interfaces web modernas e responsivas
                                        @break
                                    @case('backend')
                                        Desenvolvimento de APIs e sistemas server-side
                                        @break
                                    @case('mobile')
                                        Criação de aplicativos para dispositivos móveis
                                        @break
                                    @case('data')
                                        Análise de dados e ciência de dados
                                        @break
                                    @case('devops')
                                        Infraestrutura e automação de sistemas
                                        @break
                                    @case('design')
                                        Design de interfaces e experiência do usuário
                                        @break
                                    @default
                                        Trilha de programação especializada
                                @endswitch
                                @if(!$isAvailable)
                                    <br><strong>Em breve:</strong> Esta trilha estará disponível em breve. No momento, as trilhas disponíveis são Front-end e Back-end.
                                @endif
                            </p>
                            <div class="track-actions">
                                @if($isAvailable)
                                    <a href="/trilhas/{{ $track['track'] }}" class="tech-button">Começar Trilha</a>
                                @else
                                    <span class="tech-button-secondary" style="cursor: not-allowed; opacity: 0.6;">Em breve</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-recommendations">
                    <p>Não foi possível gerar recomendações. Tente refazer o questionário.</p>
                </div>
            @endif
        </div>



>
    </div>
</div>

<style>
        /* ------------------ Botão de voltar ------------------ */
        .results-back-button {
            margin-bottom: 2rem;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 25px;
            background: var(--card-background);
            border: 2px solid var(--border-blue);
            transition: all 0.3s ease;
        }
        
        .back-button:hover {
            background: var(--secondary-orange);
            color: var(--background-dark);
            transform: translateX(-3px);
            box-shadow: 0 5px 15px rgba(255, 140, 0, 0.3);
        }
        
        .back-button i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }
        
        .back-button:hover i {
            transform: translateX(-2px);
        }
        
        /* ------------------ Estatísticas ------------------ */
        .user-stats {
            margin-bottom: 4rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: var(--card-background);
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            border: 2px solid var(--border-blue);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0,188,212,0.1), transparent);
            transition: left 0.5s;
        }
        
        .stat-card:hover::before {
            left: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-blue);
            box-shadow: 0 15px 35px rgba(0,188,212,0.2);
        }
        
        .stat-icon {
            font-size: 3rem;
            color: var(--secondary-orange);
            margin-bottom: 1rem;
        }
        
        .stat-card h3 {
            color: var(--heading-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .stat-card p {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin: 0;
            font-family: var(--font-display);
        }
        
        /* ------------------ Trilhas Recomendadas ------------------ */
        .recommended-tracks {
            margin-bottom: 4rem;
        }
        
        .tracks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 2.5rem;
        }
        
        .track-card {
            background: var(--card-background);
            border-radius: 20px;
            padding: 2.5rem;
            border: 2px solid var(--border-blue);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .track-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,140,0,0.1), transparent);
            transition: left 0.5s;
        }
        
        .track-card:hover::before {
            left: 100%;
        }
        
        .track-card:hover {
            transform: translateY(-15px);
            border-color: var(--secondary-orange);
            box-shadow: 0 20px 40px rgba(255,140,0,0.2);
        }
        
        .track-card.primary {
            border-color: var(--secondary-orange);
            box-shadow: 0 10px 30px rgba(255,140,0,0.15);
        }
        
        .track-rank {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: var(--secondary-orange);
            color: var(--background-dark-blue);
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-family: var(--font-display);
        }
        
        .track-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .track-header h3 {
            color: var(--heading-color);
            font-size: 1.5rem;
            margin: 0;
            font-family: var(--font-display);
        }
        
        .match-percentage {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-orange));
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0,188,212,0.3);
        }
        
        .track-description {
            color: var(--text-color);
            margin-bottom: 2rem;
            line-height: 1.7;
            opacity: 0.9;
        }
        
        .track-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        
        
        /* ------------------ Botões Secundários ------------------ */
        .tech-button-secondary {
            display: inline-block;
            background: transparent;
            color: var(--primary-blue);
            padding: 0.9rem 2.2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-blue);
        }
        
        .tech-button-secondary:hover {
            background: var(--primary-blue);
            color: var(--background-dark-blue);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,188,212,0.3);
        }
        
        /* ------------------ Sem Recomendações ------------------ */
        .no-recommendations {
            text-align: center;
            padding: 3rem;
            background: var(--card-background);
            border-radius: 15px;
            border: 2px solid var(--border-blue);
            color: var(--text-color);
            opacity: 0.8;
        }
        
        /* ------------------ Responsividade ------------------ */
        @media (max-width: 768px) {
            .quiz-results-container {
                padding: 1rem;
            }
            
            .quiz-results-header h1 {
                font-size: 2.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .tracks-grid {
                grid-template-columns: 1fr;
            }
            
            .track-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .track-actions {
                flex-direction: column;
            }
            
            .steps-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    <!-- Particles.js Configuration -->
    <script>
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#00bcd4' },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: false },
                size: { value: 3, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00bcd4',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 6,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    onclick: { enable: true, mode: 'push' },
                    resize: true
                }
            },
            retina_detect: true
        });
    </script>
</body>
</html>