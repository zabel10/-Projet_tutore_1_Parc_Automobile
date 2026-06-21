@extends('admin.layout')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Bons de sortie</h1>
        <p class="text-slate-500 text-sm mt-1">Suivi et validation des sorties de véhicules</p>
    </div>
</div>

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">N°</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Conducteur</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Véhicule</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Destination</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Sortie</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Retour prévu</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Statut</th>
                    <th class="px-5 py-3.5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($bonsSortie as $bs)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3.5 font-mono text-xs font-bold text-slate-700">{{ $bs->numero }}</td>
                    <td class="px-5 py-3.5 text-slate-900 font-semibold">{{ $bs->conducteur->utilisateur->prenom ?? '' }} {{ $bs->conducteur->utilisateur->nom ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $bs->vehicule->immatriculation ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600 max-w-[180px] truncate">{{ $bs->destination }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($bs->date_sortie)->format('d/m/Y H:i') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($bs->date_retour_prevue)->format('d/m/Y H:i') }}</td>
                    <td class="px-5 py-3.5">
                        @php $s = $bs->statut; @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold
                            {{ $s === 'brouillon' ? 'bg-slate-100 text-slate-700' : '' }}
                            {{ $s === 'valide' ? 'bg-emerald-100 text-emerald-700' : '' }}
                            {{ $s === 'en_cours' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $s === 'cloture' ? 'bg-primary-100 text-primary-700' : '' }}
                            {{ $s === 'annule' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $s }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-right whitespace-nowrap">
                        <a href="{{ route('admin.bons-sortie.show', $bs) }}" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-bold text-primary-700 hover:bg-primary-50 transition">
                            <i class="bi bi-check2-square"></i> Gérer
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="px-5 py-8 text-center text-slate-400">Aucun bon de sortie enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-100 px-5 py-3">
        {{ $bonsSortie->links() }}
    </div>
</div>
@endsection
