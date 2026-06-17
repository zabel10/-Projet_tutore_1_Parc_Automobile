@extends('driver.layout')

@section('title', 'Mes missions - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div>
            <p class="text-sm font-black uppercase tracking-[0.08em] text-blue-600">Espace conducteur</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Mes missions</h1>
            <p class="mt-2 text-sm leading-6 text-slate-500">Retrouvez vos missions planifiées, en cours et terminées.</p>
        </div>
    </section>

    <section class="driver-table-card overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-200/60">
        <div class="overflow-x-auto">
            <table class="driver-table min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-gradient-to-r from-slate-50 to-blue-50/60 text-left text-xs font-black uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3.5">Destination</th>
                        <th class="px-4 py-3.5">Départ</th>
                        <th class="px-4 py-3.5">Retour</th>
                        <th class="px-4 py-3.5">Véhicule</th>
                        <th class="px-4 py-3.5">Statut</th>
                        <th class="px-4 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($missions as $mission)
                        <tr class="transition hover:bg-blue-50/40">
                            <td class="px-4 py-3.5 font-black text-slate-950">{{ $mission->destination }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($mission->date_depart)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($mission->date_retour)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ $mission->vehicule?->immatriculation ?? 'Non affecté' }}</td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-xs font-black text-blue-700 ring-1 ring-blue-200">{{ ucfirst(str_replace('_', ' ', $mission->statut)) }}</span>
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                <a href="{{ route('driver.missions.show', $mission) }}" class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-black text-blue-700 transition hover:bg-blue-100">Voir <span aria-hidden="true">→</span></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 ring-1 ring-blue-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20 4.6 12.6A2 2 0 0 1 6.3 9.6l1.7-3a2 2 0 0 1 3.4 0L12 7.8l.6-1.2a2 2 0 0 1 3.4 0l1.7 3a2 2 0 0 1 1.7 3L15 20H9Z" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">Aucune mission trouvée.</p>
                                <p class="mt-1 text-xs text-slate-500">Les missions qui vous sont attribuées apparaîtront ici.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @if ($missions->hasPages())
        <div class="flex justify-center">
            {{ $missions->links() }}
        </div>
    @endif
</div>
@endsection
