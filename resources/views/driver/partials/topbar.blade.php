<header class="flex items-center justify-between border-b border-slate-200/80 bg-white px-4 py-4 sm:px-6 lg:hidden">
    <button type="button" @click="sidebarOpen = true" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition hover:bg-slate-200">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="flex items-center gap-3">
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-950/30">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8m-8 4h8m-6 4h4M5.6 7.5l.9-1.4A2 2 0 0 1 8.2 5h7.6a2 2 0 0 1 1.7 1.1l.9 1.4M5 11h14l-.9 6.2A2 2 0 0 1 16.1 19H7.9a2 2 0 0 1-2-1.8L5 11Z" />
            </svg>
        </div>
        <h2 class="text-lg font-black text-slate-950">Parc Automobile</h2>
    </div>

    <div class="flex items-center gap-2">
        <button type="button" @click="notificationsOpen = !notificationsOpen" class="relative flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition hover:bg-slate-200">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 5.143a4 4 0 015.657 5.657l-1.06 1.06a12.083 12.083 0 01-2.914 4.725 1.25 1.25 0 01-1.768 0l-.707-.707a12.083 12.083 0 004.725-2.914l1.06-1.06a4 4 0 00-5.657-5.657l-.707.707a1.25 1.25 0 01-1.768 0l-.707-.707a1.25 1.25 0 010-1.768l.707-.707Zm-7.714 0a4 4 0 00-5.657 5.657l1.06 1.06a12.083 12.083 0 002.914 4.725 1.25 1.25 0 001.768 0l.707-.707a12.083 12.083 0 01-4.725-2.914l-1.06-1.06a4 4 0 015.657-5.657l1.06 1.06a12.083 12.083 0 012.914 4.725 1.25 1.25 0 01-1.768 0l-.707.707a12.083 12.083 0 00-4.725 2.914l1.06 1.06a4 4 0 01-5.657 5.657Z" />
            </svg>
            @if(($unreadNotifications ?? 0) > 0)
                <span class="absolute -top-1 -right-1 flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white">{{ ($unreadNotifications ?? 0) > 9 ? '9+' : ($unreadNotifications ?? 0) }}</span>
            @endif
        </button>

        <button type="button" @click="profileOpen = !profileOpen" class="flex h-10 min-w-[2.5rem] items-center gap-2 rounded-xl bg-slate-100 px-2 text-slate-600 transition hover:bg-slate-200">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->prenom ?? 'Conducteur') }}&background=3B82F6&color=fff" alt="Avatar" class="h-6 w-6 rounded-full object-cover">
        </button>
    </div>
</header>

<div x-show="notificationsOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-start justify-end" @click="notificationsOpen = false">
    <div class="mr-4 mt-16 w-80 rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60" @click.stop>
        <div class="border-b border-slate-100 px-4 py-3">
            <h3 class="font-bold text-slate-950">Notifications</h3>
        </div>
        <div class="max-h-96 overflow-y-auto py-2">
            @forelse ($notificationsList ?? [] as $notification)
                <div class="flex items-start gap-3 px-4 py-3 transition hover:bg-slate-50">
                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl {{ $notification['tone'] ?? 'bg-slate-100 text-slate-600' }}">
                        {!! $notification['icon'] ?? '' !!}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-slate-950">{{ $notification['title'] ?? '' }}</p>
                        <p class="mt-1 text-xs text-slate-600">{{ $notification['description'] ?? '' }}</p>
                        <p class="mt-1.5 text-xs text-slate-500">{{ $notification['date'] ?? '' }}</p>
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center">
                    <p class="text-sm text-slate-600">Aucune notification</p>
                </div>
            @endforelse
        </div>
        <div class="border-t border-slate-100 px-4 py-3">
            <a href="{{ route('driver.notifications.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">Voir toutes les notifications</a>
        </div>
    </div>
</div>

<div x-show="profileOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-start justify-end" @click="profileOpen = false">
    <div class="mr-4 mt-16 w-64 rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60" @click.stop>
        <div class="border-b border-slate-100 px-4 py-3">
            <p class="text-xs font-semibold uppercase text-slate-500">Connecté en tant que</p>
            <p class="mt-1 font-bold text-slate-950">{{ auth()->user()->prenom ?? 'Conducteur' }}</p>
        </div>
        <div class="py-2">
            <a href="{{ route('driver.profil.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.501 20a15.003 15.003 0 0122.498 0A18.002 18.002 0 0112 21.75 18.002 18.002 0 014.501 20Z" />
                </svg>
                Mon profil
            </a>
            <form action="{{ route('logout') }}" method="POST" class="px-2 py-2">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm font-semibold text-red-600 transition hover:bg-red-50">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25a2.25 2.25 0 00-2.25-2.25h-3a2.25 2.25 0 00-2.25 2.25v13.5a2.25 2.25 0 002.25 2.25h3a2.25 2.25 0 002.25-2.25V15M12 9l3 3-3 3m6-3H9" />
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</div>