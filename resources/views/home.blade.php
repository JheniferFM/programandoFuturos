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

        /* ------------------ Submenu Trilhas ------------------ */
        .nav-dropdown {
            position: relative;
            padding-bottom: 20px; /* Área extra para evitar gap */
        }

        .nav-dropdown .dropdown {
            position: absolute;
            top: calc(100% - 20px); /* Ajustado para compensar padding */
            left: 0;
            background: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 8px;
            min-width: 200px;
            padding: 0.4rem 0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.35);
            display: none;
            z-index: 1100;
        }

        .nav-dropdown:hover .dropdown {
            display: block;
        }

        .nav-dropdown .dropdown li {
            list-style: none;
        }

        .nav-dropdown .dropdown li a {
            display: block;
            padding: 0.6rem 1rem;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-dropdown .dropdown li a:hover {
            background: rgba(0,188,212,0.06);
            color: var(--secondary-orange);
        }

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
        footer a:hover { color: var(--hover-light-orange); }

        /* ------------------ Avatares (pf-avatar) ------------------ */
        .pf-avatar { border-radius: 50%; object-fit: cover; display: inline-block; vertical-align: middle; }
        .pf-avatar--header { width: 36px; height: 36px; border: 2px solid var(--primary-blue); box-shadow: 0 0 8px rgba(0,188,212,0.35); }
        .pf-avatar--option { width: 44px; height: 44px; border: 2px solid rgba(255,255,255,0.18); box-shadow: 0 4px 12px rgba(0,0,0,0.3); }
        img, svg { max-width: 100%; height: auto; }

        @media (max-width: 768px) {
            .tech-header { padding: 0.75rem 1rem; flex-direction: column; gap: 0.75rem; }
            .site-logo { height: 36px; margin-right: 8px; }
            .logo-text .main-logo, .logo-text .highlight-logo { font-size: 1.4rem; }
            .tech-nav ul { flex-wrap: wrap; gap: 0.75rem; justify-content: center; }
            .nav-dropdown .dropdown { position: static; top: auto; left: auto; width: 100%; min-width: 0; box-shadow: none; border-radius: 8px; }
            .nav-dropdown:focus-within .dropdown, .nav-dropdown .dropdown-toggle:focus + .dropdown { display: block; }
            section { padding: 3rem 1rem; }
            .hero-title { font-size: 2.2rem; }
            .hero-text { font-size: 1rem; }
            .areas-grid { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; }
            .area-card { padding: 1.5rem; }
            .area-icon { width: 70px; height: 70px; font-size: 2.2rem; }
            .team-grid { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; }
            .section-title { font-size: 2rem; }
            .section-subtitle { font-size: 1rem; }
            .user-dropdown .dropdown-menu { position: static; min-width: 100%; box-shadow: none; }
        }
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
                <li><a href="{{ route('quiz.index') }}">Descubra Seu Perfil</a></li>
                <li><a href="{{ route('contact') }}">Contato</a></li>
                <li class="nav-dropdown">
                    <a href="#trilhas" class="dropdown-toggle">Trilhas <i class="fas fa-caret-down" style="margin-left:6px;"></i></a>
                    <ul class="dropdown">
                        <li><a href="{{ route('trilhas.frontend') }}">Front-end</a></li>
                        <li><a href="{{ route('trilhas.backend') }}">Back-end</a></li>
                        <li><a href="{{ route('trilhas.mobile') }}">Desenvolvimento Mobile</a></li>
                        <li><a href="{{ route('trilhas.datascience') }}">Ciência de Dados</a></li>
                    </ul>
                </li>

                @guest
                <li class="user-dropdown">
                    <a href="{{ route('login') }}" class="user-icon"><i class="fas fa-user-circle"></i> Entrar</a>
                </li>
                @endguest
                @auth
                @php
                    $points = Auth::user()->gamification_points ?? 0;
                    $rankClass = 'bronze';
                    $rankLabel = 'Bronze';
                    if ($points >= 801) { $rankClass = 'diamond'; $rankLabel = 'Diamante'; }
                    elseif ($points >= 401) { $rankClass = 'gold'; $rankLabel = 'Ouro'; }
                    elseif ($points >= 201) { $rankClass = 'silver'; $rankLabel = 'Prata'; }
                @endphp
                <div class="profile-header" style="display:flex;align-items:center;gap:0.75rem;">
                    <div class="avatar">
                        <a href="#" id="userMenuToggle" style="display:flex;flex-direction:column;align-items:center;text-decoration:none;">
                            <img src="{{ asset(Auth::user()->character_avatar ? (str_starts_with(Auth::user()->character_avatar,'avatars/') ? Auth::user()->character_avatar : 'avatars/'.basename(Auth::user()->character_avatar)) : 'avatars/alien.svg') }}" alt="Avatar" class="pf-avatar pf-avatar--header">
                            <span style="margin-top:0.35rem;color:#fff;font-weight:600;font-size:0.95rem;">{{ Auth::user()->name }}</span>
                        </a>
                    </div>
                </div>
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
        <p class="section-subtitle">O Programando Futuros é um projeto voltado para iniciantes em TI e para qualquer pessoa interessada em tecnologia, promovendo aprendizado acessível, inovação e cidadania digital.</p>
    </section>

  {{-- ------------------ Áreas ------------------ --}}
@include('components.areas')

{{-- (Removido) Trilhas de Aprendizado --}}
{{-- @include('components.trilhas') --}}

{{-- ------------------ Contato ------------------ --}}
<section id="contato" style="padding:4rem 2rem; max-width:1200px; margin:auto; text-align:center;">
  <h2 class="section-title">Contato</h2>
  <p class="section-subtitle">Fale com a gente por e-mail</p>
  <a href="https://mail.google.com/mail/?view=cm&fs=1&to=programandofuturosprojeto@gmail.com" class="tech-button" target="_blank" rel="noopener" style="margin-top:1rem;">Enviar E-mail</a>
</section>

{{-- ------------------ Footer ------------------ --}}
<footer>
    &copy; {{ date('Y') }} Programando Futuros. Todos os direitos reservados. | 
    <a href="{{ route('contact') }}">Contato</a>
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
            "move": { "enable": true, "speed": 4, "out_mode": "out", "attract": { "enable": false } }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": { "enable": true, "mode": ["grab","repulse"] },
                "onclick": { "enable": true, "mode": ["push","bubble"] },
                "resize": true
            },
            "modes": {
                "grab": { "distance": 200, "line_linked": { "opacity": 1 } },
                "bubble": { "distance": 300, "size": 10, "duration": 2.5, "opacity": 0.9, "speed": 3.2 },
                "repulse": { "distance": 240, "duration": 0.6 },
                "push": { "particles_nb": 6 },
                "remove": { "particles_nb": 2 }
            }
        },
        "retina_detect": true
    });
    (function(){
        var el = document.getElementById('particles-js');
        if(!el) return;
        var baseColorA = '#00bcd4';
        var baseColorB = '#FF8E53';
        var current = 'A';
        el.addEventListener('mousemove', function(e){
            var r = el.getBoundingClientRect();
            var nx = (e.clientX - r.left) / r.width - 0.5;
            var ny = (e.clientY - r.top) / r.height - 0.5;
            el.style.transform = 'translate3d(' + (nx*6) + 'px,' + (ny*6) + 'px,0)';
        });
        el.addEventListener('mouseleave', function(){
            el.style.transform = 'translate3d(0,0,0)';
        });
        el.addEventListener('dblclick', function(){
            var p = (window.pJSDom && window.pJSDom[0]) ? window.pJSDom[0].pJS : null;
            if(!p) return;
            current = current === 'A' ? 'B' : 'A';
            var c = current === 'A' ? baseColorA : baseColorB;
            p.particles.color.value = c;
            p.particles.line_linked.color = c;
            p.fn.particlesRefresh();
        });
        window.addEventListener('scroll', function(){
            var p = (window.pJSDom && window.pJSDom[0]) ? window.pJSDom[0].pJS : null;
            if(!p) return;
            var s = Math.min(8, 4 + window.scrollY/400);
            p.particles.move.speed = s;
        }, { passive: true });
    })();
</script>
<style>
    /* ------------------ Sidebar de Ranking (Paleta da Plataforma) ------------------ */
    :root {
        --primary-blue: #00bcd4;
        --secondary-orange: #FF8E53;
        --card-background: #16213e;
        --heading-color: #f0f0f0;
        --text-color: #e0e0e0;
        --border-blue: rgba(0,188,212,0.4);
    }

    .ranking-overlay {
        position: fixed; inset: 0;
        background: radial-gradient(circle at 30% 10%, rgba(0,188,212,0.15), transparent 40%), rgba(0,0,0,0.55);
        opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease; z-index: 999;
        backdrop-filter: blur(2px);
    }
    .ranking-overlay.visible { opacity: 1; visibility: visible; }

    .ranking-sidebar {
        position: fixed; top: 0; right: 0; height: 100vh; width: 420px; max-width: 100%;
        border-left: 2px solid var(--border-blue);
        box-shadow: -10px 0 25px rgba(0,0,0,0.35);
        transform: translateX(100%); transition: transform 0.3s ease; z-index: 1000; padding: 1.5rem;
        display: flex; flex-direction: column; gap: 1rem; overflow-y: auto; color: var(--text-color);
        background: linear-gradient(180deg, rgba(22,33,62,0.92) 0%, rgba(12,20,36,0.92) 100%);
        backdrop-filter: blur(8px);
        position: fixed;
    }
    .ranking-sidebar.open { transform: translateX(0); }

    /* Temas por ranking (criativos) */
    .rank-theme-bronze { background: linear-gradient(180deg, #2b1e12 0%, #3a2616 100%); }
    .rank-theme-silver { background: linear-gradient(180deg, #2a2c31 0%, #1b1d22 100%); }
    .rank-theme-gold {
        background: linear-gradient(180deg, #3a2a00 0%, #1f1700 100%);
    }
    .rank-theme-diamond {
        background: linear-gradient(180deg, rgba(10,42,51,0.95) 0%, rgba(8,31,38,0.95) 100%);
    }

    .ranking-header { display:flex; align-items:center; gap:1rem; }
    .ranking-emblem { width:72px; height:72px; border-radius:50%; display:grid; place-items:center; border:2px solid var(--primary-blue); background: radial-gradient(circle at 50% 40%, rgba(0,188,212,0.25), rgba(0,188,212,0.12)); box-shadow: 0 0 0 6px rgba(0,188,212,0.08); }
    .ranking-emblem i { font-size:2.4rem; color: var(--primary-blue); }
    .ranking-title { font-family: var(--font-display); color: var(--heading-color); font-size:1.6rem; letter-spacing: 0.5px; }
    .ranking-sub { font-size:0.95rem; opacity:0.85; }

    .ranking-card {
        background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.04));
        border:1px solid rgba(255,255,255,0.12); border-radius:16px; padding:1rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.25);
    }
    .progress { width:100%; height:12px; background: rgba(255,255,255,0.12); border-radius:999px; overflow:hidden; margin-top:0.5rem; }
    .progress-fill { height:100%; border-radius:999px; }

    /* Badges com gradiente por rank */
    .rank-badge { display:inline-block; padding: 0.4rem 0.8rem; border-radius: 999px; font-weight: 700; border: 1px solid rgba(255,255,255,0.16); box-shadow: 0 5px 12px rgba(0,0,0,0.25); }
    .rank-bronze { background: linear-gradient(90deg,#a05a2c,#cd7f32); color: #1a1a1a; }
    .rank-silver { background: linear-gradient(90deg,#9ea7af,#c0c0c0); color: #1a1a1a; }
    .rank-gold { background: linear-gradient(90deg,#ffbf00,#ffd700); color: #1a1a1a; border: 2px solid #ffec8b; box-shadow: 0 0 12px rgba(255,215,0,0.6); animation: goldGlow 2.2s ease-in-out infinite; }
    .rank-diamond { background: linear-gradient(90deg, #00bcd4, #4de4f7); color: #102a43; border: 2px solid #a0f0ff; box-shadow: 0 0 14px rgba(0,225,255,0.6); animation: diamondGlow 2.6s ease-in-out infinite; }

    /* Botão fechar do sidebar */
    .sidebar-close {
        position: absolute; top: 14px; right: 16px; width: 40px; height: 40px; border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.18); color: var(--heading-color);
        background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04));
        display: grid; place-items: center; cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.2s ease;
    }
    .sidebar-close:hover { transform: scale(1.05); box-shadow: 0 6px 16px rgba(0,0,0,0.3); }

    /* Animações */
    @keyframes goldGlow {
        0% { box-shadow: 0 0 8px rgba(255,215,0,0.4); }
        50% { box-shadow: 0 0 16px rgba(255,215,0,0.75); }
        100% { box-shadow: 0 0 8px rgba(255,215,0,0.4); }
    }
    @keyframes diamondGlow {
        0% { box-shadow: 0 0 10px rgba(0,225,255,0.4); }
        50% { box-shadow: 0 0 20px rgba(0,225,255,0.8); }
        100% { box-shadow: 0 0 10px rgba(0,225,255,0.4); }
    }
</style>

@php
    $rankClass = 'bronze';
    if (Auth::check()) {
        $pointsTmp = Auth::user()->gamification_points ?? 0;
        if ($pointsTmp >= 801) { $rankClass = 'diamond'; }
        elseif ($pointsTmp >= 401) { $rankClass = 'gold'; }
        elseif ($pointsTmp >= 201) { $rankClass = 'silver'; }
    }
@endphp

<!-- Sidebar e Overlay -->
<div id="rankingOverlay" class="ranking-overlay"></div>
<aside id="rankingSidebar" class="ranking-sidebar @auth rank-theme-{{ $rankClass }} @endauth">
    <button id="sidebarClose" class="sidebar-close" aria-label="Fechar">&times;</button>
    @auth
    @php
        $points = Auth::user()->gamification_points ?? 0;
        $rankClass = 'bronze';
        $rankLabel = 'Bronze';
        $progressPercent = max(0, min(100, round(($points / 200) * 100)));
        $nextTarget = 201;
        $emblem = 'fa-medal';
        if ($points >= 801) { $rankClass = 'diamond'; $rankLabel = 'Diamante'; $progressPercent = 100; $nextTarget = null; $emblem = 'fa-gem'; }
        elseif ($points >= 401) { $rankClass = 'gold'; $rankLabel = 'Ouro'; $progressPercent = max(0,min(100, round((($points - 400) / 400) * 100))); $nextTarget = 801; $emblem = 'fa-trophy'; }
        elseif ($points >= 201) { $rankClass = 'silver'; $rankLabel = 'Prata'; $progressPercent = max(0,min(100, round((($points - 200) / 200) * 100))); $nextTarget = 401; $emblem = 'fa-medal'; }
    @endphp
    <div class="ranking-header">
        <div class="ranking-emblem"><i class="fas {{ $emblem }}"></i></div>
        <div>
            <div class="ranking-title">Seu Ranking</div>
            <div class="ranking-sub">Olá, {{ Auth::user()->name }}</div>
        </div>
    </div>

    <div class="ranking-card" style="margin-top:0.8rem;">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
                <div class="stat-label">Rank atual</div>
                <div class="rank-badge rank-{{ $rankClass }}">{{ $rankLabel }}</div>
            </div>
            <div style="text-align:right;">
                <div class="stat-label">Total de pontos</div>
                <div class="stat-value">{{ $points }} XP</div>
            </div>
        </div>
        <div style="margin-top:0.6rem;">
            <div class="stat-label">Progresso para o próximo rank</div>
            @if ($nextTarget)
                @php $remaining = max(0, $nextTarget - $points); @endphp
                <div class="progress">
                    <div class="progress-fill" style="width: {{ $progressPercent }}%; background: {{ $rankClass == 'gold' ? 'linear-gradient(90deg,#ffbf00,#ffd700)' : ($rankClass == 'silver' ? 'linear-gradient(90deg,#9ea7af,#c0c0c0)' : 'linear-gradient(90deg,#a05a2c,#cd7f32)') }};"></div>
                </div>
                <div style="margin-top:0.3rem; opacity:0.85;">Faltam {{ $remaining }} XP para {{ $rankClass == 'silver' ? 'Ouro' : ($rankClass == 'gold' ? 'Diamante' : 'Prata') }}</div>
            @else
                <div class="progress">
                    <div class="progress-fill" style="width:100%; background: linear-gradient(90deg,#00bcd4,#4de4f7);"></div>
                </div>
                <div style="margin-top:0.3rem; opacity:0.85;">Você alcançou o topo! Continue acumulando XP para recompensas especiais.</div>
            @endif
        </div>
    </div>

    <div class="ranking-card" style="margin-top:0.8rem;">
        <div class="stat-label">Destaques do seu perfil</div>
        <ul style="margin-top:0.4rem; padding-left:1rem; display:grid; gap:0.3rem;">
            <li>Missões concluídas: <strong>{{ Auth::user()->moduleProgress()->count() }}</strong></li>
            <li>Aulas concluídas: <strong>{{ Auth::user()->lessonProgress()->count() }}</strong></li>
            <li>Nível: <strong>{{ Auth::user()->level }}</strong></li>
        </ul>
    </div>

    <div class="ranking-card" style="margin-top:0.8rem;">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:1rem;">
            <div style="display:flex;align-items:center;gap:0.8rem;">
                <div class="ranking-emblem" style="width:56px;height:56px;">
                    @php
                        $raw = Auth::user()->character_avatar ?? null;
                        $avatar = $raw
                            ? (str_starts_with($raw, 'avatars/') ? $raw : 'avatars/' . basename($raw))
                            : 'avatars/ninja-cat.svg';
                    @endphp
                    <img src="{{ asset($avatar) }}" alt="Avatar" style="width:40px;height:40px;border-radius:8px;object-fit:cover;" />
                </div>
                <div>
                    <div class="stat-label">Avatar</div>
                    <div style="opacity:0.8;font-size:0.9rem;">Escolha um personagem da plataforma</div>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('avatar.update') }}" style="margin-top:0.6rem;">
            @csrf
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0.6rem;">
                @php $options = ['avatars/alien.svg','avatars/cat.svg','avatars/dog.svg','avatars/duck.svg','avatars/fox.svg','avatars/owl.svg','avatars/panda.svg']; @endphp
                @foreach($options as $opt)
                    <label style="cursor:pointer;display:grid;place-items:center;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:0.4rem;">
                        <input type="radio" name="character_avatar" value="{{ $opt }}" @checked(($avatar ?? '') === $opt) style="margin-bottom:0.3rem;" />
                        <img src="{{ asset($opt) }}" alt="{{ $opt }}" class="pf-avatar pf-avatar--option" />
                </label>
                @endforeach
            </div>
            <button type="submit" class="tech-button" style="margin-top:0.6rem;">Salvar Avatar</button>
        </form>
        </div>
        @endauth

        @guest
        <div class="ranking-header">
            <div class="ranking-emblem"><i class="fas fa-user"></i></div>
            <div>
                <div class="ranking-title">Seu Ranking</div>
                <div class="ranking-sub">Faça login para ver seu rank e progresso</div>
            </div>
        </div>
        <div style="margin-top:0.8rem;">
            <a href="{{ route('login') }}" class="tech-button">Entrar</a>
        </div>
        @endguest

        <!-- Rodapé do sidebar com ação de Sair -->
         @auth
         <div style="margin-top:auto;display:flex;justify-content:flex-end;">
             <form method="POST" action="{{ route('logout') }}">
                 @csrf
                 <button type="submit" class="tech-button" style="background:#e74c3c;color:#fff;border:1px solid rgba(255,255,255,0.2);">Sair</button>
             </form>
         </div>
         @endauth
     </aside>
    <script>
        // Toggle do menu lateral de ranking
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('userMenuToggle');
            const sidebar = document.getElementById('rankingSidebar');
            const overlay = document.getElementById('rankingOverlay');
            const closeBtn = document.getElementById('sidebarClose');
    
            function openSidebar() {
                if (sidebar) sidebar.classList.add('open');
                if (overlay) overlay.classList.add('visible');
            }
            function closeSidebar() {
                if (sidebar) sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('visible');
            }
    
            if (toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    openSidebar();
                });
            }
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);
        });
    </script>
    </body>
    </html>
