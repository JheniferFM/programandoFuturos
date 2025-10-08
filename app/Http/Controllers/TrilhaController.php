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

        // Certifique-se de que o nome da view está correto
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

        // Certifique-se de que o nome da view está correto
        return view('trilhas.backend', compact('trilha', 'modulos', 'cursos'));
    }

       public function showMobile(): View
    {
        $trilha = [
            'titulo' => 'Trilha de Desenvolvimento Mobile',
            'sobre' => [
                    'Bem-vindo à trilha de Desenvolvimento Mobile! Aqui você aprenderá a criar aplicativos modernos e interativos para Android e iOS, explorando desde os fundamentos até o deploy nas lojas oficiais.',
        'Esta trilha é ideal para quem deseja dominar o ecossistema mobile, unindo design, performance e integração com APIs e serviços em nuvem.',
        'O desenvolvimento mobile está no centro da inovação digital, permitindo levar experiências completas e conectadas diretamente ao bolso dos usuários.'
            ],
            'aprendizados' => [
                'Conceitos fundamentais de desenvolvimento mobile (nativo, híbrido e multiplataforma)',
        'Criação de interfaces responsivas e interativas com React Native ou Flutter',
        'Consumo de APIs RESTful e integração com serviços externos (Firebase, bancos de dados, etc.)',
        'Gerenciamento de estado, navegação entre telas e armazenamento local',
        'Publicação e manutenção de aplicativos nas lojas (Google Play e App Store)'
            ]
        ];

        $modulos = [
            ['numero' => 1, 'titulo' => 'Fundamentos do Desenvolvimento Mobile', 'descricao' => 'Aprenda sobre conceitos, ecossistema Android/IOS e a configurar seu ambiente;'],
            ['numero' => 2, 'titulo' => 'Introdução ap React Native/Flutter' , 'descricao' => 'Aprenda a criar interfaces móveis com React Native, componentes, navegação e consumo de APIs'],
            ['numero' => 3, 'titulo' => 'Integração com Backend e Banco de dados', 'descricao' => 'Conecte seus apps a uma API real, trabalher com autenticação, persistencia e CRUD de dados.'],
            ['numero' => 4, 'titulo' => 'Publicação e Otimização de Aplicativos', 'descricao' => 'Prepare seu app apra produção, otimize desempenho e publique ma Google Play ou App Store.'],
        ];

        $cursos = [
            ['titulo' => 'React Native Essencial', 'descricao' => 'Aprenda a criar aplicativos móveis multiplataforma com React Native. Domine componentes, navegação, consumo de APIs e integração com o backend..', 'duracao' => '50 horas', 'nivel' => 'Iniciante'],
            ['titulo' => 'Flutter e Dart Completo', 'descricao' => 'Domine o framework Flutter e a linguagem Dart para desenvolver apps nativos de alta performance para Android e iOS com uma única base de código.', 'duracao' => '45 horas', 'nivel' => 'Intermediário'],
            ['titulo' => 'Integração com Firebase para Mobile', 'descricao' => 'Aprenda a conectar seus aplicativos a serviços Firebase, incluindo autenticação, banco de dados em tempo real, armazenamento e notificações push.', 'duracao' => '40 horas', 'nivel' => 'Intermediario'],
        ];

        // Certifique-se de que o nome da view está correto
        return view('trilhas.Mobile', compact('trilha', 'modulos', 'cursos'));
    }




}

