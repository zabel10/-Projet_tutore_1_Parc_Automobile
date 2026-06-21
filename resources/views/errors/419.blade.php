<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Page expirée - AutoPark')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-950 text-white font-['Inter']">
    <div class="bg-slate-900/80 backdrop-blur-xl rounded-3xl border border-slate-800 p-8 max-w-md w-full mx-4 text-center shadow-2xl">
        <div class="text-5xl mb-4 text-amber-400">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-7xl font-black bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent mb-2">419</h1>
        <h2 class="text-xl font-bold text-white mb-2">Page expirée</h2>
        <div class="text-sm text-slate-400 mb-6 leading-relaxed">
            Votre session a expiré. Veuillez rafraîchir la page ou vous reconnecter.
        </div>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-primary-700 hover:scale-105 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Rafraîchir la page
        </a>
    </div>
</body>
</html>
