@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Missions</h1><p class="text-slate-500 text-sm mt-1">Suivi des missions</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Réf.</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Véhicule</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Conducteur</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Destination</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Départ</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Retour</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Statut</th>
                    <th class="px-5 py-3.5 text-right text-xs font-bold text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($missions as $m)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3.5 font-semibold text-slate-900">#{{ $m->id_mission }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $m->vehicule->marque ?? '' }} {{ $m->vehicule->modele ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $m->conducteur->prenom ?? '' }} {{ $m->conducteur->nom ?? '' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $m->destination }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($m->date_depart)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $m->date_retour ? \Carbon\Carbon::parse($m->date_retour)->format('d/m/Y') : '—' }}</td>
                    <td class="px-5 py-3.5">
                        @php $st = $m->statut; @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold
                            {{ $st === 'planifiee' ? 'bg-slate-100 text-slate-700' : '' }}
                            {{ $st === 'en_cours' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $st === 'terminee' ? 'bg-emerald-100 text-emerald-700' : '' }}
                            {{ $st === 'annulee' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ str_replace('_', ' ', $st) }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        <a href="{{ route('admin.missions.edit', $m) }}" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-primary-700 hover:bg-primary-50 transition"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.missions.destroy', $m) }}" class="inline" onsubmit="return confirm('Supprimer ?');">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50 transition"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="px-5 py-8 text-center text-slate-400">Aucune mission trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
