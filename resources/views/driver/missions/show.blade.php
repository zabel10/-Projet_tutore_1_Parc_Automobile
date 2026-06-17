@extends('driver.layout')

@section('title', $mission->destination . ' - Mes missions')

@section('content')
<div class="space-y-6">
    <a href="{{ route('driver.missions.index') }}" class="inline-flex text-sm font-bold text-blue-600 hover:text-blue-700">← Retour aux missions</a>

    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
        <section class="driver-card rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-black uppercase tracking-wide text-blue-700">{{ ucfirst(str_replace('_', ' ', $mission->statut)) }}</span>
                <span class="text-sm font-semibold text-slate-500">{{ $mission->destination }}</span>
            </div>
            <h1 class="mt-4 text-3xl font-black text-slate-950">{{ $mission->destination }}</h1>
            <p class="mt-2 text-slate-500">{{ $mission->motif }}</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-500">Date de départ</p>
                    <p class="mt-1 font-bold text-slate-950">{{ optional($mission->date_depart)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-500">Date de retour</p>
                    <p class="mt-1 font-bold text-slate-950">{{ optional($mission->date_retour)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-500">Véhicule</p>
                    <p class="mt-1 font-bold text-slate-950">{{ $mission->vehicule?->immatriculation ?? 'Non affecté' }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-500">Kilométrage départ</p>
                    <p class="mt-1 font-bold text-slate-950">{{ $mission->km_depart ?? 'Non renseigné' }} km</p>
                </div>
            </div>
        </section>

        <aside class="driver-card rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black text-slate-950">Bon de sortie</h2>
            @if ($mission->bonSortie)
                <p class="mt-2 text-sm text-slate-500">{{ $mission->bonSortie->numero }}</p>
                <p class="mt-4 rounded-2xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700">Bon associé disponible</p>
            @else
                <p class="mt-2 text-sm text-slate-500">Aucun bon de sortie associé à cette mission.</p>
            @endif
        </aside>
    </div>
</div>
@endsection
