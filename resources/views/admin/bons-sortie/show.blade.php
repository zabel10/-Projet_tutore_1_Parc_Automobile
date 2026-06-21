@extends('admin.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-black text-slate-900">Détail bon de sortie</h1>
    <p class="text-slate-500 text-sm mt-1">{{ $bonSortie->numero }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Conducteur</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $bonSortie->conducteur->utilisateur->prenom ?? '' }} {{ $bonSortie->conducteur->utilisateur->nom ?? '' }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Véhicule</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $bonSortie->vehicule->immatriculation ?? '' }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Destination</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $bonSortie->destination }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Motif</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $bonSortie->motif }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Date sortie</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($bonSortie->date_sortie)->format('d/m/Y H:i') }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Retour prévu</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($bonSortie->date_retour_prevue)->format('d/m/Y H:i') }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Km départ</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ number_format($bonSortie->km_depart, 0, ',', ' ') }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Km retour</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $bonSortie->km_retour ? number_format($bonSortie->km_retour, 0, ',', ' ') : '—' }}</dd></div>
                @if($bonSortie->date_retour_reelle)
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Retour réel</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($bonSortie->date_retour_reelle)->format('d/m/Y H:i') }}</dd></div>
                @endif
                @if($bonSortie->observations)
                <div class="sm:col-span-2"><dt class="text-xs font-bold text-slate-500 uppercase">Observations</dt><dd class="mt-1 text-sm font-semibold text-slate-900 whitespace-pre-line">{{ $bonSortie->observations }}</dd></div>
                @endif
            </dl>
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5">
            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Statut actuel</h3>
            @php $s = $bonSortie->statut; @endphp
            <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-bold
                {{ $s === 'brouillon' ? 'bg-slate-100 text-slate-700' : '' }}
                {{ $s === 'valide' ? 'bg-emerald-100 text-emerald-700' : '' }}
                {{ $s === 'en_cours' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $s === 'cloture' ? 'bg-primary-100 text-primary-700' : '' }}
                {{ $s === 'annule' ? 'bg-red-100 text-red-700' : '' }}">
                {{ $s }}
            </span>

            <hr class="my-5 border-slate-100">

            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Actions</h3>
            <form method="POST" action="{{ route('admin.bons-sortie.update', $bonSortie) }}" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Statut</label>
                    <select name="statut" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                        @foreach(\App\Models\BonSortie::STATUTS as $st)
                            <option value="{{ $st }}" @selected(old('statut', $bonSortie->statut) === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Date retour réelle</label>
                    <input type="datetime-local" name="date_retour_reelle" value="{{ old('date_retour_reelle', $bonSortie->date_retour_reelle ? $bonSortie->date_retour_reelle->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Km retour</label>
                    <input type="number" name="km_retour" value="{{ old('km_retour', $bonSortie->km_retour) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" min="0" placeholder="Laisser vide si inconnu">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Observations</label>
                    <textarea name="observations" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition">{{ old('observations', $bonSortie->observations) }}</textarea>
                </div>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
                    <i class="bi bi-check-lg"></i> Mettre à jour
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
