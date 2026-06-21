@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Détail maintenance</h1><p class="text-slate-500 text-sm mt-1">{{ $maintenance->vehicule->immatriculation ?? '' }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Véhicule</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $maintenance->vehicule->immatriculation ?? '' }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Type</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $maintenance->type_maintenance }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Date</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($maintenance->date_maintenance)->format('d/m/Y') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Coût</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($maintenance->cout, 0, ',', ' ') }} FCFA</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Prestataire</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $maintenance->prestataire }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Km au moment</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($maintenance->km_au_moment, 0, ',', ' ') }}</dd></div>
        <div><dt class="text-xs font-bold text-slate-500 uppercase">Prochaine échéance</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $maintenance->prochaine_echeance ? \Carbon\Carbon::parse($maintenance->prochaine_echeance)->format('d/m/Y') : '—' }}</dd></div>
        <div class="sm:col-span-2"><dt class="text-xs font-bold text-slate-500 uppercase">Description</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $maintenance->description }}</dd></div>
    </dl>
</div>
@endsection
