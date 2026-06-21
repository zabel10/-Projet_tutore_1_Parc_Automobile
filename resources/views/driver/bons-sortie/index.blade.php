@extends('driver.layout')

@section('title', 'Bons de sortie - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-blue-600">Espace conducteur</p>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Mes bons de sortie</h1>
                <p class="text-sm text-slate-500 mt-1">Consultez l'historique de vos sorties véhicule et suivez leur statut.</p>
            </div>
            <a href="{{ route('driver.bons-sortie.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Créer un bon
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">N° Bon</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Destination</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Date sortie</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Date retour prévue</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($bonsSortie as $bon)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-sm font-bold text-slate-900">{{ $bon->numero }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-700">{{ $bon->destination }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ optional($bon->date_sortie)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ optional($bon->date_retour_prevue)->locale('fr')->isoFormat('D MMM YYYY') }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">
                                @if (in_array($bon->statut, ['en_cours', 'valide'], true))
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-bold text-blue-700 ring-1 ring-blue-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                        En cours
                                    </span>
                                @elseif ($bon->statut === 'cloture')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        Clôturé
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-700 ring-1 ring-slate-200">{{ ucfirst(str_replace('_', ' ', $bon->statut)) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 ring-1 ring-blue-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h2 class="text-sm font-bold text-slate-700 mt-3">Aucun bon de sortie trouvé.</h2>
                                <p class="text-xs text-slate-500 mt-1">Les bons créés apparaîtront automatiquement dans cette liste.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($bonsSortie->hasPages())
        <div class="flex justify-center">
            {{ $bonsSortie->links() }}
        </div>
    @endif
</div>
@endsection
