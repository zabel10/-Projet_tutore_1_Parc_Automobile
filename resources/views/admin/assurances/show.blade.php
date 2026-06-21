@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Détail assurance</h1><p class="text-slate-500 text-sm mt-1">{{ $assurance->compagnie }} — {{ $assurance->numero_contrat }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Véhicule</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $assurance->vehicule->immatriculation ?? '' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Compagnie</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $assurance->compagnie }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">N° contrat</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $assurance->numero_contrat }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Coût</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($assurance->cout, 0, ',', ' ') }} FCFA</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Date début</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($assurance->date_debut)->format('d/m/Y') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Date fin</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($assurance->date_fin)->format('d/m/Y') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Type</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ str_replace('_', ' ', $assurance->type_assurance) }}</dd></div>
    </dl>
</div>
@endsection
