<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Importante: Adicione esta linha

class TrilhaController extends Controller
{
    /**
     * Mostra a página da trilha de desenvolvimento Front-end.
     */
    public function showFrontend(): View
    {
        $trilha = [
            'titulo' => 'Trilha de Desenvolvimento Front-end',
            'sobre' => [
                'Bem-vindo à trilha de Desenvolvimento Front-end! Aqui você aprenderá a criar interfaces web modernas e responsivas utilizando as tecnologias mais recentes do mercado.',
                'Esta trilha é ideal para iniciantes que desejam ingressar no mundo do desenvolvimento web, focando na parte visual e interativa das aplicações.',
                'O desenvolvimento front-end é responsável por toda a parte visual e interativa de um site ou aplicação web. É o que o usuário vê e com o que interage diretamente.'
            ],
            'aprendizados' => [
                'Estruturação de páginas com HTML semântico',
                'Estilização avançada com CSS moderno',
                'Programação interativa com JavaScript',
                'Frameworks e bibliotecas populares do mercado',
                'Técnicas de design responsivo e acessibilidade'
            ]
        ];

        $modulos = [
            ['numero' => 1, 'titulo' => 'Fundamentos de HTML', 'descricao' => 'Aprenda a estruturar páginas web com HTML5, tags semânticas e boas práticas.'],
            ['numero' => 2, 'titulo' => 'Estilização com CSS', 'descricao' => 'Domine CSS3, seletores, flexbox, grid e técnicas de design responsivo.'],
            ['numero' => 3, 'titulo' => 'JavaScript Básico', 'descricao' => 'Introdução à programação com JavaScript, manipulação do DOM e eventos.'],
            ['numero' => 4, 'titulo' => 'Frameworks Front-end', 'descricao' => 'Conheça os principais frameworks como React, Vue.js e suas aplicações.'],
        ];

        $cursos = [
            ['titulo' => 'HTML5 e CSS3 Completo', 'descricao' => 'Curso completo de HTML5 e CSS3 para iniciantes, abordando desde os conceitos básicos até técnicas avançadas de layout e responsividade.', 'duracao' => '40 horas', 'nivel' => 'Iniciante'],
            ['titulo' => 'JavaScript Moderno', 'descricao' => 'Aprenda JavaScript do zero ao avançado, incluindo ES6+, manipulação do DOM, eventos, promessas, async/await e muito mais.', 'duracao' => '50 horas', 'nivel' => 'Intermediário'],
            ['titulo' => 'React.js Essencial', 'descricao' => 'Domine o React.js e crie aplicações web modernas e reativas. Aprenda sobre componentes, hooks, context API e integração com APIs.', 'duracao' => '45 horas', 'nivel' => 'Intermediário'],
        ];

        $user = auth()->user();

        // Certifique-se de que o nome da view está correto
        return view('trilhas.frontend', compact('trilha', 'modulos', 'cursos', 'user'));
    }

    /**
     * Mostra a página da trilha de desenvolvimento Back-end.
     */
    public function showBackend(): View
    {
        $trilha = [
            'titulo' => 'Trilha de Desenvolvimento Back-end',
            'sobre' => [
                'Bem-vindo à trilha de Desenvolvimento Back-end! Aqui você aprenderá a construir a lógica de servidor, gerenciar bancos de dados e criar as APIs que dão vida às aplicações.',
                'Esta trilha é ideal para quem deseja entender o que acontece "por baixo dos panos", focando na performance, segurança e escalabilidade dos sistemas web.',
                'O desenvolvimento back-end é a espinha dorsal de qualquer aplicação. Ele processa informações, aplica regras de negócio e garante que os dados certos cheguem ao usuário de forma segura e eficiente.'
            ],
            'aprendizados' => [
                'Lógica de programação com linguagens server-side (PHP, Node.js, etc.)',
                'Criação e consumo de APIs RESTful e GraphQL',
                'Modelagem e gerenciamento de bancos de dados (SQL e NoSQL)',
                'Autenticação, autorização e princípios de segurança',
                'Arquitetura de software, como MVC e Microsserviços'
            ]
        ];

        $modulos = [
            ['numero' => 1, 'titulo' => 'Linguagens Server-Side', 'descricao' => 'Aprenda os fundamentos de uma linguagem como PHP ou Node.js e crie seus primeiros servidores web.'],
            ['numero' => 2, 'titulo' => 'APIs e Comunicação', 'descricao' => 'Domine a criação de APIs RESTful para permitir a comunicação entre o cliente e o servidor de forma eficiente.'],
            ['numero' => 3, 'titulo' => 'Bancos de Dados', 'descricao' => 'Introdução a bancos de dados relacionais (SQL) e não relacionais (NoSQL) para persistir e gerenciar dados.'],
            ['numero' => 4, 'titulo' => 'Segurança e Autenticação', 'descricao' => 'Implemente sistemas de login seguros, controle de acesso e proteja sua aplicação contra ameaças comuns.'],
        ];

        $cursos = [
            ['titulo' => 'PHP e Laravel Essencial', 'descricao' => 'Curso completo que aborda os fundamentos do PHP e te guia na construção de uma aplicação robusta com o framework Laravel.', 'duracao' => '50 horas', 'nivel' => 'Iniciante'],
            ['titulo' => 'APIs com Node.js e Express', 'descricao' => 'Aprenda a construir APIs RESTful rápidas e escaláveis utilizando o ecossistema JavaScript no back-end.', 'duracao' => '45 horas', 'nivel' => 'Intermediário'],
            ['titulo' => 'Bancos de Dados com SQL', 'descricao' => 'Domine a linguagem SQL e aprenda a modelar, consultar e gerenciar bancos de dados relacionais como MySQL e PostgreSQL.', 'duracao' => '40 horas', 'nivel' => 'Iniciante'],
        ];

        $user = auth()->user();

        // Certifique-se de que o nome da view está correto
        return view('trilhas.backend', compact('trilha', 'modulos', 'cursos', 'user'));
    }

    /**
     * Mostra a página da trilha de desenvolvimento Mobile.
     */
    public function showMobile(): View
    {
        $trilha = [
            'titulo' => 'Trilha de Desenvolvimento Mobile',
            'sobre' => [
                'Bem-vindo à trilha de Desenvolvimento Mobile! Aqui você aprenderá a criar aplicativos móveis modernos para iOS e Android.',
                'Esta trilha é ideal para quem deseja entrar no mundo do desenvolvimento de apps, focando em experiências nativas e híbridas.',
                'O desenvolvimento mobile é essencial no cenário atual, onde a maioria dos usuários acessa a internet através de dispositivos móveis.'
            ],
            'aprendizados' => [
                'Fundamentos de desenvolvimento mobile',
                'Desenvolvimento nativo (iOS e Android)',
                'Frameworks cross-platform (React Native, Flutter)',
                'Design de interfaces móveis e UX',
                'Publicação nas lojas de aplicativos'
            ]
        ];

        $modulos = [
            ['numero' => 1, 'titulo' => 'Introdução ao Mobile', 'descricao' => 'Conheça os fundamentos do desenvolvimento mobile e as principais plataformas.'],
            ['numero' => 2, 'titulo' => 'React Native Básico', 'descricao' => 'Aprenda a criar apps multiplataforma com React Native e JavaScript.'],
            ['numero' => 3, 'titulo' => 'UI/UX para Mobile', 'descricao' => 'Design de interfaces móveis, navegação e experiência do usuário.'],
            ['numero' => 4, 'titulo' => 'APIs e Backend', 'descricao' => 'Integração com APIs, armazenamento local e recursos nativos.'],
        ];

        $cursos = [
            ['titulo' => 'React Native Fundamentals', 'descricao' => 'Curso completo de React Native para criar apps multiplataforma com JavaScript.', 'duracao' => '45 horas', 'nivel' => 'Iniciante'],
            ['titulo' => 'UI/UX para Apps', 'descricao' => 'Aprenda a criar interfaces móveis intuitivas e atraentes seguindo as melhores práticas.', 'duracao' => '30 horas', 'nivel' => 'Intermediário'],
            ['titulo' => 'Recursos Nativos', 'descricao' => 'Explore recursos nativos como câmera, GPS, notificações e armazenamento local.', 'duracao' => '35 horas', 'nivel' => 'Intermediário'],
        ];

        $user = auth()->user();

        // Certifique-se de que o nome da view está correto
        return view('trilhas.mobile', compact('trilha', 'modulos', 'cursos', 'user'));
    }

    /**
     * Mostra a página da trilha de Ciência de Dados.
     */
    public function showDataScience(): View
    {
        $trilha = [
            'titulo' => 'Trilha de Ciência de Dados',  // Changed from 'nome' to 'titulo'
            'sobre' => [
                'Bem-vindo à trilha de Ciência de Dados! Aqui você aprenderá análise e interpretação de dados através de tecnologias e métodos modernos.',
                'Esta trilha é ideal para quem deseja trabalhar com análise de dados, machine learning e inteligência artificial, focando em soluções práticas e cases reais.',
                'A ciência de dados é fundamental no cenário atual, onde a análise de grandes volumes de dados é crucial para tomada de decisões estratégicas e inovação.'
            ],
            'aprendizados' => [
                'Fundamentos de estatística e probabilidade',
                'Programação com Python para análise de dados',
                'Machine Learning e modelos preditivos',
                'Visualização e storytelling com dados',
                'Big Data e ferramentas de análise em larga escala'
            ]
        ];

        $modulos = [
            ['numero' => 1, 'titulo' => 'Introdução à Ciência de Dados', 'descricao' => 'Fundamentos e conceitos básicos de análise de dados, estatística e programação.'],
            ['numero' => 2, 'titulo' => 'Python e Pandas', 'descricao' => 'Análise de dados com Python, Pandas e NumPy para manipulação eficiente de dados.'],
            ['numero' => 3, 'titulo' => 'Visualização de Dados', 'descricao' => 'Criação de visualizações efetivas com matplotlib, seaborn e técnicas de storytelling.'],
            ['numero' => 4, 'titulo' => 'Machine Learning', 'descricao' => 'Introdução ao aprendizado de máquina com scikit-learn e casos práticos.'],
        ];

        $cursos = [
            ['titulo' => 'Python para Dados', 'descricao' => 'Curso completo de Python focado em análise de dados e bibliotecas essenciais.', 'duracao' => '40 horas', 'nivel' => 'Iniciante'],
            ['titulo' => 'Estatística Prática', 'descricao' => 'Aprenda estatística aplicada à análise de dados com exemplos reais.', 'duracao' => '35 horas', 'nivel' => 'Intermediário'],
            ['titulo' => 'ML Fundamentals', 'descricao' => 'Fundamentos de Machine Learning com aplicações práticas e cases.', 'duracao' => '45 horas', 'nivel' => 'Intermediário']
        ];

        $user = auth()->user();

        return view('trilhas.datascience', compact('trilha', 'modulos', 'cursos', 'user'));
    }

    // Sincroniza pontos (XP) das trilhas com o ranking do usuário
    public function syncPoints(Request $request)
    {
        $validated = $request->validate([
            'points' => 'required|integer|min:0',
            'source' => 'nullable|string|max:100',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        // Incrementa os pontos de gamificação do usuário
        $user->increment('gamification_points', (int) $validated['points']);

        return response()->json([
            'success' => true,
            'new_points' => $user->gamification_points,
            'source' => $validated['source'] ?? null,
        ]);
    }
}

