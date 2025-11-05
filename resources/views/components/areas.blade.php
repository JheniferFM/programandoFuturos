{{-- resources/views/components/areas.blade.php --}}
<div class="areas-section" id="areas">
    <style>
        .areas-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .areas-section h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            color: #f0f0f0; /* heading-color */
            text-align: center;
            margin-bottom: 2rem;
        }

        .areas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .area-card {
            background-color: #16213e; /* card-background */
            border: 1px solid #00796b; /* border-blue */
            border-radius: 15px;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
        }

        .area-card:hover {
            transform: translateY(-10px);
            border-color: #00bcd4; /* primary-blue */
            box-shadow: 0 12px 30px rgba(0,188,212,0.2);
        }

        .area-icon {
            font-size: 3rem;
            color: #00bcd4;
            margin-bottom: 1rem;
            background-color: rgba(0,188,212,0.1);
            padding: 1rem;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80px;
            height: 80px;
            border: 1px solid #00bcd4;
        }

        .area-card h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            color: #f0f0f0;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .area-card p {
            font-size: 1rem;
            color: #e0e0e0;
            text-align: center;
        }

        .area-card.coming-soon {
            opacity: 0.7;
            filter: grayscale(80%);
            position: relative;
            border-color: #ff8c00; /* secondary-orange */
        }

        .area-card.coming-soon:hover {
            transform: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            border-color: #ff8c00;
        }

        .area-soon-tag {
            background-color: #ff8c00;
            color: #1a1a2e;
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 700;
            position: absolute;
            bottom: 1rem;
            right: 1rem;
        }
        
        .trilha-button {
            display: inline-block;
            background-color: #ff8c00; /* secondary-orange */
            color: #1a1a2e; /* background-dark-blue */
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid #ff8c00;
            box-shadow: 0 5px 15px rgba(255,140,0,0.3);
            margin-top: 1.5rem;
        }
        
        .trilha-button:hover {
            background-color: #ffa500; /* hover-light-orange */
            border-color: #ffa500;
            transform: translateY(-3px);
        }
    </style>

    <h1>Áreas de Atuação</h1>

    <div class="areas-grid">
        <div class="area-card">
            <div class="area-icon"><i class="fas fa-code"></i></div>
            <h2>Desenvolvimento Front-end</h2>
            <p>Criação de interfaces com HTML, CSS e JavaScript.</p>
            <a href="{{ route('trilhas.frontend') }}" class="trilha-button">Acessar Trilha</a>
        </div>

        <div class="area-card">
            <div class="area-icon"><i class="fas fa-server"></i></div>
            <h2>Desenvolvimento Back-end</h2>
            <p>Lógica de servidores, bancos de dados e APIs.</p>
            <a href="{{ route('trilhas.backend') }}" class="trilha-button">Acessar Trilha</a>
        </div>

        <div class="area-card">
            <div class="area-icon"><i class="fas fa-mobile-alt"></i></div>
            <h2>Desenvolvimento Mobile</h2>
            <p>Criação de aplicativos para smartphones e tablets.</p>
            <a href="{{ route('trilhas.mobile') }}" class="trilha-button">Acessar Trilha</a>
        </div>

        <div class="area-card">
            <div class="area-icon"><i class="fas fa-database"></i></div>
            <h2>Ciência de Dados</h2>
            <p>Análise e interpretação de dados complexos.</p>
            <a href="{{ route('trilhas.datascience') }}" class="trilha-button">Acessar Trilha</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const cards = document.querySelectorAll(".area-card:not(.coming-soon)");
        cards.forEach(card => {
            card.addEventListener("click", () => {
                alert(`Você clicou na área: ${card.querySelector('h2').innerText}`);
            });
        });
    });
</script>
