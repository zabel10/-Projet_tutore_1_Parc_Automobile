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
    <title id="page-title">@yield('title', 'AutoPark Conducteur')</title>

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
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563EB',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
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

        .shimmer {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: shimmerAnim 1.4s infinite;
        }
        @keyframes shimmerAnim {
            0%   { background-position:  200% 0; }
            100% { background-position: -200% 0; }
        }

        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }

        .page-enter { animation: fadeSlideIn 0.22s ease-out; }
        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .skeleton-pulse {
            animation: skeletonPulse 1.5s ease-in-out infinite;
        }
        @keyframes skeletonPulse {
            0%, 100% { opacity: 1; }
            50%      { opacity: 0.4; }
        }
    </style>

    @stack('styles')
</head>
<body class="font-inter antialiased bg-slate-50 text-slate-900"
      x-data="driverApp()"
      x-init="init()"
      @keydown.escape.window="mobileSidebarOpen = false"
      x-cloak>

    {{-- ═══════════════════════════════════════════════════════════════
         TOP NAVBAR — fixe 64px (desktop) / 56px (mobile)
         : z-50 pour être AU-DESSUS de la sidebar (z-40)
    ═══════════════════════════════════════════════════════════════ --}}
    <header id="top-navbar"
        class="fixed top-0 z-[60] nav-height
               flex items-center justify-between gap-3
               border-b border-slate-200 bg-white shadow-sm
               px-4 sm:px-5 lg:px-6
               left-0 right-0
               lg:left-[260px]">

        {{-- Bouton hamburger (mobile/tablette only) --}}
        <button @click="mobileSidebarOpen = true"
                class="flex-shrink-0 lg:hidden rounded-xl p-2 text-slate-600
                       hover:bg-slate-100 active:bg-slate-200 transition"
                aria-label="Ouvrir le menu">
            <i class="bi bi-list text-xl"></i>
        </button>

        {{-- Titre de page + fil d'Ariane intégré --}}
        <div class="min-w-0">
            <h1 class="text-sm sm:text-base font-bold text-slate-900 truncate"
                x-text="pageTitle" id="navbar-title">Tableau de bord</h1>
            <p class="text-[11px] text-slate-400 mt-0.5 truncate hidden sm:block"
               x-text="dateLabel" id="navbar-date"></p>
        </div>

        {{-- Actions à droite --}}
        <div class="flex items-center gap-1 sm:gap-2 flex-shrink-0">

            {{-- Notifications --}}
            <a href="{{ route('driver.notifications.index') }}"
               @click.prevent="window.__driverNavigate('{{ route('driver.notifications.index') }}', 'Notifications')"
               class="relative rounded-xl p-2 text-slate-500 hover:bg-slate-100 active:bg-slate-200 transition"
               aria-label="Notifications">
                <i class="bi bi-bell-fill text-lg"></i>
                @php($unread = $unreadNotifications ?? 0)
                @if($unread > 0)
                    <span class="absolute top-1 right-1 flex h-4 min-w-[16px] items-center justify-center
                                 rounded-full bg-red-500 px-0.5 text-[10px] font-extrabold text-white leading-none">
                        {{ $unread }}
                    </span>
                @endif
            </a>

            {{-- Séparateur vertical --}}
            <div class="w-px h-6 bg-slate-200 hidden sm:block"></div>

            {{-- Menu utilisateur --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                        class="flex items-center gap-2 rounded-xl p-1 pl-2
                               text-slate-600 hover:bg-slate-100 active:bg-slate-200 transition">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full
                                bg-gradient-to-br from-primary-500 to-primary-700
                                text-xs font-black text-white uppercase shadow-sm">
                        {{ substr((string)(auth()->user()->prenom ?? 'U'), 0, 1) }}
                    </div>
                    <span class="hidden md:inline text-sm font-semibold text-slate-700 max-w-[100px] truncate">
                        {{ auth()->user()->prenom ?? auth()->user()->name }}
                    </span>
                    <i class="bi bi-chevron-down text-[10px] text-slate-400 hidden md:inline"></i>
                </button>

                {{-- Dropdown --}}
                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-1 scale-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-1 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 top-full mt-2 w-56 origin-top-right
                            rounded-2xl border border-slate-200 bg-white shadow-xl">
                    <div class="flex items-center gap-3 border-b border-slate-100 px-4 py-3">
                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full
                                    bg-gradient-to-br from-primary-500 to-primary-700 text-sm font-black text-white uppercase">
                            {{ substr((string)(auth()->user()->prenom ?? auth()->user()->name), 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-slate-900 truncate">
                                {{ auth()->user()->prenom }} {{ auth()->user()->nom ?? '' }}
                            </p>
                            <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="p-2 space-y-0.5">
                        <a href="{{ route('driver.profil.edit') }}"
                          @click.prevent="window.__driverNavigate('{{ route('driver.profil.edit') }}', 'Mon profil'); open = false"
                            class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm text-slate-700
                                   hover:bg-slate-50 active:bg-slate-100 transition">
                            <i class="bi bi-person text-slate-400"></i> Mon profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2 text-sm
                                           text-red-600 hover:bg-red-50 active:bg-red-100 transition">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- OVERLAY mobile --}}
    <div x-show="mobileSidebarOpen" x-cloak
         x-transition.opacity.duration.200
         class="fixed inset-0 z-[45] bg-slate-950/50 backdrop-blur-sm lg:hidden"
         @click="mobileSidebarOpen = false"></div>

    {{-- ═══════════════════════════════════════════════════════════════
         SIDEBAR — fixe gauche, toujour visible desktop, slide mobile
         z-40 (sous la navbar z-50, sur l'overlay z-45)
    ═══════════════════════════════════════════════════════════════ --}}
    <aside id="driver-sidebar"
        :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 z-[55] h-full sidebar-width
               bg-slate-900 text-white flex flex-col
               transition-transform duration-300 ease-out
               lg:translate-x-0"
        x-cloak>
        @include('driver.partials.sidebar')
    </aside>

    {{-- ═══════════════════════════════════════════════════════════════
         MAIN AREA — scrollable
         pt = hauteur navbar   •   pl = largeur sidebar (desktop)
    ═══════════════════════════════════════════════════════════════ --}}
    <div id="main-wrapper"
         class="pt-[64px] lg:pl-[260px] min-h-screen transition-all duration-300">

        {{-- Fil d'Ariane --}}
        <div id="breadcrumb-bar"
             class="border-b border-slate-100 bg-white/80 backdrop-blur-sm
                    px-4 sm:px-5 lg:px-6 xl:px-8 py-2">
            @include('driver.partials.breadcrumb', ['breadcrumbs' => $breadcrumbs ?? [['label' => 'Tableau de bord']]])
        </div>

        {{-- CONTENU PRINCIPAL --}}
        <main id="main-content"
              class="p-4 sm:p-5 lg:p-6 xl:p-8 max-w-[1440px] 2xl:max-w-none">

            @auth
                @if (auth()->user()->role === 'conducteur')

                    @if (session('success'))
                        <div class="mb-5 flex items-center gap-3 rounded-2xl border border-emerald-200
                                    bg-emerald-50 px-5 py-3.5 text-sm font-semibold text-emerald-700 shadow-sm">
                            <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100">
                                <i class="bi bi-check-lg text-emerald-600 text-base"></i>
                            </span>
                            <span class="flex-1">{{ session('success') }}</span>
                            <button @click="$el.closest('div').remove()"
                                    class="ml-auto rounded-lg p-1.5 hover:bg-emerald-100 transition text-emerald-600">
                                <i class="bi bi-x text-sm"></i>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-5 flex items-center gap-3 rounded-2xl border border-red-200
                                    bg-red-50 px-5 py-3.5 text-sm font-semibold text-red-700 shadow-sm">
                            <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-red-100">
                                <i class="bi bi-exclamation-lg text-red-600 text-base"></i>
                            </span>
                            <span class="flex-1">{{ session('error') }}</span>
                            <button @click="$el.closest('div').remove()"
                                    class="ml-auto rounded-lg p-1.5 hover:bg-red-100 transition text-red-600">
                                <i class="bi bi-x text-sm"></i>
                            </button>
                        </div>
                    @endif

                    <div id="ajax-content-inner" class="page-enter">
                        @yield('content')
                    </div>

                @else
                    <div class="flex items-center justify-center min-h-[50vh]">
                        <div class="rounded-2xl border border-red-200 bg-red-50 p-8 text-center max-w-sm shadow-sm">
                            <i class="bi bi-shield-lock-fill text-red-400 text-4xl mb-3 block"></i>
                            <h1 class="text-lg font-bold text-red-800">Accès refusé</h1>
                            <p class="mt-2 text-sm text-red-600">
                                Votre profil n'est pas autorisé à accéder à l'espace conducteur.
                            </p>
                        </div>
                    </div>
                @endif
            @else
                <div class="flex items-center justify-center min-h-[50vh]">
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-8 text-center max-w-sm shadow-sm">
                        <i class="bi bi-person-lock text-amber-400 text-4xl mb-3 block"></i>
                        <h1 class="text-lg font-bold text-amber-800">Connexion requise</h1>
                        <p class="mt-2 text-sm text-amber-700">
                            Veuillez vous connecter pour accéder au tableau de bord.
                        </p>
                        <a href="{{ route('login') }}"
                           class="mt-4 inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-2.5
                                  text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
                            <i class="bi bi-box-arrow-in-right"></i> Se connecter
                        </a>
                    </div>
                </div>
            @endauth
        </main>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         INITIAL PAGE STATE (injecté par Laravel au premier chargement)
    ═══════════════════════════════════════════════════════════════ --}}
    <script>
        window.__pageState = {{ json_encode([
            'url'         => url()->current(),
            'title'       => trim(View::getSection('title') ?: 'Tableau de bord'),
            'breadcrumbs' => $breadcrumbs ?? [['label' => 'Tableau de bord']],
            'dateLabel'   => now()->locale('fr')->isoFormat('dddd D MMMM YYYY'),
        ], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) }};
    </script>

    @stack('scripts')

    {{-- ═══════════════════════════════════════════════════════════════
         ALPINE.JS — Composant SPA principal (driverApp)
    ═══════════════════════════════════════════════════════════════ --}}
    <script>
    function driverApp() {
        return {
            mobileSidebarOpen: false,
            pageTitle:  '',
            dateLabel:  '',
            currentUrl: '',

            init() {
                const s = window.__pageState ?? {};
                this.pageTitle  = s.title  ?? 'Tableau de bord';
                this.dateLabel  = s.dateLabel ?? '';
                this.currentUrl = s.url ?? '';

                this.renderBreadcrumbs(s.breadcrumbs ?? []);
                this.syncBrowserTitle(this.pageTitle);
                refreshSidebarActive(this.currentUrl);

                window.__driverNavigate = (url, title) => this.navigateTo(url, title);

                window.addEventListener('popstate', (e) => {
                    if (e.state?.url && e.state.url !== this.currentUrl) {
                        const b = e.state.breadcrumbs
                            ?? this.buildBreadcrumbsFromTitle(e.state.title ?? '', e.state.url);
                        this.loadPage(e.state.url, e.state.title ?? b.at(-1)?.label ?? 'Page', b, false);
                    }
                });

                const mql = window.matchMedia('(min-width: 1024px)');
                mql.addEventListener('change', (e) => { if (e.matches) this.mobileSidebarOpen = false; });
            },

            // ── Navigation publique ──────────────────────────────────
            async navigateTo(url, title) {
                title   = title ?? this.inferPageTitle(url);
                const crumbs = this.buildBreadcrumbsFromTitle(title, url);

                this.pageTitle   = title;
                this.currentUrl  = url;
                this.mobileSidebarOpen = false;

                refreshSidebarActive(url);

                await this.loadPage(url, title, crumbs, true);
            },

            // ── Chargement AJAX ──────────────────────────────────────
            async loadPage(url, title, breadcrumbs, pushHistory) {
                if (pushHistory) {
                    history.pushState({ url, title, breadcrumbs }, '', url);
                }

                try {
                    const res = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html,application/xhtml+xml',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name=csrf-token]')?.content ?? '',
                        },
                        credentials: 'same-origin',
                    });

                    if (!res.ok) throw new Error(`HTTP ${res.status}`);

                    const html = await res.text();

                    const container = document.getElementById('ajax-content-inner');
                    if (container) {
                        container.innerHTML = html;
                        container.classList.remove('page-enter');
                        void container.offsetWidth;
                        container.classList.add('page-enter');
                    }

                    container?.querySelectorAll('script').forEach(old => {
                        const n = document.createElement('script');
                        Array.from(old.attributes).forEach(a => n.setAttribute(a.name, a.value));
                        n.appendChild(document.createTextNode(old.innerHTML));
                        old.replaceWith(n);
                    });

                    this.currentUrl = url;
                    this.renderBreadcrumbs(breadcrumbs);
                    this.syncBrowserTitle(title);
                    refreshSidebarActive(url);
                    window.scrollTo({ top: 0, behavior: 'instant' });

                } catch (err) {
                    console.warn('[AutoPark] AJAX fallback → chargement complet :', err.message);
                    window.location.href = url;
                }
            },

            // ── Helpers UI ───────────────────────────────────────────
            renderBreadcrumbs(crumbs) {
                const bar = document.getElementById('breadcrumb-bar');
                if (!bar) return;
                if (!crumbs?.length) {
                    bar.innerHTML = '<nav class="flex items-center gap-2 text-sm text-slate-500">'
                        + '<a href="{{ route('driver.dashboard') }}" class="hover:text-primary-600 transition">Accueil</a>'
                        + '</nav>';
                    return;
                }
                bar.innerHTML = '<nav class="flex items-center gap-2 text-sm text-slate-500">' +
                    crumbs.map((c, i) => {
                        const sep = i > 0
                            ? '<i class="bi bi-chevron-right text-[10px] text-slate-300 flex-shrink-0"></i>'
                            : '';
                        if (i === crumbs.length - 1 || !c.url) {
                            return sep + `<span class="font-semibold text-slate-700 truncate">${this.esc(c.label)}</span>`;
                        }
                        return sep + `<a href="${c.url}" class="hover:text-primary-600 transition truncate">${this.esc(c.label)}</a>`;
                    }).join('') +
                '</nav>';
            },

            syncBrowserTitle(title) {
                document.title = title ? `${title} — AutoPark Conducteur` : 'AutoPark Conducteur';
                const el = document.getElementById('page-title');
                if (el) el.textContent = title;
            },

            inferPageTitle(url) {
                const map = {
                    '/driver/dashboard':       'Tableau de bord',
                    '/driver/missions':        'Mes missions',
                    '/driver/affectations':    'Mes affectations',
                    '/driver/vehicule':        'Mon véhicule',
                    '/driver/demandes':        'Mes demandes',
                    '/driver/bons-sortie':     'Bons de sortie',
                    '/driver/carburants':      'Carburant',
                    '/driver/panne':           'Signaler une panne',
                    '/driver/maintenances':    'Maintenances',
                    '/driver/historique':      'Historique',
                    '/driver/documents':       'Documents',
                    '/driver/notifications':   'Notifications',
                    '/driver/profil':          'Mon profil',
                };
                try {
                    const path = new URL(url, location.origin).pathname;
                    for (const [k, v] of Object.entries(map)) {
                        if (path.startsWith(k)) return v;
                    }
                } catch (_) {}
                return 'Page';
            },

            buildBreadcrumbsFromTitle(title, url) {
                try {
                    const parts = new URL(url, location.origin).pathname.split('/').filter(Boolean);
                    const labels = {
                        missions:'Missions', affectations:'Affectations', vehicule:'Mon véhicule',
                        demandes:'Mes demandes', 'bons-sortie':'Bons de sortie', carburants:'Carburant',
                        panne:'Signaler une panne', maintenances:'Maintenances', historique:'Historique',
                        documents:'Documents', notifications:'Notifications', profil:'Mon profil',
                    };
                    const crumbs = [{ label: 'Accueil', url: '{{ route('driver.dashboard') }}' }];
                    let acc = '';
                    parts.forEach((p, i) => {
                        if (p === 'driver') return;
                        acc += '/' + p;
                        const lbl = labels[p] ?? this.capitalize(p);
                        const isLast = i === parts.length - 1;
                        crumbs.push({
                            label: isLast ? title : lbl,
                            url:   isLast ? '' : acc,
                        });
                    });
                    if (crumbs.length <= 1) crumbs.push({ label: title, url: '' });
                    return crumbs;
                } catch (_) {
                    return [{ label: 'Accueil', url: '{{ route('driver.dashboard') }}' }, { label: title }];
                }
            },

            capitalize(s)  { return s.replace(/[-_]/g,' ').replace(/\b\w/g, c => c.toUpperCase()); },
            esc(str)        { const d = document.createElement('div'); d.appendChild(document.createTextNode(str)); return d.innerHTML; },
        };
    }

    /* ── Active-link tracker for the sidebar ───────────────────
       Called after every AJAX navigation (and on init) so the
       sidebar always highlights the current page, independently
       of the Alpine reactive scope which lives inside <body>.    */
    function refreshSidebarActive(currentUrl) {
        if (!currentUrl) return;
        const currentPath = new URL(currentUrl, location.origin).pathname.replace(/\/$/, '');
        const prefixMap = [
            '{{ route('driver.missions.index') }}',
            '{{ route('driver.affectations.index') }}',
            '{{ route('driver.demandes.index') }}',
            '{{ route('driver.bons-sortie.index') }}',
            '{{ route('driver.carburants.index') }}',
            '{{ route('driver.maintenances.index') }}',
            '{{ route('driver.documents.index') }}',
            '{{ route('driver.notifications.index') }}',
            '{{ route('driver.vehicule') }}',
            '{{ route('driver.panne') }}',
            '{{ route('driver.historique') }}',
            '{{ route('driver.profil.edit') }}',
            '{{ route('driver.dashboard') }}',
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
            const active = activePrefix !== '' && (
                href === activePrefix || activePrefix.startsWith(href + '/') || (activePrefix === href)
            );
            el.classList.toggle('bg-primary-600',            active === true);
            el.classList.toggle('text-white',                 active === true);
            el.classList.toggle('shadow-md',                  active === true);
            el.classList.toggle('shadow-primary-600/30',     active === true);
            el.classList.toggle('text-slate-400',             active === false);
            el.classList.toggle('hover:bg-white/5',           active === false);
            el.classList.toggle('hover:text-slate-100',       active === false);
        });
    }
</script>

    @stack('end-body')
</body>
</html>
@endif
@if($isAjax)
    @auth
        @if (auth()->user()->role === 'conducteur')
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 shadow-sm">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100">
                        <i class="bi bi-check-lg text-emerald-600 text-base"></i>
                    </span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700 shadow-sm">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-red-100">
                        <i class="bi bi-exclamation-lg text-red-600 text-base"></i>
                    </span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @yield('content')
        @endif
    @endauth
@endif
