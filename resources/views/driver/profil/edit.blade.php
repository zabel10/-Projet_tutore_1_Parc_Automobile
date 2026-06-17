@extends('driver.layout')

@section('title', 'Mon profil - Gestion Parc Automobile')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <section class="driver-card rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center gap-4">
            <img src="{{ 'https://ui-avatars.com/api/?name=' . urlencode($conducteur->utilisateur->prenom . ' ' . $conducteur->utilisateur->nom) . '&background=2563EB&color=fff' }}" alt="{{ $conducteur->utilisateur->prenom }} {{ $conducteur->utilisateur->nom }}" class="h-16 w-16 rounded-2xl ring-2 ring-blue-100">
            <div>
                <p class="text-sm font-semibold text-blue-600">Profil conducteur</p>
                <h1 class="text-3xl font-black text-slate-950">{{ $conducteur->utilisateur->prenom }} {{ $conducteur->utilisateur->nom }}</h1>
            </div>
        </div>

        <form action="{{ route('driver.profil.update') }}" method="POST" class="mt-8 space-y-5">
            @csrf
            @method('PATCH')

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="nom" class="text-sm font-bold text-slate-700">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom', $conducteur->utilisateur->nom) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    @error('nom')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prenom" class="text-sm font-bold text-slate-700">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $conducteur->utilisateur->prenom) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    @error('prenom')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="telephone" class="text-sm font-bold text-slate-700">Téléphone</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $conducteur->utilisateur->telephone) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                @error('telephone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="num_permis" class="text-sm font-bold text-slate-700">Numéro de permis</label>
                    <input type="text" id="num_permis" name="num_permis" value="{{ old('num_permis', $conducteur->num_permis) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    @error('num_permis')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="categorie_permis" class="text-sm font-bold text-slate-700">Catégorie</label>
                    <select id="categorie_permis" name="categorie_permis" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        @foreach (['A', 'B', 'C', 'D', 'BE', 'CE'] as $categorie)
                            <option value="{{ $categorie }}" {{ old('categorie_permis', $conducteur->categorie_permis) === $categorie ? 'selected' : '' }}>{{ $categorie }}</option>
                        @endforeach
                    </select>
                    @error('categorie_permis')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="date_expiration_permis" class="text-sm font-bold text-slate-700">Expiration du permis</label>
                <input type="date" id="date_expiration_permis" name="date_expiration_permis" value="{{ old('date_expiration_permis', optional($conducteur->date_expiration_permis)->toDateString()) }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                @error('date_expiration_permis')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('driver.dashboard') }}" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">Annuler</a>
                <button type="submit" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">Mettre à jour</button>
            </div>
        </form>
    </section>
</div>
@endsection
