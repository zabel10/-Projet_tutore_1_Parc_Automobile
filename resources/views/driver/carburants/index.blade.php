@extends('driver.layout')

@section('title', 'Ravitaillements - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.08em] text-emerald-600">Espace conducteur</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Mes ravitaillements</h1>
                <p class="mt-2 text-sm leading-6 text-slate-500">Historique des pleins et consommations enregistrés pour vos véhicules.</p>
            </div>
            <a href="{{ route('driver.carburants.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-emerald-600/20 transition hover:-translate-y-0.5 hover:bg-emerald-700 hover:shadow-md">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nouveau ravitaillement
            </a>
        </div>
    </section>

    <section class="driver-table-card overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-200/60">
        <div class="overflow-x-auto">
            <table class="driver-table min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-gradient-to-r from-slate-50 to-emerald-50/60 text-left text-xs font-black uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3.5">Date</th>
                        <th class="px-4 py-3.5">Véhicule</th>
                        <th class="px-4 py-3.5">Quantité</th>
                        <th class="px-4 py-3.5">Prix / litre</th>
                        <th class="px-4 py-3.5">Coût total</th>
                        <th class="px-4 py-3.5">Kilométrage</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($carburants as $carburant)
                        <tr class="transition hover:bg-emerald-50/35">
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($carburant->date_plein)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3.5 font-black text-slate-950">{{ $carburant->vehicule?->immatriculation ?? 'Non affecté' }}</td>
                            <td class="px-4 py-3.5 font-semibold text-slate-700">{{ $carburant->quantite_litres }} L</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ number_format($carburant->prix_litre, 0, ',', ' ') }} FCFA</td>
                            <td class="px-4 py-3.5 font-bold text-slate-950">{{ number_format($carburant->cout_total, 0, ',', ' ') }} FCFA</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ $carburant->kilometrage }} km</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.303 8.35a3.5 3.5 0 00-4.95-4.95l-1.2 1.2a3.5 3.5 0 004.95 4.95l1.2-1.2Zm-1.4 1.4L5.5 20.16a2 2 0 01-1.7-.56L2.4 18.2a2 2 0 010-2.83L12.77 5l2.83 2.83-10.37 10.37a2 2 0 000 2.83l1.4 1.4a2 2 0 002.83 0l10.37-10.37 2.12 2.12a2 2 0 01-2.83 2.83L15.9 11.16l-1.4-1.41Z" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">Aucun ravitaillement enregistré.</p>
                                <p class="mt-1 text-xs text-slate-500">Ajoutez un plein pour alimenter le suivi carburant.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @if ($carburants->hasPages())
        <div class="flex justify-center">
            {{ $carburants->links() }}
        </div>
    @endif
</div>
@endsection
