@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
    <div class="container mx-auto px-4 py-8">
        <!-- Botão de voltar -->
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-white/80 hover:text-white transition-colors duration-300 text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                    <path d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8"/>
                </svg>
                Voltar ao início
            </a>
        </div>
        
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Dashboard</h1>
            <p class="text-gray-300 text-lg">Acompanhe seu progresso de aprendizado</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Estatísticas do Usuário -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20">
                <h2 class="text-2xl font-bold text-white mb-4">Suas Estatísticas</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Nível</span>
                        <span class="text-white font-semibold">{{ auth()->user()->level ?? 1 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">XP Total</span>
                        <span class="text-white font-semibold">{{ auth()->user()->gamification_points ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Streak Atual</span>
                        <span class="text-white font-semibold">{{ auth()->user()->current_streak ?? 0 }} dias</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Melhor Streak</span>
                        <span class="text-white font-semibold">{{ auth()->user()->best_streak ?? 0 }} dias</span>
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20">
                <h2 class="text-2xl font-bold text-white mb-4">Ações Rápidas</h2>
                <div class="space-y-3">
                    <a href="/trilhas" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg transition-colors">
                        Explorar Trilhas
                    </a>
                    <a href="/quiz" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg transition-colors">
                        Fazer Quiz
                    </a>
                    <a href="/" class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white py-3 px-4 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" style="display:inline-block;vertical-align:middle;margin-right:8px;">
                            <path d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8"/>
                        </svg>
                        Voltar ao Início
                    </a>
                </div>
            </div>

            <!-- Progresso -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20">
                <h2 class="text-2xl font-bold text-white mb-4">Seu Progresso</h2>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">{{ auth()->user()->level ?? 1 }}</div>
                    <p class="text-gray-300 mb-4">Nível Atual</p>
                    <div class="w-full bg-gray-700 rounded-full h-3">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-3 rounded-full" style="width: {{ auth()->user()->level_progress ?? 0 }}%"></div>
                    </div>
                    <p class="text-gray-300 text-sm mt-2">{{ auth()->user()->level_progress ?? 0 }}% para o próximo nível</p>
                </div>
            </div>
        </div>

        <!-- Mensagem de Boas-vindas -->
        <div class="mt-12 text-center">
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-8 border border-white/20">
                <h2 class="text-3xl font-bold text-white mb-4">Bem-vindo, {{ auth()->user()->name }}!</h2>
                <p class="text-gray-300 text-lg mb-6">
                    Continue sua jornada de aprendizado em programação. Explore trilhas, complete lições e acompanhe seu progresso.
                </p>
                <a href="/trilhas" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Começar a Estudar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
