<header class="sticky top-0 z-30 flex items-center justify-between border-b border-slate-200 bg-white px-4 py-3 sm:px-6 lg:px-8">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 lg:hidden">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <h1 class="text-xl font-bold text-slate-900">@yield('title', 'Tableau de bord')</h1>
    </div>

    <div class="flex items-center gap-3">
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open; notificationsOpen = open" @click.away="open = false"
                    class="relative rounded-full p-2 text-slate-600 hover:bg-slate-100">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.84 23.84 0 01-4.743 0M5.584 17.082a23.84 23.84 0 01-4.743 0M12 15a3 3 0 100-6 3 3 0 000 6Z" />
                </svg>
                @if(isset($unreadNotifications) && $unreadNotifications > 0)
                    <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">
                        {{ $unreadNotifications }}
                    </span>
                @endif
            </button>

            <div x-show="notificationsOpen" x-transition
                 class="absolute right-0 mt-2 w-80 origin-top-right rounded-xl border border-slate-200 bg-white shadow-lg"
                 x-cloak>
                <div class="p-4">
                    <h3 class="text-sm font-bold text-slate-900">Notifications</h3>
                    <p class="text-xs text-slate-500">Vos dernières notifications</p>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    @if(isset($notificationsList) && count($notificationsList) > 0)
                        @foreach($notificationsList as $notification)
                            <div class="flex gap-3 border-t border-slate-100 p-4">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg {{ $notification['tone'] }}">
                                    {!! $notification['icon'] !!}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">{{ $notification['title'] }}</p>
                                    <p class="text-xs text-slate-500">{{ $notification['description'] }}</p>
                                    <p class="mt-1 text-xs text-slate-400">{{ $notification['date'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-6 text-center">
                            <p class="text-sm text-slate-500">Aucune notification</p>
                        </div>
                    @endif
                </div>
                <div class="border-t border-slate-100 p-3">
                    <a href="{{ route('driver.notifications.index') }}"
                       class="block text-center text-xs font-medium text-blue-600 hover:underline">
                        Voir toutes les notifications
                    </a>
                </div>
            </div>
        </div>

        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open; profileOpen = open" @click.away="open = false"
                    class="flex items-center gap-2 rounded-full p-1 text-slate-600 hover:bg-slate-100">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                    {{ auth()->user()->prenom?->charAt(0) ?? 'U' }}
                </div>
                <span class="hidden text-sm font-medium sm:inline">{{ auth()->user()->prenom ?? auth()->user()->name }}</span>
                <svg class="h-4 w-4 hidden sm:inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="profileOpen" x-transition
                 class="absolute right-0 mt-2 w-56 origin-top-right rounded-xl border border-slate-200 bg-white shadow-lg"
                 x-cloak>
                <div class="p-3 border-b border-slate-100">
                    <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->prenom ?? auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                </div>
                <div class="p-2">
                    <a href="{{ route('driver.profil.edit') }}"
                       class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Mon profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>