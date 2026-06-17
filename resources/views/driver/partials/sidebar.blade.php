<div class="flex h-full flex-col">
    <div class="driver-sidebar-logo flex items-center gap-3 border-b border-white/10 px-6 py-6">
        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600 shadow-lg shadow-blue-950/30">
            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8m-8 4h8m-6 4h4M5.6 7.5l.9-1.4A2 2 0 0 1 8.2 5h7.6a2 2 0 0 1 1.7 1.1l.9 1.4M5 11h14l-.9 6.2A2 2 0 0 1 16.1 19H7.9a2 2 0 0 1-2-1.8L5 11Z" />
            </svg>
        </div>
        <div class="driver-sidebar-logo-text">
            <h1 class="text-sm font-black uppercase leading-tight text-white">Parc Automobile</h1>
        </div>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
        @php
            $menuItems = [
                ['label' => 'Tableau de bord', 'route' => 'driver.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-6a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 001 1h3a1 1 0 001-1V10M5 10h14'],
                ['label' => 'Mes missions', 'route' => 'driver.missions.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                ['label' => 'Mes affectations', 'route' => 'driver.affectations.index', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0Zm6 3a2 2 0 11-4 0 2 2 0 014 0Z'],
                ['label' => 'Bons de sortie', 'route' => 'driver.bons-sortie.index', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['label' => 'Mes demandes', 'route' => 'driver.demandes.index', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                ['label' => 'Ravitaillements', 'route' => 'driver.carburants.index', 'icon' => 'M17.303 8.35a3.5 3.5 0 00-4.95-4.95l-1.2 1.2a3.5 3.5 0 004.95 4.95l1.2-1.2Zm-1.4 1.4L5.5 20.16a2 2 0 01-1.7-.56L2.4 18.2a2 2 0 010-2.83L12.77 5l2.83 2.83-10.37 10.37a2 2 0 000 2.83l1.4 1.4a2 2 0 002.83 0l10.37-10.37 2.12 2.12a2 2 0 01-2.83 2.83L15.9 11.16l-1.4-1.41Z'],
                ['label' => 'Maintenances', 'route' => 'driver.maintenances.index', 'icon' => 'M10.325 4.317a.75.75 0 011.042-1.042l.647.647a.75.75 0 01-.53 1.28l-1.159-.885Zm5.355 1.276a.75.75 0 011.042 1.042l-.647.647a.75.75 0 01-1.28-.53l.885-1.159ZM7.05 6.76a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25-1.25a.75.75 0 010-1.13Zm7.778 7.778a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25-1.25a.75.75 0 010-1.13ZM6.76 16.95a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0Zm7.778-7.778a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0ZM9.5 12a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0Z'],
                ['label' => 'Mes documents', 'route' => 'driver.documents.index', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V9.75c0-.621-.504-1.125-1.125-1.125H13.5a2.25 2.25 0 00-2.25 2.25v3.375'],
                ['label' => 'Notifications', 'route' => 'driver.notifications.index', 'icon' => 'M14.857 5.143a4 4 0 015.657 5.657l-1.06 1.06a12.083 12.083 0 01-2.914 4.725 1.25 1.25 0 01-1.768 0l-.707-.707a1.25 1.25 0 010-1.768 12.083 12.083 0 004.725-2.914l1.06-1.06a4 4 0 00-5.657-5.657l-.707.707a1.25 1.25 0 01-1.768 0l-.707-.707a1.25 1.25 0 010-1.768l.707-.707Zm-7.714 0a4 4 0 00-5.657 5.657l1.06 1.06a12.083 12.083 0 002.914 4.725 1.25 1.25 0 001.768 0l.707-.707a1.25 1.25 0 000-1.768 12.083 12.083 0 01-4.725-2.914l-1.06-1.06a4 4 0 015.657-5.657l.707.707a1.25 1.25 0 001.768 0l.707-.707a1.25 1.25 0 000-1.768l-.707-.707Z'],
                ['label' => 'Profil', 'route' => 'driver.profil.edit', 'icon' => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.501 20a15.003 15.003 0 0122.498 0A18.002 18.002 0 0112 21.75 18.002 18.002 0 014.501 20Z'],
            ];
        @endphp

        @foreach ($menuItems as $item)
            @php
                $isActive = request()->routeIs($item['route']) || ($item['route'] === 'driver.dashboard' && request()->routeIs('driver.dashboard'));
            @endphp
            <a href="{{ route($item['route']) }}" class="driver-menu-item group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold transition {{ $isActive ? 'bg-blue-600 text-white shadow-lg shadow-blue-950/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                </svg>
                <span class="driver-menu-text">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</div>
