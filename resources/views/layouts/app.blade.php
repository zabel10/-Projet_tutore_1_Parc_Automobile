<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AutoPark - Gestion Parc Automobile')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            600: '#2563EB',
                            700: '#1D4ED8',
                            900: '#0F172A',
                        }
                    },
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>

    @stack('styles')
</head>
<body class="font-inter bg-slate-50 text-slate-800 antialiased">
    <nav class="sticky top-0 z-50 bg-slate-900/95 backdrop-blur-lg border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-white font-extrabold text-xl tracking-tight hover:text-white transition">
                    <i class="bi bi-car-front-fill text-blue-500 text-2xl"></i>
                    AutoPark
                </a>

                <ul class="hidden lg:flex items-center gap-1">
                    <li>
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            <i class="bi bi-house-door me-1.5"></i>Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('presentation') }}" class="nav-link {{ request()->routeIs('presentation') ? 'active' : '' }}">
                            <i class="bi bi-info-circle me-1.5"></i>À propos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#modules" class="nav-link">
                            <i class="bi bi-grid me-1.5"></i>Modules
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#testimonials" class="nav-link">
                            <i class="bi bi-chat-quote me-1.5"></i>Témoignages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#contact" class="nav-link">
                            <i class="bi bi-envelope me-1.5"></i>Contact
                        </a>
                    </li>
                </ul>

                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="border border-slate-600 text-white rounded-xl px-4 py-2 text-sm font-bold hover:bg-slate-800 transition">
                        <i class="bi bi-box-arrow-in-right me-1.5"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="bg-primary-600 text-white rounded-xl px-4 py-2 text-sm font-bold hover:bg-primary-700 shadow-lg shadow-primary-600/20 transition">
                        <i class="bi bi-person-plus me-1.5"></i>Inscription
                    </a>
                </div>

                <button id="mobile-menu-btn" class="lg:hidden text-slate-300 hover:text-white p-2 rounded-lg hover:bg-white/10 transition">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>

            <div id="mobile-menu" class="hidden lg:hidden pb-4">
                <ul class="flex flex-col gap-1">
                    <li><a href="{{ route('home') }}" class="nav-link block">Accueil</a></li>
                    <li><a href="{{ route('presentation') }}" class="nav-link block">À propos</a></li>
                    <li><a href="{{ route('home') }}#modules" class="nav-link block">Modules</a></li>
                    <li><a href="{{ route('home') }}#testimonials" class="nav-link block">Témoignages</a></li>
                    <li><a href="{{ route('home') }}#contact" class="nav-link block">Contact</a></li>
                    <li class="flex gap-2 pt-2">
                        <a href="{{ route('login') }}" class="border border-slate-600 text-white rounded-xl px-4 py-2 text-sm font-bold hover:bg-slate-800 transition flex-1 text-center">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-primary-600 text-white rounded-xl px-4 py-2 text-sm font-bold hover:bg-primary-700 transition flex-1 text-center">Inscription</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <style>
        .nav-link {
            color: #cbd5e1;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
        }
        .nav-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
        }
    </style>

    <main class="pt-20">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            btn.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
