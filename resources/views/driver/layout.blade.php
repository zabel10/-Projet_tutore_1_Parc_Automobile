<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tableau de bord conducteur - Gestion Parc Automobile')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.14.8/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="driver-layout bg-slate-50 text-slate-900 antialiased" x-data="{ sidebarOpen: false, notificationsOpen: false, profileOpen: false }" @keydown.escape.window="sidebarOpen = false; notificationsOpen = false; profileOpen = false" x-cloak>
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-slate-950/60 lg:hidden" @click="sidebarOpen = false" x-cloak></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="driver-sidebar fixed inset-y-0 left-0 z-50 w-64 -translate-x-full bg-slate-950 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 lg:flex lg:flex-col" x-cloak>
        @include('driver.partials.sidebar')
    </aside>

    <div class="driver-shell min-h-screen lg:pl-64">
        @include('driver.partials.topbar')

        <main class="driver-content p-4 sm:p-6 lg:p-8">
            @auth
                @can('view-conducteur-dashboard', auth()->user())
                    @if (session('success'))
                        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700 shadow-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                @else
                    <div class="rounded-2xl border border-red-200 bg-red-50 p-6 text-red-700 shadow-sm">
                        <h1 class="text-xl font-bold">Accès refusé</h1>
                        <p class="mt-2">Votre profil n'est pas autorisé à accéder à l'espace conducteur.</p>
                    </div>
                @endcan
            @else
                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6 text-amber-700 shadow-sm">
                    <h1 class="text-xl font-bold">Connexion requise</h1>
                    <p class="mt-2">Veuillez vous connecter pour accéder au tableau de bord conducteur.</p>
                    <a href="{{ route('login') }}" class="mt-4 inline-flex rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        Se connecter
                    </a>
                </div>
            @endauth
        </main>
    </div>

    @stack('scripts')
</body>
</html>