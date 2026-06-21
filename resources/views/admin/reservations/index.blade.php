@extends('admin.layout')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Réservations</h1>
        <p class="text-slate-500 text-sm mt-1">Gestion des réservations de véhicules</p>
    </div>
</div>

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Réf.</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Véhicule</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Conducteur</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Début</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Fin</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Motif</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($reservations ?? [] as $r)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3.5 font-semibold text-slate-900">#{{ $r->id_reservation }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $r->vehicule->immatriculation ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $r->conducteur->utilisateur->prenom ?? '' }} {{ $r->conducteur->utilisateur->nom ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($r->date_debut)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($r->date_fin)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $r->motif ?? '—' }}</td>
                    <td class="px-5 py-3.5">
                        @php $st = $r->statut; @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold
                            {{ $st === 'confirmee' ? 'bg-emerald-100 text-emerald-700' : '' }}
                            {{ $st === 'en_cours' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $st === 'terminee' ? 'bg-slate-100 text-slate-700' : '' }}
                            {{ $st === 'annulee' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $st }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-5 py-8 text-center text-slate-400">Aucune réservation enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
