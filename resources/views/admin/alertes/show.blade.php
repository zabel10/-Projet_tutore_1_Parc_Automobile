@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Détail alerte</h1><p class="text-slate-500 text-sm mt-1">{{ $alerte->type_alerte }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Véhicule</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $alerte->vehicule->immatriculation ?? '' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Type</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ str_replace('_', ' ', $alerte->type_alerte) }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Message</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $alerte->message }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Échéance</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($alerte->date_echeance)->format('d/m/Y') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Statut</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $alerte->statut }}</dd></div>
    </dl>
</div>
@endsection
