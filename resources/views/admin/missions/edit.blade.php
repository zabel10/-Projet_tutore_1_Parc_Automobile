@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Modifier mission</h1><p class="text-slate-500 text-sm mt-1">#{{ $mission->id_mission }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <form method="POST" action="{{ route('admin.missions.update', $mission) }}" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Véhicule</label>
                <select name="id_vehicule" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach($vehicules as $v)
                        <option value="{{ $v->id_vehicule }}" @selected(old('id_vehicule', $mission->id_vehicule) == $v->id_vehicule)>{{ $v->immatriculation }} — {{ $v->marque }} {{ $v->modele }}</option>
                    @endforeach
                </select>
                @error('id_vehicule')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Conducteur</label>
                <select name="id_conducteur" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach($conducteurs as $c)
                        <option value="{{ $c->id_conducteur }}" @selected(old('id_conducteur', $mission->id_conducteur) == $c->id_conducteur)>{{ $c->utilisateur->prenom }} {{ $c->utilisateur->nom }}</option>
                    @endforeach
                </select>
                @error('id_conducteur')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date départ</label>
                <input type="date" name="date_depart" value="{{ old('date_depart', $mission->date_depart) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_depart')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date retour</label>
                <input type="date" name="date_retour" value="{{ old('date_retour', $mission->date_retour) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_retour')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Destination</label>
                <input type="text" name="destination" value="{{ old('destination', $mission->destination) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('destination')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Motif</label>
                <textarea name="motif" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>{{ old('motif', $mission->motif) }}</textarea>
                @error('motif')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Km départ</label>
                <input type="number" name="km_depart" value="{{ old('km_depart', $mission->km_depart) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required min="0">
                @error('km_depart')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Km retour</label>
                <input type="number" name="km_retour" value="{{ old('km_retour', $mission->km_retour) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" min="0">
                @error('km_retour')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                <select name="statut" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach(\App\Models\Mission::STATUTS as $st)
                        <option value="{{ $st }}" @selected(old('statut', $mission->statut) === $st)>{{ str_replace('_', ' ', $st) }}</option>
                    @endforeach
                </select>
                @error('statut')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800"><i class="bi bi-check-lg"></i> Mettre à jour</button>
            <a href="{{ route('admin.missions.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">Annuler</a>
        </div>
    </form>
</div>
@endsection
