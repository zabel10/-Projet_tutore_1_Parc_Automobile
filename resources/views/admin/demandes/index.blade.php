@extends('admin.layout')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Demandes</h1>
        <p class="text-slate-500 text-sm mt-1">Demandes des conducteurs à traiter</p>
    </div>
</div>

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">N°</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Conducteur</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Type</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Sujet</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Véhicule</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Priorité</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Statut</th>
                    <th class="px-5 py-3.5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($demandes as $d)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3.5 font-mono text-xs font-bold text-slate-700">{{ $d->numero }}</td>
                    <td class="px-5 py-3.5 text-slate-900 font-semibold">{{ $d->conducteur->utilisateur->prenom ?? '' }} {{ $d->conducteur->utilisateur->nom ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $d->type_demande }}</td>
                    <td class="px-5 py-3.5 text-slate-600 max-w-[200px] truncate">{{ $d->sujet }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $d->vehicule->immatriculation ?? '—' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($d->date_demande)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5">
                        @php
                            $p = $d->priorite;
                            $badge = ['faible' => 'bg-slate-100 text-slate-700', 'moyenne' => 'bg-blue-100 text-blue-700', 'haute' => 'bg-amber-100 text-amber-700', 'urgente' => 'bg-red-100 text-red-700'];
                        @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold {{ $badge[$p] ?? 'bg-slate-100 text-slate-700' }}">{{ $p }}</span>
                    </td>
                    <td class="px-5 py-3.5">
                        @php $s = $d->statut; @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold
                            {{ $s === 'en_attente' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $s === 'approuvee' ? 'bg-emerald-100 text-emerald-700' : '' }}
                            {{ $s === 'refusee' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $s === 'traitee' ? 'bg-primary-100 text-primary-700' : '' }}">
                            {{ $s }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-right whitespace-nowrap">
                        <a href="{{ route('admin.demandes.show', $d) }}" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-bold text-primary-700 hover:bg-primary-50 transition">
                            <i class="bi bi-check2-square"></i> Traiter
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="px-5 py-8 text-center text-slate-400">Aucune demande enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-100 px-5 py-3">
        {{ $demandes->links() }}
    </div>
</div>
@endsection
