@extends('driver.layout')

@section('title', 'Affectation - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <a href="{{ route('driver.affectations.index') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-200 transition mb-6">
        <i class="bi bi-arrow-left"></i> Retour aux affectations
    </a>

    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
        <section class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-bold text-blue-700 ring-1 ring-blue-200">{{ ucfirst(str_replace('_', ' ', $affectation->statut)) }}</span>
                <span class="text-sm font-semibold text-slate-500">{{ optional($affectation->date_debut)->locale('fr')->isoFormat('D MMM YYYY') }}</span>
            </div>

            <h1 class="text-2xl font-extrabold text-slate-900 mt-4">{{ $affectation->vehicule?->immatriculation ?? 'Véhicule non affecté' }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $affectation->vehicule ? $affectation->vehicule->marque . ' ' . $affectation->vehicule->modele : 'Aucun véhicule associé' }}</p>

            <div class="mt-8 grid grid-cols-2 gap-4">
                <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Date de début</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ optional($affectation->date_debut)->locale('fr')->isoFormat('D MMMM YYYY') }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Date de fin prévue</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ optional($affectation->date_fin_prevue)->locale('fr')->isoFormat('D MMMM YYYY') ?? 'Non définie' }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Mission associée</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ $affectation->mission?->destination ?? 'Aucune mission' }}</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Conducteur</p>
                    <p class="text-sm font-bold text-slate-900 mt-1">{{ $affectation->conducteur?->utilisateur?->prenom ?? '' }} {{ $affectation->conducteur?->utilisateur?->nom ?? '' }}</p>
                </div>
            </div>

            @if ($affectation->observations)
                <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-slate-500">Observations</h2>
                    <p class="text-sm text-slate-600 mt-1">{{ $affectation->observations }}</p>
                </div>
            @endif
        </section>

        <aside class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-4">Résumé</h2>
            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Statut</dt>
                    <dd class="text-sm font-bold text-slate-900 mt-1">{{ ucfirst(str_replace('_', ' ', $affectation->statut)) }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Immatriculation</dt>
                    <dd class="text-sm font-bold text-slate-900 mt-1">{{ $affectation->vehicule?->immatriculation ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Marque</dt>
                    <dd class="text-sm font-bold text-slate-900 mt-1">{{ $affectation->vehicule?->marque ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Modèle</dt>
                    <dd class="text-sm font-bold text-slate-900 mt-1">{{ $affectation->vehicule?->modele ?? '-' }}</dd>
                </div>
            </dl>
        </aside>
    </div>
</div>
@endsection
