{{-- resources/views/components/trilhas.blade.php --}}
<section id="trilhas" class="py-20 bg-white">
    <style>
        /* Estilos para a seção de trilhas */
        #trilhas {
            padding: 5rem 0;
            background-color: #f8f9fa;
        }
        
        .trilhas-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        .trilhas-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e3a8a;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .trilhas-section h1:after {
            content: '';
            position: absolute;
            bottom: -0.75rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: #0ea5e9;
            border-radius: 2px;
        }
        
        .trilhas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .trilha-card {
            background-color: #ffffff;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .trilha-card:hover {
            transform: translateY(-0.5rem);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .trilha-header {
            padding: 1.5rem;
            background-color: #0ea5e9;
            color: white;
            text-align: center;
        }
        
        .trilha-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .trilha-card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .trilha-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .trilha-card p {
            color: #4b5563;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }
        
        .trilha-button {
            display: inline-block;
            background-color: #0ea5e9;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            align-self: center;
        }
        
        .trilha-button:hover {
            background-color: #0284c7;
            transform: translateY(-0.25rem);
        }
        
        .trilha-card.coming-soon {
            opacity: 0.8;
            position: relative;
        }
        
        .trilha-card.coming-soon .trilha-header {
            background-color: #9ca3af;
        }
        
        .trilha-soon-tag {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: #ef4444;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>

    
    <div class="trilhas-section">
        <h1>Trilhas de Aprendizado</h1>

        <div class="trilhas-grid">
            <div class="trilha-card">
                <div class="trilha-header">
                    <div class="trilha-icon"><i class="fas fa-code"></i></div>
                    <h2>Desenvolvimento Front-end</h2>
                </div>
                <div class="trilha-content">
                    <p>Aprenda HTML, CSS e JavaScript para criar interfaces web incríveis.</p>
                    <a href="/trilhas/frontend" class="trilha-button">Acessar Trilha</a>
                </div>
            </div>
            
            <div class="trilha-card coming-soon">
                <div class="trilha-header">
                    <div class="trilha-icon"><i class="fas fa-server"></i></div>
                    <h2>Desenvolvimento Back-end</h2>
                </div>
                <div class="trilha-content">
                    <p>Aprenda a construir a lógica por trás das aplicações web.</p>
                </div>
                <span class="trilha-soon-tag">Em Breve</span>
            </div>
            
            <div class="trilha-card coming-soon">
                <div class="trilha-header">
                    <div class="trilha-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h2>Desenvolvimento Mobile</h2>
                </div>
                <div class="trilha-content">
                    <p>Crie aplicativos para dispositivos móveis com tecnologias modernas.</p>
                </div>
                <span class="trilha-soon-tag">Em Breve</span>
            </div>
            
            <div class="trilha-card coming-soon">
                <div class="trilha-header">
                    <div class="trilha-icon"><i class="fas fa-chart-bar"></i></div>
                    <h2>Ciência de Dados</h2>
                </div>
                <div class="trilha-content">
                    <p>Aprenda a analisar e interpretar dados para extrair insights valiosos.</p>
                </div>
                <span class="trilha-soon-tag">Em Breve</span>
            </div>
        </div>
    </div>
</section>