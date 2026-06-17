@extends('driver.layout')

@section('title', 'Mes demandes - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.08em] text-indigo-600">Espace conducteur</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Mes demandes</h1>
                <p class="mt-2 text-sm leading-6 text-slate-500">Suivez vos demandes de véhicule, carburant, maintenance et signalements.</p>
            </div>
            <a href="{{ route('driver.demandes.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-md">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nouvelle demande
            </a>
        </div>
    </section>

    <section class="driver-table-card overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-200/60">
        <div class="overflow-x-auto">
            <table class="driver-table min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-gradient-to-r from-slate-50 to-indigo-50/60 text-left text-xs font-black uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3.5">N° Demande</th>
                        <th class="px-4 py-3.5">Type</th>
                        <th class="px-4 py-3.5">Sujet</th>
                        <th class="px-4 py-3.5">Véhicule</th>
                        <th class="px-4 py-3.5">Date</th>
                        <th class="px-4 py-3.5">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($demandes as $demande)
                        <tr class="transition hover:bg-indigo-50/35">
                            <td class="px-4 py-3.5 font-black text-slate-950">{{ $demande->numero }}</td>
                            <td class="px-4 py-3.5 font-semibold text-slate-700">{{ ucfirst(str_replace('_', ' ', $demande->type_demande)) }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ $demande->sujet }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ $demande->vehicule?->immatriculation ?? 'Non affecté' }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($demande->date_demande)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3.5">
                                @if ($demande->statut === 'approuvee')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-xs font-black text-emerald-700 ring-1 ring-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        Approuvée
                                    </span>
                                @elseif ($demande->statut === 'refusee')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1 text-xs font-black text-red-700 ring-1 ring-red-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                        Refusée
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-black text-amber-700 ring-1 ring-amber-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                        En attente
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-6 4h6m-6 4h6M6.5 21h11A2.5 2.5 0 0020 18.5v-13A2.5 2.5 0 0017.5 3h-11A2.5 2.5 0 004 5.5v13A2.5 2.5 0 006.5 21Z" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">Aucune demande trouvée.</p>
                                <p class="mt-1 text-xs text-slate-500">Créez une demande pour démarrer le suivi.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @if ($demandes->hasPages())
        <div class="flex justify-center">
            {{ $demandes->links() }}
        </div>
    @endif
</div>
@endsection
