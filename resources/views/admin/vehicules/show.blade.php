@extends('admin.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-black text-slate-900">{{ $vehicule->immatriculation }}</h1>
    <p class="text-slate-500 text-sm mt-1">{{ $vehicule->marque }} {{ $vehicule->modele }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            @if($vehicule->photo_path)
                <img src="{{ asset('storage/' . $vehicule->photo_path) }}" alt="{{ $vehicule->marque }} {{ $vehicule->modele }}" class="h-64 w-full object-cover">
            @else
                <div class="h-64 w-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                    <i class="bi bi-car-front text-slate-300 text-6xl"></i>
                </div>
            @endif
            <div class="p-4 border-t border-slate-100">
                <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-bold
                    {{ $vehicule->statut === 'disponible' ? 'bg-emerald-100 text-emerald-700' : '' }}
                    {{ $vehicule->statut === 'en_mission' ? 'bg-blue-100 text-blue-700' : '' }}
                    {{ $vehicule->statut === 'en_maintenance' ? 'bg-amber-100 text-amber-700' : '' }}
                    {{ $vehicule->statut === 'hors_service' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ str_replace('_', ' ', $vehicule->statut) }}
                </span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Immatriculation</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $vehicule->immatriculation }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Marque</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $vehicule->marque }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Modèle</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $vehicule->modele }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Année</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $vehicule->annee }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Carburant</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ ucfirst($vehicule->carburant) }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Kilométrage</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Couleur</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $vehicule->couleur ?? '—' }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Date acquisition</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $vehicule->date_acquisition->format('d/m/Y') }}</dd></div>
            </dl>
        </div>
    </div>
</div>
@endsection
