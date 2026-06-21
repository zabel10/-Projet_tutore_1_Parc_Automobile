@extends('driver.layout')

@section('title', 'Historique')

@section('content')
<div class="mx-auto max-w-5xl space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                    <i class="bi bi-clock-history text-lg"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900">Historique des missions</h1>
            </div>
            <p class="mt-1 text-sm text-slate-500">Retrouvez toutes vos missions passées</p>
        </div>
    </div>

    @if($missions->count() > 0)
        <div class="space-y-4">
            @foreach($missions as $mission)
                @php
                    if (($mission->statut ?? '') === 'terminee') {
                        $statusRing = 'ring-emerald-200';
                        $statusBg = 'bg-emerald-100 text-emerald-700';
                    } elseif (($mission->statut ?? '') === 'annulee') {
                        $statusRing = 'ring-red-200';
                        $statusBg = 'bg-red-100 text-red-700';
                    } else {
                        $statusRing = 'ring-slate-200';
                        $statusBg = 'bg-slate-100 text-slate-600';
                    }
                @endphp
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-primary-200 hover:shadow-md hover:-translate-y-0.5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-primary-50">
                                <i class="bi bi-geo-alt text-primary-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">{{ $mission->destination }}</h3>
                                <p class="mt-1 text-sm text-slate-500">
                                    <i class="bi bi-calendar3 mr-1 text-slate-400"></i>
                                    Du {{ $mission->date_depart?->format('d/m/Y') ?? '-' }} au {{ $mission->date_arrivee?->format('d/m/Y') ?? '-' }}
                                </p>
                                @if($mission->vehicule)
                                    <p class="mt-2 text-sm text-slate-600">
                                        <i class="bi bi-car-front mr-1 text-slate-400"></i>
                                        {{ $mission->vehicule->immatriculation }} — {{ $mission->vehicule->marque }} {{ $mission->vehicule->modele }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $statusBg }} {{ $statusRing }}">
                            <span class="h-1.5 w-1.5 rounded-full bg-current opacity-60"></span>
                            {{ ucfirst($mission->statut) }}
                        </span>
                    </div>
                    @if($mission->description)
                        <p class="mt-4 border-t border-slate-100 pt-4 text-sm text-slate-600 leading-relaxed">{{ Str::limit($mission->description, 150) }}</p>
                    @endif
                </div>
            @endforeach
        </div>

        @if($missions->hasPages())
            <div class="mt-6">
                {{ $missions->links() }}
            </div>
        @endif
    @else
        <div class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white py-16 text-center shadow-sm">
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 mb-4">
                <i class="bi bi-clock-history text-2xl"></i>
            </div>
            <h3 class="text-lg font-extrabold text-slate-900">Aucune mission dans l'historique</h3>
            <p class="mt-2 text-sm text-slate-500 max-w-sm">Vous n'avez pas encore de missions terminées ou annulées. Elles apparaîtront ici une fois complétées.</p>
        </div>
    @endif
</div>
@endsection
