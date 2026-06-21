@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Détail mission</h1><p class="text-slate-500 text-sm mt-1">Réf. #{{ $mission->id_mission }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Véhicule</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $mission->vehicule->immatriculation ?? '' }} — {{ $mission->vehicule->marque ?? '' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Conducteur</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $mission->conducteur->utilisateur->prenom ?? '' }} {{ $mission->conducteur->utilisateur->nom ?? '' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Destination</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $mission->destination }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Motif</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $mission->motif }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Date départ</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($mission->date_depart)->format('d/m/Y') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Date retour</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $mission->date_retour ? \Carbon\Carbon::parse($mission->date_retour)->format('d/m/Y') : '—' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Km départ</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($mission->km_depart, 0, ',', ' ') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Km retour</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $mission->km_retour ? number_format($mission->km_retour, 0, ',', ' ') : '—' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Statut</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ str_replace('_', ' ', $mission->statut) }}</dd></div>
    </dl>
</div>
@endsection
