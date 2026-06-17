@extends('driver.layout')

@section('title', 'Maintenances - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div>
            <p class="text-sm font-black uppercase tracking-[0.08em] text-amber-600">Espace conducteur</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Mes maintenances</h1>
            <p class="mt-2 text-sm leading-6 text-slate-500">Suivez les interventions et prochaines échéances de vos véhicules.</p>
        </div>
    </section>

    <section class="driver-table-card overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-200/60">
        <div class="overflow-x-auto">
            <table class="driver-table min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-gradient-to-r from-slate-50 to-amber-50/60 text-left text-xs font-black uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3.5">Date</th>
                        <th class="px-4 py-3.5">Type</th>
                        <th class="px-4 py-3.5">Véhicule</th>
                        <th class="px-4 py-3.5">Prochaine échéance</th>
                        <th class="px-4 py-3.5">Description</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($maintenances as $maintenance)
                        <tr class="transition hover:bg-amber-50/35">
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($maintenance->date_maintenance)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3.5 font-black text-slate-950">{{ ucfirst(str_replace('_', ' ', $maintenance->type_maintenance)) }}</td>
                            <td class="px-4 py-3.5 font-semibold text-slate-700">{{ $maintenance->vehicule?->immatriculation ?? 'Non affecté' }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($maintenance->prochaine_echeance)->locale('fr')->isoFormat('D MMM YYYY') ?? 'Non planifiée' }}</td>
                            <td class="px-4 py-3.5 text-slate-500">{{ $maintenance->description ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 ring-1 ring-amber-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317a.75.75 0 011.042-1.042l.647.647a.75.75 0 01-.53 1.28l-1.159-.885Zm5.355 1.276a.75.75 0 011.042 1.042l-.647.647a.75.75 0 01-1.28-.53l.885-1.159ZM7.05 6.76a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25-1.25a.75.75 0 010-1.13Zm7.778 7.778a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25 1.25a.75.75 0 010-1.13ZM6.76 16.95a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 010-1.13ZM9.5 12a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0Z" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">Aucune maintenance trouvée.</p>
                                <p class="mt-1 text-xs text-slate-500">Les interventions planifiées seront visibles ici.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @if ($maintenances->hasPages())
        <div class="flex justify-center">
            {{ $maintenances->links() }}
        </div>
    @endif
</div>
@endsection
