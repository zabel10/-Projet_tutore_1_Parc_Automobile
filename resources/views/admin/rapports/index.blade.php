@extends('admin.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-black text-slate-900">Rapports</h1>
    <p class="text-slate-500 text-sm mt-1">Analyses et statistiques</p>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
        <div class="flex items-center gap-3 mb-3"><div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-100 text-primary-600"><i class="bi bi-graph-up text-lg"></i></div><h3 class="font-bold text-slate-900">Missions</h3></div>
        <p class="text-slate-500 text-sm">Statistiques détaillées des missions par période.</p>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
        <div class="flex items-center gap-3 mb-3"><div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600"><i class="bi bi-fuel-pump text-lg"></i></div><h3 class="font-bold text-slate-900">Carburants</h3></div>
        <p class="text-slate-500 text-sm">Consommation et coûts par véhicule.</p>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
        <div class="flex items-center gap-3 mb-3"><div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="bi bi-tools text-lg"></i></div><h3 class="font-bold text-slate-900">Maintenances</h3></div>
        <p class="text-slate-500 text-sm">Coûts de maintenance et planification.</p>
    </div>
</div>
@endsection
