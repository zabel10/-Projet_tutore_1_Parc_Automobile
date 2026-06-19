@extends('driver.layout')

@section('title', 'Tableau de bord - Espace Conducteur')

@section('content')
<div class="space-y-6">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div>
            <p class="text-sm font-black uppercase tracking-[0.08em] text-blue-600">Espace conducteur</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Tableau de bord</h1>
            <p class="mt-2 text-sm leading-6 text-slate-500">Vue d'ensemble de vos missions, affectations et véhicules.</p>
        </div>
    </section>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="driver-stat-card rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.4-5.4A2 2 0 014 14V5a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-.6 1.4L15 20" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Véhicule affecté</p>
                    <p class="text-lg font-black text-slate-950">{{ $stats['vehicule_affecte'] }}</p>
                    <p class="text-xs text-slate-500">{{ $stats['vehicule_details'] }}</p>
                </div>
            </div>
        </div>

        <div class="driver-stat-card rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.303 8.35a3.5 3.5 0 00-4.95-4.95l-1.2 1.2a3.5 3.5 0 004.95 4.95l1.2-1.2Zm-1.4 1.4L5.5 20.16a2 2 0 01-1.7-.56L2.4 18.2a2 2 0 010-2.83L12.77 5l2.83 2.83-10.37 10.37a2 2 0 000 2.83l1.4 1.4a2 2 0 002.83 0l10.37-10.37 2.12 2.12a2 2 0 01-2.83 2.83L15.9 11.16l-1.4-1.41Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Carburant</p>
                    <p class="text-lg font-black text-slate-950">{{ $stats['fuel_percent'] }}%</p>
                    <p class="text-xs text-slate-500">{{ $stats['fuel_subtitle'] }}</p>
                </div>
            </div>
        </div>

        <div class="driver-stat-card rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317a.75.75 0 011.042-1.042l.647.647a.75.75 0 01-.53 1.28l-1.159-.885Zm5.355 1.276a.75.75 0 011.042 1.042l-.647.647a.75.75 0 01-1.28-.53l.885-1.159ZM7.05 6.76a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25-1.25a.75.75 0 010-1.13Zm7.778 7.778a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25 1.25a.75.75 0 010-1.13ZM6.76 16.95a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0Zm7.778-7.778a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0ZM9.5 12a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Prochaine maintenance</p>
                    <p class="text-lg font-black text-slate-950">{{ $stats['maintenance_date'] }}</p>
                    <p class="text-xs text-slate-500">{{ $stats['maintenance_label'] }}</p>
                </div>
            </div>
        </div>

        <div class="driver-stat-card rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-6 4h6m-6 4h6M6.5 21h11A2.5 2.5 0 0020 18.5v-13A2.5 2.5 0 0120 5v13a2 2 0 01-2 2H6.5A2 2 0 014 18.5v-13A2 2 0 016.5 21Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Missions en cours</p>
                    <p class="text-lg font-black text-slate-950">{{ $stats['missions_en_cours'] }}</p>
                    <p class="text-xs text-slate-500">{{ $stats['missions_a_venir'] }} à venir</p>
                </div>
            </div>
        </div>
    </div>

    @if($currentMission)
    <section class="rounded-[1.5rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-4">
            <h2 class="text-lg font-black text-slate-950">Mission en cours</h2>
            <p class="text-sm text-slate-500">Votre mission active en temps réel</p>
        </div>
        <div class="grid gap-6 lg:grid-cols-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Destination</p>
                <p class="text-base font-semibold text-slate-900">{{ $currentMission->destination }}</p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Départ</p>
                <p class="text-base font-semibold text-slate-900">{{ $currentMission->date_depart?->locale('fr')->isoFormat('D MMMM YYYY') }}</p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Véhicule</p>
                <p class="text-base font-semibold text-slate-900">{{ $currentMission->vehicule?->immatriculation ?? '-' }}</p>
            </div>
        </div>
    </section>
    @endif

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="rounded-[1.5rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-black text-slate-950">Derniers bons de sortie</h2>
                    <p class="text-sm text-slate-500">Historique récent de vos sorties</p>
                </div>
                <a href="{{ route('driver.bons-sortie.index') }}" class="text-sm font-medium text-blue-600 hover:underline">Voir tout</a>
            </div>
            <div class="space-y-3">
                @forelse($recentBons as $bon)
                <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/50 p-4">
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $bon->vehicule?->immatriculation ?? 'Véhicule inconnu' }}</p>
                        <p class="text-xs text-slate-500">{{ $bon->mission?->destination ?? 'Sans destination' }}</p>
                    </div>
                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                        {{ $bon->statut === 'valide' ? 'Validé' : ucfirst($bon->statut) }}
                    </span>
                </div>
                @empty
                <p class="text-center text-sm text-slate-500 py-4">Aucun bon de sortie récent.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-[1.5rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-black text-slate-950">Dernières demandes</h2>
                    <p class="text-sm text-slate-500">Vos demandes récentes</p>
                </div>
                <a href="{{ route('driver.demandes.index') }}" class="text-sm font-medium text-blue-600 hover:underline">Voir tout</a>
            </div>
            <div class="space-y-3">
                @forelse($recentDemandes as $demande)
                <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/50 p-4">
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $demande->sujet }}</p>
                        <p class="text-xs text-slate-500">{{ ucfirst(str_replace('_', ' ', $demande->type_demande)) }}</p>
                    </div>
                    @if($demande->statut === 'approuvee')
                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Approuvée</span>
                    @elseif($demande->statut === 'refusee')
                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">Refusée</span>
                    @else
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700">En attente</span>
                    @endif
                </div>
                @empty
                <p class="text-center text-sm text-slate-500 py-4">Aucune demande récente.</p>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection