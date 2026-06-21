@extends('driver.layout')

@section('title', 'Notifications - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs font-bold uppercase tracking-wider text-violet-600">Espace conducteur</p>
        <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Notifications</h1>
        <p class="text-sm text-slate-500 mt-1">Consultez les alertes, validations et rappels liés à votre activité.</p>
    </div>

    <div class="space-y-3">
        @forelse ($notifications as $notification)
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md @if (! $notification->lu) border-l-4 border-l-primary-500 @endif">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $notification->type_notification === 'alerte' ? 'bg-red-100 text-red-600 ring-1 ring-red-200' : 'bg-blue-100 text-blue-600 ring-1 ring-blue-200' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 5.143a4 4 0 015.657 5.657l-1.06 1.06a12.083 12.083 0 01-2.914 4.725 1.25 1.25 0 01-1.768 0l-.707-.707a12.083 12.083 0 004.725-2.914l1.06-1.06a4 4 0 00-5.657-5.657l-.707-.707a1.25 1.25 0 01-1.768 0l-.707-.707a1.25 1.25 0 010-1.768l.707-.707Zm-7.714 0a4 4 0 00-5.657 5.657l1.06 1.06a12.083 12.083 0 002.914 4.725 1.25 1.25 0 001.768 0l.707-.707a12.083 12.083 0 01-4.725-2.914l-1.06-1.06a4 4 0 015.657-5.657l1.06 1.06a12.083 12.083 0 002.914 4.725 1.25 1.25 0 01-1.768 0l-.707.707a12.083 12.083 0 00-4.725 2.914l1.06 1.06a4 4 0 01-5.657 5.657Z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <h2 class="text-sm font-bold text-slate-900">{{ $notification->titre }}</h2>
                                @if (! $notification->lu)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700 ring-1 ring-red-200">Nouveau</span>
                                @endif
                            </div>
                            <p class="text-sm text-slate-500 mt-1">{{ $notification->message }}</p>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mt-2">{{ optional($notification->date_notification)->locale('fr')->isoFormat('D MMM YYYY à HH:mm') }}</p>
                        </div>
                    </div>

                    @if (! $notification->lu)
                        <form action="{{ route('driver.notifications.read', $notification) }}" method="POST" class="shrink-0">
                            @csrf
                            <button type="submit" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">Marquer comme lue</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18h-7.5A2.25 2.25 0 014.5 19.5V9.75m18 0A2.25 2.25 0 0020.25 7.5H8.25A2.25 2.25 0 006 9.75v9.75A2.25 2.25 0 008.25 21.75h7.5A2.25 2.25 0 0018 19.5v-9.75" />
                    </svg>
                </div>
                <h2 class="text-sm font-bold text-slate-700 mt-3">Aucune notification.</h2>
                <p class="text-xs text-slate-500 mt-1">Votre boîte de notification est vide pour le moment.</p>
            </div>
        @endforelse
    </div>

    @if ($notifications->hasPages())
        <div class="flex justify-center">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection
