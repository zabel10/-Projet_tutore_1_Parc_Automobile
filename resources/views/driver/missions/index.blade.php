@extends('driver.layout')

@section('title', 'Mes missions')

@section('content')
@php
    $missions = $missions ?? collect();
@endphp

<div class="mx-auto max-w-7xl space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-blue-600">Espace conducteur</p>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Mes missions</h1>
                <p class="text-sm text-slate-500 mt-1">Consultez et gérez vos missions</p>
            </div>
            <div class="flex gap-2 overflow-x-auto pb-2" x-data="{ filter: 'toutes' }">
                <button @click="filter = 'toutes'"
                        :class="filter === 'toutes' ? 'rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition' : 'rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50'">
                    Toutes
                </button>
                <button @click="filter = 'en_cours'"
                        :class="filter === 'en_cours' ? 'rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition' : 'rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50'">
                    En cours
                </button>
                <button @click="filter = 'a_venir'"
                        :class="filter === 'a_venir' ? 'rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition' : 'rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50'">
                    À venir
                </button>
                <button @click="filter = 'terminees'"
                        :class="filter === 'terminees' ? 'rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition' : 'rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50'">
                    Terminées
                </button>
            </div>
        </div>
    </div>

    <div class="space-y-4" x-data="{ filter: window.__missionFilter ?? 'toutes' }">
        @forelse ($missions as $mission)
            @php
                $status = $mission->statut ?? '';
                $showAll = "filter === 'toutes'";
                $showEnCours = "filter === 'en_cours' && '{$status}' === 'en_cours'";
                $showAVenir = "filter === 'a_venir' && '{$status}' === 'planifiee'";
                $showTerminees = "filter === 'terminees' && '{$status}' === 'terminee'";
                $xShow = $showAll . ' || ' . $showEnCours . ' || ' . $showAVenir . ' || ' . $showTerminees;
            @endphp
            <div x-show="{{ $xShow }}"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-700 ring-1 ring-slate-200">Mission #{{ $mission->id_mission ?? $mission->id }}</span>
                            <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-bold ring-1
                                @if(($mission->statut ?? '') === 'planifiee') bg-purple-100 text-purple-700 ring-purple-200
                                @elseif(($mission->statut ?? '') === 'en_cours') bg-blue-100 text-blue-700 ring-blue-200
                                @elseif(($mission->statut ?? '') === 'terminee') bg-emerald-100 text-emerald-700 ring-emerald-200
                                @else bg-slate-100 text-slate-700 ring-slate-200 @endif">
                                @if(($mission->statut ?? '') === 'planifiee') Planifiée
                                @elseif(($mission->statut ?? '') === 'en_cours') En cours
                                @elseif(($mission->statut ?? '') === 'terminee') Terminée
                                @elseif(($mission->statut ?? '') === 'annulee') Annulée
                                @else {{ ucfirst($mission->statut ?? '—') }} @endif
                            </span>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900 mt-3">{{ $mission->destination ?? '—' }}</h2>
                        <div class="mt-3 flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-500">
                            <span><i class="bi bi-calendar3 me-1"></i>{{ optional($mission->date_depart)->locale('fr')->isoFormat('D MMM YYYY') ?? '—' }}</span>
                            <span><i class="bi bi-car-front me-1"></i>{{ $mission->vehicule->immatriculation ?? '—' }} - {{ $mission->vehicule->marque ?? '' }} {{ $mission->vehicule->modele ?? '' }}</span>
                            <span><i class="bi bi-signpost-2 me-1"></i>~{{ $mission->distance_km ?? '—' }} km</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 lg:flex-col">
                        <a href="{{ route('driver.missions.show', $mission->id_mission ?? $mission->id) }}" class="rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700">Détails</a>
                        @if(($mission->statut ?? '') === 'planifiee')
                            <button class="rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700">Accepter</button>
                            <button class="rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-bold text-red-600 shadow-sm transition hover:bg-red-50">Refuser</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-slate-200 bg-white p-12 text-center shadow-sm">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 ring-1 ring-slate-100">
                    <i class="bi bi-inbox text-2xl"></i>
                </div>
                <h2 class="text-sm font-bold text-slate-700 mt-3">Aucune mission</h2>
                <p class="text-xs text-slate-500 mt-1">Aucune mission n'est actuellement disponible.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
