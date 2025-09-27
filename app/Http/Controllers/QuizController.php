<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class QuizController extends Controller
{
    /**
     * Mostra a página inicial do questionário gamificado
     */
    public function index()
    {
        return view('quiz.index');
    }

    /**
     * Mostra uma pergunta específica do questionário
     */
    public function showQuestion($step)
    {
        // Verifica se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Você precisa estar logado para fazer o questionário');
        }

        // Obtém o usuário atual
        $user = auth()->user();
        
        // Verifica se o usuário já completou o questionário
        if ($user->quiz_completed) {
            return redirect()->route('quiz.results');
        }

        // Verifica se o usuário está tentando acessar uma etapa que não deveria
        if ($step > $user->quiz_progress + 1) {
            return redirect()->route('quiz.question', ['step' => $user->quiz_progress + 1]);
        }

        // Define as perguntas do questionário
        $questions = $this->getQuizQuestions();
        
        // Verifica se a etapa solicitada existe
        if ($step > count($questions)) {
            return redirect()->route('quiz.results');
        }

        // Obtém a pergunta atual
        $currentQuestion = $questions[$step - 1];

        return view('quiz.question', [
            'step' => $step,
            'totalSteps' => count($questions),
            'question' => $currentQuestion,
            'progress' => ($step / count($questions)) * 100
        ]);
    }

    /**
     * Processa a resposta do usuário para uma pergunta
     */
    public function submitAnswer(Request $request, $step)
    {
        // Verifica se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Valida a resposta
        $request->validate([
            'answer' => 'required|string'
        ]);

        // Obtém o usuário atual
        $user = auth()->user();
        
        // Obtém as perguntas do questionário
        $questions = $this->getQuizQuestions();
        
        // Verifica se a etapa é válida
        if ($step < 1 || $step > count($questions)) {
            return redirect()->route('quiz.question', ['step' => 1]);
        }

        // Armazena a resposta do usuário
        $quizResults = $user->quiz_results ?? [];
        $quizResults[$step] = $request->answer;
        $user->quiz_results = $quizResults;
        
        // Atualiza o progresso do usuário
        if ($step > $user->quiz_progress) {
            $user->quiz_progress = $step;
            
            // Adiciona pontos de gamificação
            $user->gamification_points += 10;
        }
        
        // Verifica se o questionário foi concluído
        if ($step == count($questions)) {
            $user->quiz_completed = true;
            
            // Adiciona pontos bônus por completar o questionário
            $user->gamification_points += 50;
            
            // Verifica e
            
            // Calcula as recomendações de trilhas
            $this->calculateRecommendations($user);
        }
        
        $user->save();
        
        // Redireciona para a próxima pergunta ou para os resultados
        if ($step < count($questions)) {
            return redirect()->route('quiz.question', ['step' => $step + 1]);
        } else {
            return redirect()->route('quiz.results');
        }
    }

    /**
     * Mostra os resultados do questionário e as recomendações de trilhas
     */
    public function showResults()
    {
        // Verifica se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Obtém o usuário atual
        $user = auth()->user();
        
        // Verifica se o usuário completou o questionário
        if (!$user->quiz_completed) {
            return redirect()->route('quiz.question', ['step' => $user->quiz_progress + 1]);
        }

        return view('quiz.results', [
            'user' => $user,
            'recommendedTracks' => $user->recommended_tracks ?? [],

        ]);
    }

    /**
     * Reinicia o questionário para o usuário atual
     */
    public function resetQuiz()
    {
        // Verifica se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Obtém o usuário atual
        $user = auth()->user();
        
        // Reinicia os dados do questionário
        $user->quiz_results = null;
        $user->quiz_progress = 0;
        $user->quiz_completed = false;
        $user->recommended_tracks = null;
        $user->save();
        
        return redirect()->route('quiz.index')->with('message', 'Questionário reiniciado com sucesso!');
    }

    /**
     * Calcula as recomendações de trilhas com base nas respostas do questionário
     */
    private function calculateRecommendations($user)
    {
        // Inicializa os scores para cada trilha
        $trackScores = [
            'frontend' => 0,
            'backend' => 0,
            'mobile' => 0,
            'data' => 0,
            'devops' => 0,
            'design' => 0
        ];
        
        // Mapeia as respostas para os scores das trilhas
        $quizResults = $user->quiz_results;
        
        // Pergunta 1: Você prefere trabalhar com...
        if (isset($quizResults[1])) {
            switch ($quizResults[1]) {
                case 'visual':
                    $trackScores['frontend'] += 3;
                    $trackScores['design'] += 3;
                    $trackScores['mobile'] += 2;
                    break;
                case 'logica':
                    $trackScores['backend'] += 3;
                    $trackScores['data'] += 3;
                    $trackScores['devops'] += 2;
                    break;
                case 'ambos':
                    $trackScores['frontend'] += 2;
                    $trackScores['backend'] += 2;
                    $trackScores['mobile'] += 3;
                    break;
            }
        }
        
        // Pergunta 2: O que mais te interessa...
        if (isset($quizResults[2])) {
            switch ($quizResults[2]) {
                case 'interfaces':
                    $trackScores['frontend'] += 3;
                    $trackScores['design'] += 3;
                    break;
                case 'dados':
                    $trackScores['data'] += 3;
                    $trackScores['backend'] += 2;
                    break;
                case 'sistemas':
                    $trackScores['backend'] += 3;
                    $trackScores['devops'] += 3;
                    break;
                case 'apps':
                    $trackScores['mobile'] += 3;
                    $trackScores['frontend'] += 1;
                    break;
            }
        }
        
        // Pergunta 3: Como você se vê trabalhando...
        if (isset($quizResults[3])) {
            switch ($quizResults[3]) {
                case 'criativo':
                    $trackScores['design'] += 3;
                    $trackScores['frontend'] += 2;
                    break;
                case 'analitico':
                    $trackScores['data'] += 3;
                    $trackScores['backend'] += 2;
                    break;
                case 'pratico':
                    $trackScores['mobile'] += 2;
                    $trackScores['frontend'] += 2;
                    $trackScores['backend'] += 1;
                    break;
                case 'infraestrutura':
                    $trackScores['devops'] += 3;
                    $trackScores['backend'] += 1;
                    break;
            }
        }
        
        // Pergunta 4: Qual tipo de projeto mais te motiva
        if (isset($quizResults[4])) {
            switch ($quizResults[4]) {
                case 'ecommerce':
                    $trackScores['frontend'] += 2;
                    $trackScores['backend'] += 2;
                    break;
                case 'jogos':
                    $trackScores['frontend'] += 3;
                    $trackScores['mobile'] += 2;
                    break;
                case 'educacao':
                    $trackScores['frontend'] += 2;
                    $trackScores['backend'] += 1;
                    $trackScores['design'] += 1;
                    break;
                case 'saude':
                    $trackScores['backend'] += 3;
                    $trackScores['data'] += 2;
                    break;
            }
        }
        
        // Pergunta 5: Você prefere trabalhar com
        if (isset($quizResults[5])) {
            switch ($quizResults[5]) {
                case 'equipe':
                    $trackScores['frontend'] += 1;
                    $trackScores['backend'] += 1;
                    break;
                case 'individual':
                    $trackScores['data'] += 2;
                    $trackScores['backend'] += 1;
                    break;
                case 'lideranca':
                    $trackScores['devops'] += 2;
                    $trackScores['backend'] += 1;
                    break;
                case 'consultoria':
                    $trackScores['backend'] += 2;
                    $trackScores['devops'] += 1;
                    break;
            }
        }
        
        // Pergunta 6: Qual tecnologia mais desperta sua curiosidade
        if (isset($quizResults[6])) {
            switch ($quizResults[6]) {
                case 'ia':
                    $trackScores['data'] += 3;
                    $trackScores['backend'] += 2;
                    break;
                case 'blockchain':
                    $trackScores['backend'] += 3;
                    $trackScores['data'] += 1;
                    break;
                case 'iot':
                    $trackScores['backend'] += 2;
                    $trackScores['devops'] += 2;
                    break;
                case 'realidade':
                    $trackScores['frontend'] += 3;
                    $trackScores['mobile'] += 2;
                    break;
            }
        }
        
        // Pergunta 7: Como você gosta de aprender
        if (isset($quizResults[7])) {
            switch ($quizResults[7]) {
                case 'pratica':
                    $trackScores['frontend'] += 1;
                    $trackScores['mobile'] += 1;
                    break;
                case 'teoria':
                    $trackScores['data'] += 2;
                    $trackScores['backend'] += 1;
                    break;
                case 'videos':
                    $trackScores['frontend'] += 1;
                    $trackScores['design'] += 1;
                    break;
                case 'comunidade':
                    $trackScores['devops'] += 1;
                    $trackScores['backend'] += 1;
                    break;
            }
        }
        
        // Pergunta 8: Qual área de negócio mais te interessa
        if (isset($quizResults[8])) {
            switch ($quizResults[8]) {
                case 'fintech':
                    $trackScores['backend'] += 3;
                    $trackScores['data'] += 2;
                    break;
                case 'startup':
                    $trackScores['frontend'] += 2;
                    $trackScores['mobile'] += 2;
                    break;
                case 'corporativo':
                    $trackScores['backend'] += 2;
                    $trackScores['devops'] += 2;
                    break;
                case 'social':
                    $trackScores['frontend'] += 2;
                    $trackScores['design'] += 2;
                    break;
            }
        }
        
        // Pergunta 9: Você se considera mais
        if (isset($quizResults[9])) {
            switch ($quizResults[9]) {
                case 'detalhista':
                    $trackScores['backend'] += 2;
                    $trackScores['data'] += 1;
                    break;
                case 'rapido':
                    $trackScores['frontend'] += 2;
                    $trackScores['mobile'] += 1;
                    break;
                case 'inovador':
                    $trackScores['design'] += 3;
                    $trackScores['frontend'] += 1;
                    break;
                case 'organizador':
                    $trackScores['devops'] += 3;
                    $trackScores['backend'] += 1;
                    break;
            }
        }
        
        // Pergunta 10: Qual é seu objetivo principal na programação
        if (isset($quizResults[10])) {
            switch ($quizResults[10]) {
                case 'carreira':
                    $trackScores['backend'] += 2;
                    $trackScores['devops'] += 1;
                    break;
                case 'empreender':
                    $trackScores['frontend'] += 2;
                    $trackScores['mobile'] += 2;
                    break;
                case 'freelancer':
                    $trackScores['frontend'] += 2;
                    $trackScores['design'] += 2;
                    break;
                case 'hobby':
                    $trackScores['frontend'] += 1;
                    $trackScores['mobile'] += 1;
                    break;
            }
        }
        
        // Ordena as trilhas por score
        arsort($trackScores);
        
        // Seleciona as 3 trilhas com maior score
        $recommendedTracks = [];
        $i = 0;
        foreach ($trackScores as $track => $score) {
            if ($i < 3) {
                $recommendedTracks[] = [
                    'track' => $track,
                    'score' => $score,
                    'match_percentage' => min(round(($score / 9) * 100), 100) // 9 é o score máximo possível
                ];
            }
            $i++;
        }
        
        // Salva as recomendações no usuário
        $user->recommended_tracks = $recommendedTracks;
        $user->interests = array_keys(array_slice($trackScores, 0, 3, true));
    }

    /**
     * Retorna as perguntas do questionário
     */
    private function getQuizQuestions()
    {
        return [
            [
                'question' => 'Você prefere trabalhar com:',
                'options' => [
                    'visual' => 'Elementos visuais e design',
                    'logica' => 'Lógica e processamento de dados',
                    'ambos' => 'Um pouco de cada'
                ]
            ],
            [
                'question' => 'O que mais te interessa:',
                'options' => [
                    'interfaces' => 'Criar interfaces bonitas e funcionais',
                    'dados' => 'Analisar e processar grandes volumes de dados',
                    'sistemas' => 'Desenvolver sistemas robustos e escaláveis',
                    'apps' => 'Criar aplicativos para dispositivos móveis'
                ]
            ],
            [
                'question' => 'Como você se vê trabalhando:',
                'options' => [
                    'criativo' => 'Em um ambiente criativo, desenvolvendo soluções visuais',
                    'analitico' => 'Analisando dados e encontrando padrões',
                    'pratico' => 'Desenvolvendo soluções práticas para problemas reais',
                    'infraestrutura' => 'Configurando e mantendo infraestrutura de sistemas'
                ]
            ],
            [
                'question' => 'Qual tipo de projeto mais te motiva:',
                'options' => [
                    'ecommerce' => 'Lojas virtuais e sistemas de vendas online',
                    'jogos' => 'Desenvolvimento de jogos e entretenimento',
                    'educacao' => 'Plataformas educacionais e e-learning',
                    'saude' => 'Sistemas para área da saúde e bem-estar'
                ]
            ],
            [
                'question' => 'Você prefere trabalhar com:',
                'options' => [
                    'equipe' => 'Em equipe, colaborando com outros desenvolvedores',
                    'individual' => 'Sozinho, focando em suas próprias tarefas',
                    'lideranca' => 'Liderando projetos e orientando outros',
                    'consultoria' => 'Como consultor, resolvendo problemas específicos'
                ]
            ],
            [
                'question' => 'Qual tecnologia mais desperta sua curiosidade:',
                'options' => [
                    'ia' => 'Inteligência Artificial e Machine Learning',
                    'blockchain' => 'Blockchain e criptomoedas',
                    'iot' => 'Internet das Coisas (IoT)',
                    'realidade' => 'Realidade Virtual e Aumentada'
                ]
            ],
            [
                'question' => 'Como você gosta de aprender:',
                'options' => [
                    'pratica' => 'Fazendo projetos práticos',
                    'teoria' => 'Estudando conceitos e documentação',
                    'videos' => 'Assistindo vídeos e tutoriais',
                    'comunidade' => 'Participando de comunidades e fóruns'
                ]
            ],
            [
                'question' => 'Qual área de negócio mais te interessa:',
                'options' => [
                    'fintech' => 'Tecnologia financeira (Fintech)',
                    'startup' => 'Startups e inovação',
                    'corporativo' => 'Grandes empresas e sistemas corporativos',
                    'social' => 'Projetos com impacto social'
                ]
            ],
            [
                'question' => 'Você se considera mais:',
                'options' => [
                    'detalhista' => 'Detalhista e perfeccionista',
                    'rapido' => 'Rápido na execução de tarefas',
                    'inovador' => 'Inovador e criativo',
                    'organizador' => 'Organizador e planejador'
                ]
            ],
            [
                'question' => 'Qual é seu objetivo principal na programação:',
                'options' => [
                    'carreira' => 'Construir uma carreira sólida em TI',
                    'empreender' => 'Empreender e criar meu próprio negócio',
                    'freelancer' => 'Trabalhar como freelancer',
                    'hobby' => 'Programar como hobby e interesse pessoal'
                ]
            ]
        ];
    }
}
