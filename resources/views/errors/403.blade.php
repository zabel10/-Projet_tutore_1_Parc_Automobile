<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Accès refusé - AutoPark')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-950 text-white font-['Inter']">
    <div class="bg-slate-900/80 backdrop-blur-xl rounded-3xl border border-slate-800 p-8 max-w-md w-full mx-4 text-center shadow-2xl">
        <div class="text-5xl mb-4 text-red-400">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-7xl font-black bg-gradient-to-r from-red-400 to-red-600 bg-clip-text text-transparent mb-2">403</h1>
        <h2 class="text-xl font-bold text-white mb-2">Accès refusé</h2>
        <div class="text-sm text-slate-400 mb-6 leading-relaxed">
            {{ $message ?? 'Vous n\'avez pas les droits nécessaires pour accéder à cette ressource.' }}
        </div>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-primary-700 hover:scale-105 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Retour à l'accueil
        </a>
    </div>
</body>
</html>
