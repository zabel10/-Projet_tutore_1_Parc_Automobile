@extends('driver.layout')

@section('title', 'Mon véhicule')

@section('content')
<div class="mx-auto max-w-5xl space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-50 text-primary-600">
                    <i class="bi bi-car-front text-lg"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900">Mon véhicule</h1>
            </div>
            <p class="mt-1 text-sm text-slate-500">Informations détaillées sur votre véhicule affecté</p>
        </div>
    </div>

    @if($vehicule)
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="text-center">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-primary-600 text-white shadow-sm">
                        <i class="bi bi-car-front-fill text-3xl"></i>
                    </div>
                    <h2 class="mt-4 text-xl font-extrabold text-slate-900">{{ $vehicule->immatriculation }}</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ $vehicule->marque }} {{ $vehicule->modele }}</p>
                    <span class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                        {{ $vehicule->statut ?? 'Actif' }}
                    </span>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-extrabold text-slate-900">Informations générales</h2>
                    <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Type</p>
                            <p class="mt-1 text-base font-extrabold text-slate-900">{{ $vehicule->type ?? '—' }}</p>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Année</p>
                            <p class="mt-1 text-base font-extrabold text-slate-900">{{ $vehicule->annee ?? '—' }}</p>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kilométrage</p>
                            <p class="mt-1 text-base font-extrabold text-slate-900">{{ number_format($vehicule->kilometrage ?? 0, 0, ',', ' ') }} km</p>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Carburant</p>
                            <p class="mt-1 text-base font-extrabold text-slate-900">{{ $vehicule->carburant ?? 'Diesel' }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-extrabold text-slate-900">Niveau de carburant</h2>
                        <span class="text-sm font-bold text-slate-700">{{ $fuelPercent }}%</span>
                    </div>
                    <div class="mt-4">
                        <div class="h-4 w-full overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full transition-all duration-500 {{ $fuelPercent > 50 ? 'bg-emerald-500' : ($fuelPercent > 25 ? 'bg-amber-500' : 'bg-red-500') }}"
                                 style="width: {{ $fuelPercent }}%"></div>
                        </div>
                        <div class="mt-2 flex items-center justify-between text-xs font-semibold text-slate-400">
                            <span>Vide</span>
                            <span>Plein</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white py-16 text-center shadow-sm">
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 mb-4">
                <i class="bi bi-car-front text-2xl"></i>
            </div>
            <h3 class="text-lg font-extrabold text-slate-900">Aucun véhicule affecté</h3>
            <p class="mt-2 text-sm text-slate-500 max-w-sm">Vous n'avez pas de véhicule attribué actuellement. Contactez votre administrateur pour plus d'informations.</p>
        </div>
    @endif
</div>
@endsection
