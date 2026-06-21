@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Détail ravitaillement</h1><p class="text-slate-500 text-sm mt-1">{{ $carburant->vehicule->immatriculation ?? '' }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Véhicule</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $carburant->vehicule->immatriculation ?? '' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Conducteur</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $carburant->conducteur->utilisateur->prenom ?? '' }} {{ $carburant->conducteur->utilisateur->nom ?? '' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Date</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($carburant->date_plein)->format('d/m/Y') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Quantité</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($carburant->quantite_litres, 2) }} L</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Coût total</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($carburant->cout_total, 0, ',', ' ') }} FCFA</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Prix / litre</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($carburant->prix_litre, 0, ',', ' ') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Kilométrage</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($carburant->kilometrage, 0, ',', ' ') }}</dd></div>
    </dl>
</div>
@endsection
