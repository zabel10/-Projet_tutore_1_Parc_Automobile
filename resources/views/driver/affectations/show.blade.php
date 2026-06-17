@extends('driver.layout')

@section('title', 'Affectation - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <a href="{{ route('driver.affectations.index') }}" class="inline-flex text-sm font-bold text-blue-600 hover:text-blue-700">← Retour aux affectations</a>

    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
        <section class="driver-card rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-black uppercase tracking-wide text-blue-700">{{ ucfirst(str_replace('_', ' ', $affectation->statut)) }}</span>
                <span class="text-sm font-semibold text-slate-500">{{ optional($affectation->date_debut)->locale('fr')->isoFormat('D MMM YYYY') }}</span>
            </div>

            <h1 class="mt-4 text-3xl font-black text-slate-950">{{ $affectation->vehicule?->immatriculation ?? 'Véhicule non affecté' }}</h1>
            <p class="mt-2 text-slate-500">{{ $affectation->vehicule ? $affectation->vehicule->marque . ' ' . $affectation->vehicule->modele : 'Aucun véhicule associé' }}</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-500">Date de début</p>
                    <p class="mt-1 font-bold text-slate-950">{{ optional($affectation->date_debut)->locale('fr')->isoFormat('D MMMM YYYY') }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-500">Date de fin prévue</p>
                    <p class="mt-1 font-bold text-slate-950">{{ optional($affectation->date_fin_prevue)->locale('fr')->isoFormat('D MMMM YYYY') ?? 'Non définie' }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-500">Mission associée</p>
                    <p class="mt-1 font-bold text-slate-950">{{ $affectation->mission?->destination ?? 'Aucune mission' }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-500">Conducteur</p>
                    <p class="mt-1 font-bold text-slate-950">{{ $affectation->conducteur?->utilisateur?->prenom ?? '' }} {{ $affectation->conducteur?->utilisateur?->nom ?? '' }}</p>
                </div>
            </div>

            @if ($affectation->observations)
                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h2 class="font-black text-slate-950">Observations</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $affectation->observations }}</p>
                </div>
            @endif
        </section>

        <aside class="driver-card rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black text-slate-950">Résumé</h2>
            <dl class="mt-5 space-y-4 text-sm">
                <div class="flex justify-between gap-4">
                    <dt class="font-semibold text-slate-500">Statut</dt>
                    <dd class="font-bold text-slate-950">{{ ucfirst(str_replace('_', ' ', $affectation->statut)) }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="font-semibold text-slate-500">Immatriculation</dt>
                    <dd class="font-bold text-slate-950">{{ $affectation->vehicule?->immatriculation ?? '-' }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="font-semibold text-slate-500">Marque</dt>
                    <dd class="font-bold text-slate-950">{{ $affectation->vehicule?->marque ?? '-' }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="font-semibold text-slate-500">Modèle</dt>
                    <dd class="font-bold text-slate-950">{{ $affectation->vehicule?->modele ?? '-' }}</dd>
                </div>
            </dl>
        </aside>
    </div>
</div>
@endsection
