<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Non autorisé - AutoPark')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-950 text-white font-['Inter']">
    <div class="bg-slate-900/80 backdrop-blur-xl rounded-3xl border border-slate-800 p-8 max-w-md w-full mx-4 text-center shadow-2xl">
        <div class="text-5xl mb-4 text-blue-400">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <h1 class="text-7xl font-black bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent mb-2">401</h1>
        <h2 class="text-xl font-bold text-white mb-2">Non autorisé</h2>
        <p class="text-sm text-slate-400 mb-6 leading-relaxed">Vous devez être connecté pour accéder à cette ressource.</p>
        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-primary-700 hover:scale-105 transition-all">
            Se connecter
        </a>
    </div>
</body>
</html>
