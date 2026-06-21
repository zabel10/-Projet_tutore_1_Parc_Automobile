@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Assurances</h1><p class="text-slate-500 text-sm mt-1">Contrats d'assurance</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Véhicule</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Compagnie</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">N° contrat</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Début</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Fin</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Type</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($assurances as $a)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3.5 text-slate-600">{{ $a->vehicule->immatriculation ?? '' }}</td>
                    <td class="px-5 py-3.5 font-semibold text-slate-900">{{ $a->compagnie }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $a->numero_contrat }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($a->date_debut)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($a->date_fin)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5"><span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold bg-primary-100 text-primary-700">{{ str_replace('_', ' ', $a->type_assurance) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-5 py-8 text-center text-slate-400">Aucune assurance enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
