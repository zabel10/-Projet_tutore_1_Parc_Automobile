@extends('admin.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-black text-slate-900">Modifier véhicule</h1>
    <p class="text-slate-500 text-sm mt-1">{{ $vehicule->immatriculation }} — {{ $vehicule->marque }} {{ $vehicule->modele }}</p>
</div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <form method="POST" action="{{ route('admin.vehicules.update', $vehicule) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Immatriculation</label>
                <input type="text" name="immatriculation" value="{{ old('immatriculation', $vehicule->immatriculation) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('immatriculation')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Marque</label>
                <input type="text" name="marque" value="{{ old('marque', $vehicule->marque) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('marque')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Modèle</label>
                <input type="text" name="modele" value="{{ old('modele', $vehicule->modele) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('modele')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Année</label>
                <input type="number" name="annee" value="{{ old('annee', $vehicule->annee) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required min="1900" max="{{ date('Y') + 1 }}">
                @error('annee')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                <select name="statut" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    <option value="">-- Choisir --</option>
                    @foreach(\App\Models\Vehicule::STATUTS as $st)
                        <option value="{{ $st }}" @selected(old('statut', $vehicule->statut) === $st)>{{ str_replace('_', ' ', $st) }}</option>
                    @endforeach
                </select>
                @error('statut')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Carburant</label>
                <input type="text" name="carburant" value="{{ old('carburant', $vehicule->carburant) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('carburant')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kilométrage</label>
                <input type="number" name="kilometrage" value="{{ old('kilometrage', $vehicule->kilometrage) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required min="0">
                @error('kilometrage')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Couleur</label>
                <input type="text" name="couleur" value="{{ old('couleur', $vehicule->couleur ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500">
                @error('couleur')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date d'acquisition</label>
                <input type="date" name="date_acquisition" value="{{ old('date_acquisition', $vehicule->date_acquisition->format('Y-m-d')) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_acquisition')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Photo du véhicule</label>
                @if($vehicule->photo_path)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $vehicule->photo_path) }}" alt="Photo véhicule" class="h-24 w-auto rounded-xl border border-slate-200 object-cover">
                    </div>
                    <p class="text-xs text-slate-500 mb-2">Laisser vide pour conserver la photo actuelle.</p>
                @endif
                <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-xl file:border-0 file:bg-primary-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-primary-700 hover:file:bg-primary-100 transition cursor-pointer">
                <p class="text-xs text-slate-400 mt-1.5">JPG, PNG ou WebP. Max 4 Mo. Laisser vide pour ne pas changer.</p>
                @error('photo')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
                <i class="bi bi-check-lg"></i> Mettre à jour
            </button>
            <a href="{{ route('admin.vehicules.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
