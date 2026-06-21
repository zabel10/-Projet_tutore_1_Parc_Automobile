@extends('driver.layout')

@section('title', 'Mes affectations - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs font-bold uppercase tracking-wider text-sky-600">Espace conducteur</p>
        <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Mes affectations</h1>
        <p class="text-sm text-slate-500 mt-1">Consultez les véhicules qui vous sont affectés et les missions associées.</p>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Véhicule</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Date début</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Date fin prévue</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Mission</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Statut</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($affectations as $affectation)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-sm text-slate-600">
                                <p class="font-bold text-slate-900">{{ $affectation->vehicule?->immatriculation ?? 'Non affecté' }}</p>
                                <p class="text-xs text-slate-500">{{ $affectation->vehicule ? $affectation->vehicule->marque . ' ' . $affectation->vehicule->modele : '' }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ optional($affectation->date_debut)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ optional($affectation->date_fin_prevue)->locale('fr')->isoFormat('D MMM YYYY') ?? 'Non définie' }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-700">{{ $affectation->mission?->destination ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-bold text-blue-700 ring-1 ring-blue-200">{{ ucfirst(str_replace('_', ' ', $affectation->statut)) }}</span>
                            </td>
                            <td class="px-4 py-3 text-right text-sm text-slate-600">
                                <a href="{{ route('driver.affectations.show', $affectation) }}" class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 ring-1 ring-sky-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8m-8 4h8m-6 4h4M5.6 7.5l.9-1.4A2 2 0 0 1 8.2 5h7.6a2 2 0 0 1 1.7 1.1l.9 1.4M5 11h14l-.9 6.2A2 2 0 0 1 16.1 19H7.9a2 2 0 01-2-1.8L5 11Z" />
                                    </svg>
                                </div>
                                <h2 class="text-sm font-bold text-slate-700 mt-3">Aucune affectation trouvée.</h2>
                                <p class="text-xs text-slate-500 mt-1">Les affectations de véhicules apparaîtront ici.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($affectations->hasPages())
        <div class="flex justify-center">
            {{ $affectations->links() }}
        </div>
    @endif
</div>
@endsection
