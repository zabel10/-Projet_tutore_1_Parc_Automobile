@extends('driver.layout')

@section('title', 'Mes demandes - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-blue-600">Espace conducteur</p>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Mes demandes</h1>
                <p class="text-sm text-slate-500 mt-1">Suivez vos demandes de véhicule, carburant, maintenance et signalements.</p>
            </div>
            <a href="{{ route('driver.demandes.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nouvelle demande
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">N° Demande</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Sujet</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Véhicule</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($demandes as $demande)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-sm font-bold text-slate-900">{{ $demande->numero }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-700">{{ ucfirst(str_replace('_', ' ', $demande->type_demande)) }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $demande->sujet }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $demande->vehicule?->immatriculation ?? 'Non affecté' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ optional($demande->date_demande)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">
                                @if ($demande->statut === 'approuvee')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        Approuvée
                                    </span>
                                @elseif ($demande->statut === 'refusee')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700 ring-1 ring-red-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                        Refusée
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 ring-1 ring-amber-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                        En attente
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 ring-1 ring-slate-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-6 4h6m-6 4h6M6.5 21h11A2.5 2.5 0 0020 18.5v-13A2.5 2.5 0 0017.5 3h-11A2.5 2.5 0 004 5.5v13A2.5 2.5 0 006.5 21Z" />
                                    </svg>
                                </div>
                                <h2 class="text-sm font-bold text-slate-700 mt-3">Aucune demande trouvée.</h2>
                                <p class="text-xs text-slate-500 mt-1">Créez une demande pour démarrer le suivi.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($demandes->hasPages())
        <div class="flex justify-center">
            {{ $demandes->links() }}
        </div>
    @endif
</div>
@endsection
