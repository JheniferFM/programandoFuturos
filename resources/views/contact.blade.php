<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Programando Futuros</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --background-dark-blue: #1a1a2e;
            --card-background: #16213e;
            --border-blue: #00796b;
            --primary-blue: #00bcd4;
            --secondary-orange: #ff8c00;
            --text-color: #e0e0e0;
            --heading-color: #f0f0f0;
            --font-primary: 'Montserrat', sans-serif;
            --font-display: 'Orbitron', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: var(--font-primary);
            background-color: var(--background-dark-blue);
            color: var(--text-color);
            line-height: 1.6;
        }

        .contact-container {
            max-width: 800px;
            margin: 4rem auto;
            padding: 2rem;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .contact-title {
            font-family: var(--font-display);
            font-size: 2.5rem;
            color: var(--heading-color);
            margin-bottom: 1rem;
        }

        .contact-subtitle {
            color: var(--text-color);
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .contact-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .contact-card {
            background: var(--card-background);
            border: 1px solid var(--border-blue);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .contact-method-title {
            font-family: var(--font-display);
            color: var(--heading-color);
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .contact-link {
            color: var(--secondary-orange);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .contact-link:hover {
            color: var(--primary-blue);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--secondary-orange);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .back-button:hover {
            color: var(--primary-blue);
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <a href="/" class="back-button">
            <i class="fas fa-arrow-left"></i> Voltar para Home
        </a>

        <div class="contact-header">
            <h1 class="contact-title">Entre em Contato</h1>
            <p class="contact-subtitle">Estamos aqui para ajudar! Escolha a melhor forma de contato para você.</p>
        </div>

        <div class="contact-methods">
            <div class="contact-card">
                <i class="fas fa-envelope contact-icon"></i>
                <h2 class="contact-method-title">Email</h2>
                <p>Para dúvidas e parcerias</p>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=programandofuturosprojeto@gmail.com" class="contact-link">
                    Entre em contato <i class="fas fa-external-link-alt"></i>
                </a>
            </div>

            <div class="contact-card">
                <i class="fab fa-github contact-icon"></i>
                <h2 class="contact-method-title">GitHub</h2>
                <p>Acompanhe nosso projeto</p>
                <a href="https://github.com/ProgramandoFuturos" target="_blank" class="contact-link">
                    ProgramandoFuturos <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
    </div>
</body>
</html>