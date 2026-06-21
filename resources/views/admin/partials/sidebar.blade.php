<nav class="flex h-full flex-col">
    <div class="flex-shrink-0 px-4 pt-5 pb-3">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-primary-600 text-white shadow-sm">
                <i class="bi bi-car-front-fill text-base"></i>
            </div>
            <div>
                <span class="text-sm font-black text-white tracking-tight leading-none">AutoPark</span>
                <span class="block text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">Admin</span>
            </div>
        </a>
    </div>
    <div class="flex-1 overflow-y-auto px-3 py-2 lg:px-4 space-y-5 sidebar-scroll">
        @php
            $isAdmin = auth()->check() && auth()->user()->role === 'admin';
            $sidebarSections = [
                'Général' => [
                    ['url' => route('admin.dashboard'), 'label' => 'Tableau de bord', 'icon' => 'bi-speedometer2', 'title' => 'Tableau de bord'],
                ],
            ];

            if ($isAdmin || auth()->user()->can('manage_vehicules')) {
                $sidebarSections['Gestion du parc'] = [
                    ['url' => route('admin.vehicules.index'), 'label' => 'Véhicules', 'icon' => 'bi-car-front', 'title' => 'Véhicules'],
                    ['url' => route('admin.conducteurs.index'), 'label' => 'Conducteurs', 'icon' => 'bi-people', 'title' => 'Conducteurs'],
                    ['url' => route('admin.missions.index'), 'label' => 'Missions', 'icon' => 'bi-map', 'title' => 'Missions'],
                ];
            }

            if ($isAdmin || auth()->user()->can('manage_vehicules')) {
                $sidebarSections['Traitement'] = [
                    ['url' => route('admin.demandes.index'), 'label' => 'Demandes', 'icon' => 'bi-inbox', 'title' => 'Demandes'],
                    ['url' => route('admin.bons-sortie.index'), 'label' => 'Bons de sortie', 'icon' => 'bi-box-arrow-right', 'title' => 'Bons de sortie'],
                ];
            }

            $sidebarSections['Administration'] = [
                ['url' => route('admin.reservations.index'), 'label' => 'Réservations', 'icon' => 'bi-calendar-check', 'title' => 'Réservations'],
                ['url' => route('admin.rapports.index'), 'label' => 'Rapports', 'icon' => 'bi-bar-chart', 'title' => 'Rapports'],
            ];

            if ($isAdmin) {
                $sidebarSections['Administration'] = array_merge($sidebarSections['Administration'], [
                    ['url' => route('admin.utilisateurs.index'), 'label' => 'Utilisateurs', 'icon' => 'bi-person-badge', 'title' => 'Utilisateurs'],
                    ['url' => route('admin.roles.index'), 'label' => 'Rôles', 'icon' => 'bi-shield-lock', 'title' => 'Rôles'],
                    ['url' => route('admin.parametres.index'), 'label' => 'Paramètres', 'icon' => 'bi-gear', 'title' => 'Paramètres'],
                ]);
            }
        @endphp
        @foreach($sidebarSections as $sectionLabel => $links)
            <div>
                <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">{{ $sectionLabel }}</p>
                <ul class="space-y-0.5">
                    @foreach($links as $link)
                        <li>
                            <a href="{{ $link['url'] }}" class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-semibold text-slate-400 transition-all duration-150 select-none hover:bg-white/5 hover:text-slate-100">
                                <i class="bi {{ $link['icon'] }} text-[15px] w-5 text-center flex-shrink-0"></i>
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    <div class="flex-shrink-0 border-t border-slate-800 px-3 py-4 lg:px-4 space-y-0.5">
        <a href="{{ route('admin.profil.edit') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-semibold text-slate-400 transition-all duration-150 select-none hover:bg-white/5 hover:text-slate-100">
            <i class="bi bi-person-circle text-[15px] w-5 text-center flex-shrink-0"></i>
            Profil
        </a>
        <form method="POST" action="{{ route('logout') }}" class="mt-1">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-semibold text-slate-400 hover:bg-red-500/10 hover:text-red-400 transition-all select-none">
                <i class="bi bi-box-arrow-right text-[15px] w-5 text-center flex-shrink-0"></i>
                Déconnexion
            </button>
        </form>
        <div class="mt-3 pt-2 border-t border-slate-800/60 text-center">
            <span class="text-[10px] font-medium text-slate-600">AutoPark · v1.0</span>
        </div>
    </div>
</nav>
