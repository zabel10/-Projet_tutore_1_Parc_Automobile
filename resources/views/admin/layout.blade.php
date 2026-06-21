@php
    $isAjax = request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest';
@endphp
@if(!$isAjax)
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title id="page-title">@yield('title', 'AutoPark Admin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { inter: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd',
                            400: '#60a5fa', 500: '#3b82f6', 600: '#2563EB', 700: '#1d4ed8',
                            800: '#1e40af', 900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .nav-height    { height: 64px; }
        .sidebar-width { width: 260px; }
        @media (max-width: 1023px) {
            .nav-height    { height: 56px; }
            .sidebar-width { width: 280px; }
        }

        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }

        .page-enter { animation: fadeSlideIn 0.22s ease-out; }
        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    @stack('styles')
</head>
<body class="font-inter antialiased bg-slate-50 text-slate-900"
      x-data="adminApp()"
      x-init="init()"
      @keydown.escape.window="mobileSidebarOpen = false"
      x-cloak>

    {{-- TOP NAVBAR --}}
    <header class="fixed top-0 z-[60] nav-height flex items-center justify-between gap-3 border-b border-slate-200 bg-white shadow-sm px-4 sm:px-5 lg:px-6 left-0 right-0 lg:left-[260px]">
        <button @click="mobileSidebarOpen = true" class="flex-shrink-0 lg:hidden rounded-xl p-2 text-slate-600 hover:bg-slate-100 active:bg-slate-200 transition" aria-label="Ouvrir le menu">
            <i class="bi bi-list text-xl"></i>
        </button>

        <div class="min-w-0">
            <h1 class="text-sm sm:text-base font-bold text-slate-900 truncate" x-text="pageTitle" id="navbar-title">@yield('title', 'Tableau de bord')</h1>
        </div>

        <div class="flex items-center gap-1 sm:gap-2 flex-shrink-0">
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 rounded-xl p-1 pl-2 text-slate-600 hover:bg-slate-100 active:bg-slate-200 transition">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-primary-500 to-primary-700 text-xs font-black text-white uppercase shadow-sm">
                        {{ substr((string)(auth()->user()->prenom ?? 'U'), 0, 1) }}
                    </div>
                    <span class="hidden md:inline text-sm font-semibold text-slate-700 max-w-[100px] truncate">{{ auth()->user()->prenom ?? auth()->user()->name }}</span>
                    <i class="bi bi-chevron-down text-[10px] text-slate-400 hidden md:inline"></i>
                </button>
                <div x-show="open" x-cloak x-transition class="absolute right-0 top-full mt-2 w-56 origin-top-right rounded-2xl border border-slate-200 bg-white shadow-xl">
                    <div class="flex items-center gap-3 border-b border-slate-100 px-4 py-3">
                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-primary-500 to-primary-700 text-sm font-black text-white uppercase">
                            {{ substr((string)(auth()->user()->prenom ?? auth()->user()->name), 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-slate-900 truncate">{{ auth()->user()->prenom }} {{ auth()->user()->nom ?? '' }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="p-2 space-y-0.5">
                        <a href="{{ route('admin.dashboard') }}" @click.prevent="open=false; window.__adminNavigate('{{ route('admin.dashboard') }}', 'Tableau de bord')" class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 active:bg-slate-100 transition">
                            <i class="bi bi-speedometer2 text-slate-400"></i> Tableau de bord
                        </a>
                        <a href="{{ route('admin.profil.edit') }}" @click.prevent="open=false; window.__adminNavigate('{{ route('admin.profil.edit') }}', 'Mon profil')" class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 active:bg-slate-100 transition">
                            <i class="bi bi-person text-slate-400"></i> Mon profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2 text-sm text-red-600 hover:bg-red-50 active:bg-red-100 transition">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- OVERLAY --}}
    <div x-show="mobileSidebarOpen" x-cloak x-transition.opacity.duration.200 class="fixed inset-0 z-[45] bg-slate-950/50 backdrop-blur-sm lg:hidden" @click="mobileSidebarOpen = false"></div>

    {{-- SIDEBAR --}}
    <aside :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 z-[55] h-full sidebar-width bg-slate-900 text-white flex flex-col transition-transform duration-300 ease-out lg:translate-x-0" x-cloak>
        @include('admin.partials.sidebar')
    </aside>

    {{-- MAIN --}}
    <div class="pt-[64px] lg:pl-[260px] min-h-screen transition-all duration-300">
        <main class="p-4 sm:p-5 lg:p-6 xl:p-8 max-w-[1440px] 2xl:max-w-none">
            @if (session('success'))
                <div class="mb-5 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3.5 text-sm font-semibold text-emerald-700 shadow-sm">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100">
                        <i class="bi bi-check-lg text-emerald-600 text-base"></i>
                    </span>
                    <span class="flex-1">{{ session('success') }}</span>
                    <button onclick="this.closest('div').remove()" class="ml-auto rounded-lg p-1.5 hover:bg-emerald-100 transition text-emerald-600">
                        <i class="bi bi-x text-sm"></i>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-5 flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-3.5 text-sm font-semibold text-red-700 shadow-sm">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-red-100">
                        <i class="bi bi-exclamation-lg text-red-600 text-base"></i>
                    </span>
                    <span class="flex-1">{{ session('error') }}</span>
                    <button onclick="this.closest('div').remove()" class="ml-auto rounded-lg p-1.5 hover:bg-red-100 transition text-red-600">
                        <i class="bi bi-x text-sm"></i>
                    </button>
                </div>
            @endif
            <div class="page-enter">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>

<script>
function adminApp() {
    return {
        mobileSidebarOpen: false,
        pageTitle:  '',
        currentUrl: '',

        init() {
            this.currentUrl = window.location.pathname;
            this.pageTitle  = document.getElementById('navbar-title')?.textContent ?? 'Tableau de bord';
            window.__adminNavigate = (url, title) => this.navigateTo(url, title);
            refreshSidebarActive(this.currentUrl);
        },

        async navigateTo(url, title) {
            title = title ?? this.inferTitle(url);
            this.pageTitle  = title;
            this.currentUrl = url;
            this.mobileSidebarOpen = false;
            refreshSidebarActive(url);
            await this.loadPage(url, title, true);
        },

        async loadPage(url, title, pushHistory) {
            if (pushHistory) {
                history.pushState({ url, title }, '', url);
            }
            try {
                const res = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html,application/xhtml+xml',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content ?? '',
                    },
                    credentials: 'same-origin',
                });
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const html = await res.text();
                const container = document.querySelector('main .page-enter');
                if (container) {
                    container.innerHTML = html;
                    container.classList.remove('page-enter');
                    void container.offsetWidth;
                    container.classList.add('page-enter');
                }
                window.scrollTo({ top: 0, behavior: 'instant' });
                refreshSidebarActive(url);
            } catch (err) {
                console.warn('[AutoPark] AJAX fallback → chargement complet.');
                window.location.href = url;
            }
        },

        inferTitle(url) {
            const map = {
                '/admin/dashboard': 'Tableau de bord',
                '/admin/vehicules': 'Véhicules',
                '/admin/conducteurs': 'Conducteurs',
                '/admin/missions': 'Missions',
                '/admin/maintenances': 'Maintenances',
                '/admin/alertes': 'Alertes',
                '/admin/carburants': 'Carburants',
                '/admin/assurances': 'Assurances',
                '/admin/reservations': 'Réservations',
                '/admin/rapports': 'Rapports',
                '/admin/utilisateurs': 'Utilisateurs',
                '/admin/roles': 'Rôles',
                '/admin/parametres': 'Paramètres',
            };
            try {
                const path = new URL(url, location.origin).pathname;
                for (const [k, v] of Object.entries(map)) {
                    if (path.startsWith(k)) return v;
                }
            } catch (_) {}
            return 'Page';
        },
    };
}

function refreshSidebarActive(currentUrl) {
    if (!currentUrl) return;
    const currentPath = new URL(currentUrl, location.origin).pathname.replace(/\/$/, '');
    const prefixMap = [
        '{{ route('admin.dashboard') }}',
        '{{ route('admin.vehicules.index') }}',
        '{{ route('admin.conducteurs.index') }}',
        '{{ route('admin.missions.index') }}',
        '{{ route('admin.maintenances.index') }}',
        '{{ route('admin.alertes.index') }}',
        '{{ route('admin.carburants.index') }}',
        '{{ route('admin.assurances.index') }}',
        '{{ route('admin.reservations.index') }}',
        '{{ route('admin.rapports.index') }}',
        '{{ route('admin.utilisateurs.index') }}',
        '{{ route('admin.roles.index') }}',
        '{{ route('admin.parametres.index') }}',
    ];
    let activePrefix = '';
    for (const pUrl of prefixMap) {
        const pPath = new URL(pUrl, location.origin).pathname.replace(/\/$/, '');
        if (currentPath === pPath || currentPath.startsWith(pPath + '/')) {
            activePrefix = pPath;
            break;
        }
    }
    document.querySelectorAll('.sidebar-link').forEach(el => {
        const href = (el.getAttribute('href') || '').replace(/\/$/, '');
        const active = activePrefix !== '' && (href === activePrefix || activePrefix.startsWith(href + '/') || activePrefix === href);
        el.classList.toggle('bg-primary-600',          active === true);
        el.classList.toggle('text-white',               active === true);
        el.classList.toggle('shadow-md',                active === true);
        el.classList.toggle('shadow-primary-600/30',    active === true);
        el.classList.toggle('text-slate-400',           active === false);
        el.classList.toggle('hover:bg-white/5',         active === false);
        el.classList.toggle('hover:text-slate-100',     active === false);
    });
}
</script>
@endif
@if($isAjax)
    @yield('content')
@endif
