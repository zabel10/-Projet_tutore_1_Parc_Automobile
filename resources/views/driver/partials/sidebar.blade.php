<nav class="flex h-full flex-col">
    <div class="px-4 py-6 lg:px-6">
        <a href="{{ route('driver.dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.4-5.4A2 2 0 014 14V5a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-.6 1.4L15 20" />
                </svg>
            </div>
            <span class="text-xl font-black text-white">AutoPark</span>
        </a>
    </div>

    <div class="flex-1 px-3 py-2 lg:px-4">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('driver.dashboard') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.dashboard') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6" />
                    </svg>
                    Tableau de bord
                </a>
            </li>
            <li>
                <a href="{{ route('driver.missions.index') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.missions.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.4-5.4A2 2 0 014 14V5a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-.6 1.4L15 20" />
                    </svg>
                    Missions
                </a>
            </li>
            <li>
                <a href="{{ route('driver.affectations.index') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.affectations.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h6m-6 4h6m-6 4h6" />
                    </svg>
                    Affectations
                </a>
            </li>
            <li>
                <a href="{{ route('driver.bons-sortie.index') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.bons-sortie.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Bons de sortie
                </a>
            </li>
            <li>
                <a href="{{ route('driver.demandes.index') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.demandes.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-6 4h6m-6 4h6M6.5 21h11A2.5 2.5 0 0020 18.5v-13A2.5 2.5 0 0120 5v13a2 2 0 01-2 2H6.5A2 2 0 014 18.5v-13A2 2 0 016.5 21Z" />
                    </svg>
                    Demandes
                </a>
            </li>
            <li>
                <a href="{{ route('driver.carburants.index') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.carburants.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.303 8.35a3.5 3.5 0 00-4.95-4.95l-1.2 1.2a3.5 3.5 0 004.95 4.95l1.2-1.2Zm-1.4 1.4L5.5 20.16a2 2 0 01-1.7-.56L2.4 18.2a2 2 0 010-2.83L12.77 5l2.83 2.83-10.37 10.37a2 2 0 000 2.83l1.4 1.4a2 2 0 002.83 0l10.37-10.37 2.12 2.12a2 2 0 01-2.83 2.83L15.9 11.16l-1.4-1.41Z" />
                    </svg>
                    Carburant
                </a>
            </li>
            <li>
                <a href="{{ route('driver.maintenances.index') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.maintenances.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317a.75.75 0 011.042-1.042l.647.647a.75.75 0 01-.53 1.28l-1.159-.885Zm5.355 1.276a.75.75 0 011.042 1.042l-.647.647a.75.75 0 01-1.28-.53l.885-1.159ZM7.05 6.76a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25-1.25a.75.75 0 010-1.13Zm7.778 7.778a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25 1.25a.75.75 0 010-1.13ZM6.76 16.95a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0Zm7.778-7.778a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0ZM9.5 12a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0Z" />
                    </svg>
                    Maintenance
                </a>
            </li>
            <li>
                <a href="{{ route('driver.documents.index') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.documents.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m-6 4h6M6.5 21h11A2.5 2.5 0 0020 18.5v-13A2.5 2.5 0 0120 5v13a2 2 0 01-2 2H6.5A2 2 0 014 18.5v-13A2 2 0 016.5 21Z" />
                    </svg>
                    Documents
                </a>
            </li>
            <li>
                <a href="{{ route('driver.notifications.index') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.notifications.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.84 23.84 0 01-4.743 0M5.584 17.082a23.84 23.84 0 01-4.743 0M12 15a3 3 0 100-6 3 3 0 000 6Z" />
                    </svg>
                    Notifications
                </a>
            </li>
        </ul>
    </div>

    <div class="border-t border-slate-800 p-4">
        <a href="{{ route('driver.profil.edit') }}"
           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('driver.profil.*') ? 'bg-blue-600/20 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Mon profil
        </a>
    </div>
</nav>