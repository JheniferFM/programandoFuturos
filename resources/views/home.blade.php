@extends('layouts.app')

@section('title', 'Programando Futuros | Guia de Estudos em Tecnologia')

@section('content')

<div class="particles" id="particles-js"></div>

<header class="tech-header">
    <div class="logo-container">
        <div class="logo-wrapper">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Logo Programando Futuros" class="site-logo">
            <div class="logo-text">
                <span class="main-logo">Programando</span>
                <span class="highlight-logo">Futuros</span>
                <p class="subtitle">Guia de Carreiras em Tecnologia</p>
            </div>
        </div>
    </div>
    <nav class="tech-nav">
        <ul>
            <li><a href="#home" class="nav-link hover-underline">Home</a></li>
            <li><a href="#areas" class="nav-link hover-underline">Áreas</a></li>
            <li><a href="#trilhas" class="nav-link hover-underline">Trilhas</a></li>
            <li><a href="#sobre" class="nav-link hover-underline">Sobre</a></li>
            <li><a href="mailto:programandofuturos5@gmail.com" class="nav-link hover-underline">Contato</a></li>
        </ul>
    </nav>
</header>

<main>
    @include('partials.hero')
    @include('partials.about')
    @include('partials.areas')
    @include('partials.trails')
    @include('partials.team')
    @include('partials.contact')
</main>

<footer class="tech-footer">
    @include('partials.footer')
</footer>

@endsection
