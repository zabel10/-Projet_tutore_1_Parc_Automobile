@extends('driver.layout')

@section('title', 'Détail mission')

@section('content')
<div class="mx-auto max-w-6xl space-y-6">
    <a href="{{ route('driver.missions.index') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-200 transition mb-6">
        <i class="bi bi-arrow-left"></i> Retour
    </a>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-wrap items-center gap-3">
            <p class="text-xs font-bold uppercase tracking-wider text-blue-600">Mission</p>
            <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Mission #{{ $mission->id_mission ?? $mission->id }}</h1>
            <p class="text-sm text-slate-500 mt-1">Détails de votre mission</p>
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
</div>

    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
        <section class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-4">Informations détaillées</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Destination</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ $mission->destination ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Date de départ</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ optional($mission->date_depart)->locale('fr')->isoFormat('D MMM YYYY à HH:mm') ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Date de retour</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ optional($mission->date_retour)->locale('fr')->isoFormat('D MMM YYYY') ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Véhicule</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ $mission->vehicule->immatriculation ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Distance prévue</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ $mission->distance_km ?? '—' }} km</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Statut</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ match($mission->statut ?? '') { 'planifiee' => 'Planifiée', 'en_cours' => 'En cours', 'terminee' => 'Terminée', 'annulee' => 'Annulée', default => ucfirst($mission->statut ?? '—') } }}</p>
                </div>
            </div>
        </section>

        <aside class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-4">Résumé</h2>
            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Statut</dt>
                    <dd class="text-sm font-bold text-slate-900 mt-1">{{ match($mission->statut ?? '') { 'planifiee' => 'Planifiée', 'en_cours' => 'En cours', 'terminee' => 'Terminée', 'annulee' => 'Annulée', default => ucfirst($mission->statut ?? '—') } }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Destination</dt>
                    <dd class="text-sm font-bold text-slate-900 mt-1">{{ $mission->destination ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Véhicule</dt>
                    <dd class="text-sm font-bold text-slate-900 mt-1">{{ $mission->vehicule->immatriculation ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Distance</dt>
                    <dd class="text-sm font-bold text-slate-900 mt-1">{{ $mission->distance_km ?? '—' }} km</dd>
                </div>
            </dl>
        </aside>
    </div>

    <div class="flex flex-col gap-3 sm:flex-row">
        @if(($mission->statut ?? '') === 'planifiee')
            <button class="rounded-xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700">Accepter la mission</button>
            <button class="rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">Refuser</button>
        @elseif(($mission->statut ?? '') === 'en_cours')
            <button class="rounded-xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700">Marquer comme terminée</button>
        @endif
        <a href="{{ route('driver.missions.index') }}" class="rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">Retour à la liste</a>
    </div>
</div>
@endsection
