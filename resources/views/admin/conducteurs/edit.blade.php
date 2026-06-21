@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Modifier conducteur</h1><p class="text-slate-500 text-sm mt-1">{{ $conducteur->utilisateur->prenom }} {{ $conducteur->utilisateur->nom }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <form method="POST" action="{{ route('admin.conducteurs.update', $conducteur) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nom</label>
                <input type="text" name="nom" value="{{ old('nom', $conducteur->utilisateur->nom) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('nom')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom', $conducteur->utilisateur->prenom) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('prenom')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $conducteur->utilisateur->email) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" name="mot_de_passe" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" minlength="8">
                @error('mot_de_passe')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $conducteur->utilisateur->telephone) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500">
                @error('telephone')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">N° permis</label>
                <input type="text" name="num_permis" value="{{ old('num_permis', $conducteur->num_permis) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('num_permis')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date expiration permis</label>
                <input type="date" name="date_expiration_permis" value="{{ old('date_expiration_permis', $conducteur->date_expiration_permis) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_expiration_permis')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Catégorie permis</label>
                <input type="text" name="categorie_permis" value="{{ old('categorie_permis', $conducteur->categorie_permis) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('categorie_permis')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', $conducteur->date_naissance) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_naissance')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Photo du conducteur</label>
                @if($conducteur->photo_path)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $conducteur->photo_path) }}" alt="Photo conducteur" class="h-24 w-24 rounded-xl border border-slate-200 object-cover">
                    </div>
                    <p class="text-xs text-slate-500 mb-2">Laisser vide pour conserver la photo actuelle.</p>
                @endif
                <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-xl file:border-0 file:bg-primary-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-primary-700 hover:file:bg-primary-100 transition cursor-pointer">
                <p class="text-xs text-slate-400 mt-1.5">JPG, PNG ou WebP. Max 4 Mo. Laisser vide pour ne pas changer.</p>
                @error('photo')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800"><i class="bi bi-check-lg"></i> Mettre à jour</button>
            <a href="{{ route('admin.conducteurs.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">Annuler</a>
        </div>
    </form>
</div>
@endsection
