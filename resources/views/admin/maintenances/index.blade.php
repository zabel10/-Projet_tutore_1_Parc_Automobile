@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Maintenances</h1><p class="text-slate-500 text-sm mt-1">Historique et suivi</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Véhicule</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Type</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Date</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Coût (FCFA)</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Prestataire</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Prochaine échéance</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($maintenances as $m)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3.5 text-slate-600">{{ $m->vehicule->immatriculation ?? '' }}</td>
                    <td class="px-5 py-3.5 font-semibold text-slate-900">{{ str_replace('_', ' ', $m->type_maintenance) }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($m->date_maintenance)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ number_format($m->cout, 0, ',', ' ') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $m->prestataire }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($m->prochaine_echeance)->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-5 py-8 text-center text-slate-400">Aucune maintenance enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
