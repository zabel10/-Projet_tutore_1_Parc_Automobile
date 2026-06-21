@extends('admin.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-black text-slate-900">Détail demande</h1>
    <p class="text-slate-500 text-sm mt-1">{{ $demande->numero }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Conducteur</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $demande->conducteur->utilisateur->prenom ?? '' }} {{ $demande->conducteur->utilisateur->nom ?? '' }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Type</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $demande->type_demande }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Sujet</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $demande->sujet }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Véhicule</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $demande->vehicule->immatriculation ?? '—' }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Priorité</dt><dd class="mt-1 text-sm font-semibold text-slate-900 capitalize">{{ $demande->priorite }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Date demande</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($demande->date_demande)->format('d/m/Y H:i') }}</dd></div>
                <div class="sm:col-span-2"><dt class="text-xs font-bold text-slate-500 uppercase">Motif</dt><dd class="mt-1 text-sm font-semibold text-slate-900 whitespace-pre-line">{{ $demande->motif }}</dd></div>
                @if($demande->reponse)
                <div class="sm:col-span-2"><dt class="text-xs font-bold text-slate-500 uppercase">Réponse</dt><dd class="mt-1 text-sm font-semibold text-slate-900 whitespace-pre-line">{{ $demande->reponse }}</dd></div>
                @endif
            </dl>
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5">
            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Statut actuel</h3>
            @php $s = $demande->statut; @endphp
            <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-bold
                {{ $s === 'en_attente' ? 'bg-amber-100 text-amber-700' : '' }}
                {{ $s === 'approuvee' ? 'bg-emerald-100 text-emerald-700' : '' }}
                {{ $s === 'refusee' ? 'bg-red-100 text-red-700' : '' }}
                {{ $s === 'traitee' ? 'bg-primary-100 text-primary-700' : '' }}">
                {{ $s }}
            </span>

            <hr class="my-5 border-slate-100">

            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Traiter la demande</h3>
            <form method="POST" action="{{ route('admin.demandes.update', $demande) }}" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Statut</label>
                    <select name="statut" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                        @foreach(\App\Models\Demande::STATUTS as $st)
                            <option value="{{ $st }}" @selected(old('statut', $demande->statut) === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Réponse</label>
                    <textarea name="reponse" rows="4" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" placeholder="Votre réponse au conducteur...">{{ old('reponse', $demande->reponse) }}</textarea>
                </div>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
                    <i class="bi bi-check-lg"></i> Mettre à jour
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
