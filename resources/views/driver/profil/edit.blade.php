@extends('driver.layout')

@section('title', 'Mon profil')

@section('content')
<div class="mx-auto max-w-3xl space-y-6" x-data="{ editing: false }">

    {{-- En-tête page --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-50 text-primary-600">
                    <i class="bi bi-person text-lg"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900">Mon profil</h1>
            </div>
            <p class="mt-1 text-sm text-slate-500">Consultez et modifiez vos informations personnelles</p>
        </div>
        <button type="button" @click="editing = !editing"
                class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 hover:-translate-y-0.5">
            <i class="bi" :class="editing ? 'bi-x-circle' : 'bi-pencil'"></i>
            <span x-text="editing ? 'Annuler' : 'Modifier'"></span>
        </button>
    </div>

    <form action="{{ route('driver.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">

        @csrf
        @method('PATCH')

        {{-- Carte profil --}}
        <div class="rounded-2xl border border-primary-200 bg-gradient-to-br from-primary-50 to-white p-6 shadow-sm">
            <div class="flex flex-col items-center sm:flex-row sm:gap-6">
                <div class="flex h-24 w-24 flex-shrink-0 items-center justify-center rounded-full bg-primary-600 text-3xl font-black text-white shadow-md">
                    {{ substr((string)(auth()->user()->prenom ?? auth()->user()->name), 0, 1) }}
                </div>
                <div class="mt-4 text-center sm:mt-0 sm:text-left">
                    <h2 class="text-xl font-extrabold text-slate-900">
                        {{ auth()->user()->prenom }} {{ auth()->user()->nom ?? '' }}
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">{{ auth()->user()->email }}</p>
                    <span class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-white px-3 py-1 text-xs font-bold text-primary-700 ring-1 ring-primary-200">
                        <span class="h-1.5 w-1.5 rounded-full bg-primary-600"></span>
                        Conducteur
                    </span>
                </div>
            </div>
        </div>

        {{-- Informations personnelles --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm divide-y divide-slate-100">
            <div class="p-6">
                <h2 class="text-base font-extrabold text-slate-900">Informations personnelles</h2>
                <p class="mt-1 text-sm text-slate-500">Nom, prénom et coordonnées</p>
            </div>
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="nom" class="text-sm font-semibold text-slate-700">Nom</label>
                        <input type="text" id="nom" name="nom"
                               value="{{ old('nom', auth()->user()->nom) }}"
                               :readonly="!editing"
                               class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white"
                               :class="editing ? 'bg-white' : 'bg-slate-50 text-slate-500'">
                        @error('nom')
                            <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="prenom" class="text-sm font-semibold text-slate-700">Prénom</label>
                        <input type="text" id="prenom" name="prenom"
                               value="{{ old('prenom', auth()->user()->prenom) }}"
                               :readonly="!editing"
                               class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white"
                               :class="editing ? 'bg-white' : 'bg-slate-50 text-slate-500'">
                        @error('prenom')
                            <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="telephone" class="text-sm font-semibold text-slate-700">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone"
                           value="{{ old('telephone', auth()->user()->telephone) }}"
                           :readonly="!editing"
                           class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white"
                           :class="editing ? 'bg-white' : 'bg-slate-50 text-slate-500'">
                    @error('telephone')
                        <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="adresse" class="text-sm font-semibold text-slate-700">Adresse</label>
                    <textarea id="adresse" name="adresse" rows="3"
                              :readonly="!editing"
                              class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white"
                              :class="editing ? 'bg-white' : 'bg-slate-50 text-slate-500'">{{ old('adresse') }}</textarea>
                    @error('adresse')
                        <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Informations permis --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm divide-y divide-slate-100">
            <div class="p-6">
                <h2 class="text-base font-extrabold text-slate-900">Permis de conduire</h2>
                <p class="mt-1 text-sm text-slate-500">Numéro, catégorie et date d'expiration</p>
            </div>
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="num_permis" class="text-sm font-semibold text-slate-700">Numéro de permis</label>
                        <input type="text" id="num_permis" name="num_permis"
                               value="{{ old('num_permis', $conducteur->num_permis ?? '') }}"
                               :readonly="!editing"
                               class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white"
                               :class="editing ? 'bg-white' : 'bg-slate-50 text-slate-500'">
                        @error('num_permis')
                            <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="categorie_permis" class="text-sm font-semibold text-slate-700">Catégorie</label>
                        <select id="categorie_permis" name="categorie_permis"
                                :disabled="!editing"
                                class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white"
                                :class="editing ? 'bg-white' : 'bg-slate-50 text-slate-500'">
                            @php
                                $categories = ['A','B','C','D','BE','CE'];
                                $currentCat = old('categorie_permis', $conducteur->categorie_permis ?? 'B');
                            @endphp
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ $currentCat === $cat ? 'selected' : '' }}>Catégorie {{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('categorie_permis')
                            <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="date_expiration_permis" class="text-sm font-semibold text-slate-700">Date d'expiration du permis</label>
                    <input type="date" id="date_expiration_permis" name="date_expiration_permis"
                           value="{{ old('date_expiration_permis', $conducteur->date_expiration_permis ?? '') }}"
                           :readonly="!editing"
                           class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white"
                           :class="editing ? 'bg-white' : 'bg-slate-50 text-slate-500'">
                    @error('date_expiration_permis')
                        <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Boutons d'action --}}
        <div x-show="editing" x-cloak x-transition class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('driver.dashboard') }}"
               class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-center text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:-translate-y-0.5">
                Annuler
            </a>
            <button type="submit"
                    class="rounded-xl bg-primary-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 hover:-translate-y-0.5">
                <i class="bi bi-check-circle mr-1.5"></i>Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection
