@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Modifier ravitaillement</h1><p class="text-slate-500 text-sm mt-1">{{ $carburant->vehicule->immatriculation ?? '' }} — {{ $carburant->date_plein }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <form method="POST" action="{{ route('admin.carburants.update', $carburant) }}" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Véhicule</label>
                <select name="id_vehicule" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach($vehicules as $v)
                        <option value="{{ $v->id_vehicule }}" @selected(old('id_vehicule', $carburant->id_vehicule) == $v->id_vehicule)>{{ $v->immatriculation }} — {{ $v->marque }} {{ $v->modele }}</option>
                    @endforeach
                </select>
                @error('id_vehicule')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Conducteur</label>
                <select name="id_conducteur" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach($conducteurs as $c)
                        <option value="{{ $c->id_conducteur }}" @selected(old('id_conducteur', $carburant->id_conducteur) == $c->id_conducteur)>{{ $c->utilisateur->prenom }} {{ $c->utilisateur->nom }}</option>
                    @endforeach
                </select>
                @error('id_conducteur')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date</label>
                <input type="date" name="date_plein" value="{{ old('date_plein', $carburant->date_plein) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_plein')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Quantité (L)</label>
                <input type="number" name="quantite_litres" value="{{ old('quantite_litres', $carburant->quantite_litres) }}" step="0.01" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required min="0">
                @error('quantite_litres')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Prix / litre</label>
                <input type="number" name="prix_litre" value="{{ old('prix_litre', $carburant->prix_litre) }}" step="0.01" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required min="0">
                @error('prix_litre')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kilométrage</label>
                <input type="number" name="kilometrage" value="{{ old('kilometrage', $carburant->kilometrage) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required min="0">
                @error('kilometrage')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800"><i class="bi bi-check-lg"></i> Mettre à jour</button>
            <a href="{{ route('admin.carburants.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">Annuler</a>
        </div>
    </form>
</div>
@endsection
