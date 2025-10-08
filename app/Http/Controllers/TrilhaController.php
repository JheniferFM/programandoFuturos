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

        return view('trilhas.frontend', compact('trilha', 'modulos', 'cursos'));
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

        return view('trilhas.backend', compact('trilha', 'modulos', 'cursos'));
    }

    /**
     * Mostra a página da trilha de Ciência de Dados.
     */
    public function showDados(): View
    {
        $trilha = [
            'titulo' => 'Trilha de Ciência de Dados',
            'sobre' => [
                'Bem-vindo à trilha de Ciência de Dados! Aqui você aprenderá a coletar, tratar e analisar informações para extrair insights valiosos.',
                'Essa trilha é ideal para quem gosta de estatística, programação e inteligência artificial — unindo análise lógica com criatividade.',
                'O cientista de dados transforma dados em conhecimento, utilizando programação, matemática e ferramentas de aprendizado de máquina para resolver problemas reais.'
            ],
            'aprendizados' => [
                'Fundamentos de Python e manipulação de dados',
                'Análise estatística e visualização de informações',
                'Criação de modelos de Machine Learning',
                'Trabalho com grandes volumes de dados (Big Data)',
                'Aplicações de IA em problemas do mundo real'
            ]
        ];

        $modulos = [
            ['numero' => 1, 'titulo' => 'Introdução à Ciência de Dados', 'descricao' => 'Entenda o papel do cientista de dados, principais conceitos e ferramentas do mercado.'],
            ['numero' => 2, 'titulo' => 'Python para Dados', 'descricao' => 'Aprenda a usar Python, Pandas e NumPy para manipular e analisar conjuntos de dados.'],
            ['numero' => 3, 'titulo' => 'Estatística e Visualização', 'descricao' => 'Aplique estatística e visualize informações com Matplotlib e Seaborn.'],
            ['numero' => 4, 'titulo' => 'Machine Learning Básico', 'descricao' => 'Crie modelos de aprendizado supervisionado e não supervisionado com Scikit-learn.'],
        ];

        $cursos = [
            ['titulo' => 'Python para Data Science', 'descricao' => 'Curso introdutório de Python aplicado à análise e manipulação de dados. Inclui exercícios práticos e projetos.', 'duracao' => '40 horas', 'nivel' => 'Iniciante'],
            ['titulo' => 'Estatística com Python', 'descricao' => 'Aprenda os conceitos fundamentais de estatística e probabilidade aplicados à análise de dados reais.', 'duracao' => '45 horas', 'nivel' => 'Intermediário'],
            ['titulo' => 'Machine Learning Essencial', 'descricao' => 'Entenda como criar e treinar modelos de aprendizado de máquina para classificação e regressão.', 'duracao' => '50 horas', 'nivel' => 'Intermediário'],
        ];

        return view('trilhas.dados', compact('trilha', 'modulos', 'cursos'));
    }
}
