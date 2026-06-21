<nav class="flex h-full flex-col">
    {{-- Brand --}}
    <div class="flex-shrink-0 px-4 pt-5 pb-3">
        <a @click.prevent="window.__driverNavigate('{{ route('driver.dashboard') }}', 'Tableau de bord')"
           class="flex items-center gap-3 group">
            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-primary-600 text-white shadow-sm">
                <i class="bi bi-car-front-fill text-base"></i>
            </div>
            <div>
                <span class="text-sm font-black text-white tracking-tight leading-none">AutoPark</span>
                <span class="block text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">Conducteur</span>
            </div>
        </a>
    </div>

    {{-- Scrollable links --}}
    <div class="flex-1 overflow-y-auto px-3 py-2 lg:px-4 space-y-5 sidebar-scroll">

        @php
            $sidebarSections = [
                'Général' => [
                    [
                        'url'   => route('driver.dashboard'),
                        'label' => 'Tableau de bord',
                        'icon'  => 'bi-speedometer2',
                        'title' => 'Tableau de bord',
                    ],
                ],
                'Opérations' => [
                    ['url' => route('driver.missions.index'),     'label' => 'Mes missions',       'icon' => 'bi-map',            'title' => 'Missions'],
                    ['url' => route('driver.affectations.index'), 'label' => 'Mes affectations',   'icon' => 'bi-calendar-check', 'title' => 'Affectations'],
                    ['url' => route('driver.vehicule'),           'label' => 'Mon véhicule',       'icon' => 'bi-car-front',      'title' => 'Mon véhicule'],
                    ['url' => route('driver.demandes.index'),    'label' => 'Mes demandes',       'icon' => 'bi-calendar-plus',  'title' => 'Mes demandes'],
                    ['url' => route('driver.bons-sortie.index'), 'label' => 'Bons de sortie',     'icon' => 'bi-journal-text',   'title' => 'Bons de sortie'],
                ],
                'Suivi & Signalement' => [
                    ['url' => route('driver.carburants.index'),    'label' => 'Carburant',       'icon' => 'bi-fuel-pump',     'title' => 'Carburant'],
                    ['url' => route('driver.panne'),                'label' => 'Signaler une panne', 'icon' => 'bi-wrench',      'title' => 'Signaler une panne'],
                    ['url' => route('driver.maintenances.index'),  'label' => 'Maintenances',    'icon' => 'bi-tools',         'title' => 'Maintenances'],
                    ['url' => route('driver.historique'),            'label' => 'Historique',      'icon' => 'bi-clock-history', 'title' => 'Historique'],
                ],
                'Paramètres' => [
                    ['url' => route('driver.documents.index'), 'label' => 'Documents', 'icon' => 'bi-folder', 'title' => 'Documents'],
                ],
            ];
        @endphp

        @foreach($sidebarSections as $sectionLabel => $links)
            <div>
                <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">
                    {{ $sectionLabel }}
                </p>
                <ul class="space-y-0.5">
                        @foreach($links as $link)
                            <li>
                                <a href="{{ $link['url'] }}"
                                   @click.prevent="window.__driverNavigate('{{ $link['url'] }}', '{{ $link['title'] }}')"
                                    class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-semibold
                                           text-slate-400 transition-all duration-150 select-none
                                           hover:bg-white/5 hover:text-slate-100">
                                    <i class="bi {{ $link['icon'] }} text-[15px] w-5 text-center flex-shrink-0"></i>
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    {{-- Footer --}}
    <div class="flex-shrink-0 border-t border-slate-800 px-3 py-4 lg:px-4 space-y-0.5">
        <a href="{{ route('driver.profil.edit') }}"
           @click.prevent="window.__driverNavigate('{{ route('driver.profil.edit') }}', 'Mon profil')"
           class="sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-semibold
                  transition-all duration-150 select-none hover:bg-white/5 hover:text-slate-100">
        <i class="bi bi-person-circle text-[15px] w-5 text-center flex-shrink-0"></i>
            Profil
        </a>
        <form method="POST" action="{{ route('logout') }}" class="mt-1">
            @csrf
            <button type="submit"
                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-semibold
                           text-slate-400 hover:bg-red-500/10 hover:text-red-400 transition-all select-none">
                <i class="bi bi-box-arrow-right text-[15px] w-5 text-center flex-shrink-0"></i>
                Déconnexion
            </button>
        </form>
        <div class="mt-3 pt-2 border-t border-slate-800/60 text-center">
            <span class="text-[10px] font-medium text-slate-600">AutoPark · v1.0</span>
        </div>
    </div>
</nav>
