@extends('driver.layout')

@section('title', 'Mes affectations - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div>
            <p class="text-sm font-black uppercase tracking-[0.08em] text-sky-600">Espace conducteur</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Mes affectations</h1>
            <p class="mt-2 text-sm leading-6 text-slate-500">Consultez les véhicules qui vous sont affectés et les missions associées.</p>
        </div>
    </section>

    <section class="driver-table-card overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-200/60">
        <div class="overflow-x-auto">
            <table class="driver-table min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-gradient-to-r from-slate-50 to-sky-50/60 text-left text-xs font-black uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3.5">Véhicule</th>
                        <th class="px-4 py-3.5">Date début</th>
                        <th class="px-4 py-3.5">Date fin prévue</th>
                        <th class="px-4 py-3.5">Mission</th>
                        <th class="px-4 py-3.5">Statut</th>
                        <th class="px-4 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($affectations as $affectation)
                        <tr class="transition hover:bg-sky-50/35">
                            <td class="px-4 py-3.5">
                                <p class="font-black text-slate-950">{{ $affectation->vehicule?->immatriculation ?? 'Non affecté' }}</p>
                                <p class="text-xs text-slate-500">{{ $affectation->vehicule ? $affectation->vehicule->marque . ' ' . $affectation->vehicule->modele : '' }}</p>
                            </td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($affectation->date_debut)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($affectation->date_fin_prevue)->locale('fr')->isoFormat('D MMM YYYY') ?? 'Non définie' }}</td>
                            <td class="px-4 py-3.5 font-semibold text-slate-700">{{ $affectation->mission?->destination ?? '-' }}</td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-xs font-black text-blue-700 ring-1 ring-blue-200">{{ ucfirst(str_replace('_', ' ', $affectation->statut)) }}</span>
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                <a href="{{ route('driver.affectations.show', $affectation) }}" class="inline-flex items-center gap-1 rounded-full bg-sky-50 px-3 py-1.5 text-xs font-black text-sky-700 transition hover:bg-sky-100">Voir <span aria-hidden="true">→</span></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 ring-1 ring-sky-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8m-8 4h8m-6 4h4M5.6 7.5l.9-1.4A2 2 0 0 1 8.2 5h7.6a2 2 0 0 1 1.7 1.1l.9 1.4M5 11h14l-.9 6.2A2 2 0 0 1 16.1 19H7.9a2 2 0 01-2-1.8L5 11Z" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">Aucune affectation trouvée.</p>
                                <p class="mt-1 text-xs text-slate-500">Les affectations de véhicules apparaîtront ici.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @if ($affectations->hasPages())
        <div class="flex justify-center">
            {{ $affectations->links() }}
        </div>
    @endif
</div>
@endsection
