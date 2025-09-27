{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programando Futuros</title>
    
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

        /* ------------------ Seções ------------------ */
        section { padding:6rem 2rem; max-width:1200px; margin:auto; }
        .section-title { font-family: var(--font-display); font-size:2.8rem; color:var(--heading-color); text-align:center; margin-bottom:1.5rem; position:relative; padding-bottom:10px; }
        .section-title::after { content:''; position:absolute; left:50%; bottom:0; transform:translateX(-50%); width:80px; height:4px; background-color: var(--secondary-orange); border-radius:2px; }
        .section-subtitle { font-size:1.2rem; color:var(--text-color); text-align:center; margin-bottom:3rem; opacity:0.9; }

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

        /* ------------------ Hero ------------------ */
        .hero-section {
            min-height: calc(100vh - 80px);
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            background: radial-gradient(circle at center, rgba(0,188,212,0.1) 0%, transparent 70%);
        }
        .hero-title { font-family:var(--font-display); font-size:3.8rem; color:var(--heading-color); margin-bottom:1.5rem; line-height:1.2; text-shadow:0 0 20px rgba(0,188,212,0.5);}
        .hero-text { font-size:1.4rem; color:var(--text-color); margin-bottom:3rem; opacity:0.9; }

        /* ------------------ Áreas ------------------ */
        .areas-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:2rem; }
        .area-card { background-color: var(--card-background); padding:2.5rem; border-radius:15px; border:1px solid var(--border-blue); display:flex; flex-direction:column; align-items:center; transition:transform 0.3s ease, border-color 0.3s ease; }
        .area-card:hover { transform:translateY(-10px); border-color:var(--primary-blue); box-shadow:0 12px 30px rgba(0,188,212,0.2);}
        .area-icon { font-size:3.5rem; color: var(--primary-blue); margin-bottom:1.5rem; background-color: rgba(0,188,212,0.1); padding:1rem; border-radius:50%; display:flex; justify-content:center; align-items:center; width:90px; height:90px; border:1px solid var(--primary-blue);}
        .area-title { font-family:var(--font-display); font-size:1.8rem; color:var(--heading-color); margin-bottom:1rem; }
        .area-description { font-size:1rem; color:var(--text-color); margin-bottom:1.5rem; flex-grow:1; text-align:center; }
        .area-link { color:var(--secondary-orange); text-decoration:none; font-weight:700; display:flex; align-items:center; gap:0.5rem; }
        .area-link:hover { color:var(--hover-light-orange); }
        .area-card.coming-soon-area { opacity:0.7; filter:grayscale(80%); position:relative; border-color:var(--secondary-orange);}
        .area-card.coming-soon-area:hover { transform:none; box-shadow:0 8px 25px rgba(0,0,0,0.3); border-color:var(--secondary-orange);}
        .area-soon-tag { background-color:var(--secondary-orange); color: var(--background-dark-blue); padding:0.4rem 0.8rem; border-radius:15px; font-size:0.8rem; font-weight:700; position:absolute; bottom:1rem; right:1rem; }

        /* ------------------ Equipe ------------------ */
        .team-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:2.5rem; margin-bottom:4rem; }
        .team-card { background-color: var(--card-background); padding:2rem; border-radius:15px; border:1px solid var(--border-blue); text-align:center; transition: transform 0.3s ease, border-color 0.3s ease;}
        .team-card:hover { transform:translateY(-10px); border-color: var(--primary-blue); box-shadow:0 12px 30px rgba(0,188,212,0.2);}
        .team-image-container { position:relative; margin-bottom:1rem; }
        .team-image { width:150px; height:150px; object-fit:cover; border-radius:50%; border:3px solid var(--primary-blue);}
        .tech-border { position:absolute; top:-5px; left:-5px; width:160px; height:160px; border:2px dashed var(--secondary-orange); border-radius:50%; animation: rotateBorder 10s linear infinite; }
        @keyframes rotateBorder { 0% { transform:rotate(0deg); } 100% { transform:rotate(360deg); } }
       

        /* ------------------ User Dropdown ------------------ */
        .user-dropdown { position: relative; }
        .user-icon { display: flex; align-items: center; gap: 0.5rem; }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 8px;
            min-width: 180px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            display: none;
            z-index: 1001;
            overflow: hidden;
        }
        .user-dropdown:hover .dropdown-menu { display: block; }
        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.8rem 1.2rem;
            text-align: left;
            background: none;
            border: none;
            color: var(--text-color);
            font-family: var(--font-primary);
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .dropdown-item:hover {
            background-color: rgba(0,188,212,0.1);
            color: var(--primary-blue);
        }

        /* ------------------ Footer ------------------ */
        footer { background-color: var(--card-background); padding:2rem; text-align:center; color:var(--text-color); border-top:2px solid var(--border-blue);}
        footer a { color:var(--secondary-orange); text-decoration:none; }
        footer a:hover { color:var(--hover-light-orange); }
    </style>
</head>
<body>
       <!-- Fundo animado -->
    <div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1;"></div>



    {{-- ------------------ Cabeçalho ------------------ --}}
    <header class="tech-header">
        <div class="logo-wrapper">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="site-logo">
            <div class="logo-text">
                <span class="main-logo">&lt;Programando</span>
                <span class="highlight-logo">Futuros/&gt;</span>
            </div>
        </div>
        <nav class="tech-nav">
            <ul>
                <li><a href="#sobre" class="active">Sobre</a></li>
                <li><a href="#areas">Áreas</a></li>
                <li><a href="#trilhas">Trilhas</a></li>
                <li><a href="{{ route('quiz.index') }}">Descubra Seu Perfil</a></li>
                <li><a href="#equipe">Equipe</a></li>
                <li><a href="#contato">Contato</a></li>
                @auth
                <li class="user-dropdown">
                    <a href="#" class="user-icon"><i class="fas fa-user-circle"></i> {{ Auth::user()->name }} <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <a href="{{ route('login') }}" class="dropdown-item">Trocar de conta</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Sair</button>
                        </form>
                    </div>
                </li>
                @else
                <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    {{-- ------------------ Hero ------------------ --}}
    <section class="hero-section" id="hero">
        <div class="hero-content">
            <h1 class="hero-title">&lt;Programando Futuros/&gt;</h1>
            <p class="hero-text">Conectando estudantes e tecnologia, transformando o futuro com educação digital.</p>
            <a href="#sobre" class="tech-button pulse">Saiba Mais</a>
        </div>
    </section>

    {{-- ------------------ Sobre ------------------ --}}
    <section id="sobre" class="about-section">
        <h2 class="section-title">O Que é o Programando Futuros?</h2>
        <p class="section-subtitle">O Programando Futuros é um projeto idealizado e desenvolvido por estudantes do DF, com o objetivo de levar educação tecnológica a escolas públicas, estimulando inovação e cidadania digital.</p>
    </section>

  {{-- ------------------ Áreas ------------------ --}}
@include('components.areas')

{{-- ------------------ Footer ------------------ --}}
<footer>
    &copy; {{ date('Y') }} Programando Futuros. Todos os direitos reservados. | <a href="#contato">Contato</a>
</footer>
<script>
    particlesJS("particles-js", {
        "particles": {
            "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
            "color": { "value": "#00bcd4" },
            "shape": { "type": "circle" },
            "opacity": { "value": 0.5 },
            "size": { "value": 3 },
            "line_linked": { "enable": true, "distance": 150, "color": "#00bcd4", "opacity": 0.4, "width": 1 },
            "move": { "enable": true, "speed": 4 }
        },
        "interactivity": {
            "events": {
                "onhover": { "enable": true, "mode": "grab" },
                "onclick": { "enable": true, "mode": "push" }
            },
            "modes": {
                "grab": { "distance": 140, "line_linked": { "opacity": 1 } },
                "push": { "particles_nb": 4 }
            }
        },
        "retina_detect": true
    });
</script>
</body>
</html>
