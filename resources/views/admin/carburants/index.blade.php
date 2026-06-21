@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Carburants</h1><p class="text-slate-500 text-sm mt-1">Historique des ravitaillements</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Véhicule</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Conducteur</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Date</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Qté (L)</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Coût total</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Prix/L</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Km</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($carburants as $c)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3.5 text-slate-600">{{ $c->vehicule->immatriculation ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $c->conducteur->prenom ?? '' }} {{ $c->conducteur->nom ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($c->date_plein)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5 text-slate-900 font-semibold">{{ number_format($c->quantite_litres, 2) }}</td>
                    <td class="px-5 py-3.5 text-slate-900 font-semibold">{{ number_format($c->cout_total, 0, ',', ' ') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ number_format($c->prix_litre, 0, ',', ' ') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ number_format($c->kilometrage, 0, ',', ' ') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-5 py-8 text-center text-slate-400">Aucun ravitaillement enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
