@extends('driver.layout')

@section('title', 'Bons de sortie - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.08em] text-blue-600">Espace conducteur</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Mes bons de sortie</h1>
                <p class="mt-2 text-sm leading-6 text-slate-500">Consultez l'historique de vos sorties véhicule et suivez leur statut.</p>
            </div>
            <a href="{{ route('driver.bons-sortie.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-md">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Créer un bon
            </a>
        </div>
    </section>

    <section class="driver-table-card overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-200/60">
        <div class="overflow-x-auto">
            <table class="driver-table min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-gradient-to-r from-slate-50 to-blue-50/60 text-left text-xs font-black uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3.5">N° Bon</th>
                        <th class="px-4 py-3.5">Destination</th>
                        <th class="px-4 py-3.5">Date sortie</th>
                        <th class="px-4 py-3.5">Date retour prévue</th>
                        <th class="px-4 py-3.5">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($bonsSortie as $bon)
                        <tr class="transition hover:bg-blue-50/40">
                            <td class="px-4 py-3.5 font-black text-slate-950">{{ $bon->numero }}</td>
                            <td class="px-4 py-3.5 font-semibold text-slate-700">{{ $bon->destination }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($bon->date_sortie)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($bon->date_retour_prevue)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3.5">
                                @if (in_array($bon->statut, ['en_cours', 'valide'], true))
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-xs font-black text-blue-700 ring-1 ring-blue-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                        En cours
                                    </span>
                                @elseif ($bon->statut === 'cloture')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-xs font-black text-emerald-700 ring-1 ring-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        Clôturé
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-black text-slate-700 ring-1 ring-slate-200">{{ ucfirst(str_replace('_', ' ', $bon->statut)) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 ring-1 ring-blue-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">Aucun bon de sortie trouvé.</p>
                                <p class="mt-1 text-xs text-slate-500">Les bons créés apparaîtront automatiquement dans cette liste.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @if ($bonsSortie->hasPages())
        <div class="flex justify-center">
            {{ $bonsSortie->links() }}
        </div>
    @endif
</div>
@endsection
