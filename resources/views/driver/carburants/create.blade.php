@extends('driver.layout')

@section('title', 'Nouveau ravitaillement - Gestion Parc Automobile')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <a href="{{ route('driver.carburants.index') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-200 transition mb-6">
        <i class="bi bi-arrow-left"></i> Retour aux ravitaillements
    </a>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.303 8.35a3.5 3.5 0 00-4.95-4.95l-1.2 1.2a3.5 3.5 0 004.95 4.95l1.2-1.2Zm-1.4 1.4L5.5 20.16a2 2 0 01-1.7-.56L2.4 18.2a2 2 0 010-2.83L12.77 5l2.83 2.83-10.37 10.37a2 2 0 000 2.83l1.4 1.4a2 2 0 002.83 0l10.37-10.37 2.12 2.12a2 2 0 01-2.83 2.83L15.9 11.16l-1.4-1.41Z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-600">Carburant</p>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Enregistrer un ravitaillement</h1>
                <p class="text-sm text-slate-500 mt-1">Renseignez les informations du plein effectué.</p>
            </div>
        </div>
    </div>

    <form action="{{ route('driver.carburants.store') }}" method="POST" class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
        @csrf
        <div class="grid gap-5 md:grid-cols-2">
            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                <label for="id_vehicule" class="text-sm font-bold text-slate-700">Véhicule</label>
                <select id="id_vehicule" name="id_vehicule" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                    @foreach ($vehicules as $vehicule)
                        <option value="{{ $vehicule->id_vehicule }}">{{ $vehicule->immatriculation }} - {{ $vehicule->marque }} {{ $vehicule->modele }}</option>
                    @endforeach
                </select>
                @error('id_vehicule')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="date_plein" class="text-sm font-bold text-slate-700">Date du plein</label>
                <input type="date" id="date_plein" name="date_plein" value="{{ old('date_plein', today()->toDateString()) }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                @error('date_plein')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="kilometrage" class="text-sm font-bold text-slate-700">Kilométrage</label>
                <input type="number" id="kilometrage" name="kilometrage" value="{{ old('kilometrage') }}" min="0" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                @error('kilometrage')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="quantite_litres" class="text-sm font-bold text-slate-700">Quantité en litres</label>
                <input type="number" step="0.01" id="quantite_litres" name="quantite_litres" value="{{ old('quantite_litres') }}" min="0" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                @error('quantite_litres')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="prix_litre" class="text-sm font-bold text-slate-700">Prix par litre</label>
                <input type="number" step="0.01" id="prix_litre" name="prix_litre" value="{{ old('prix_litre') }}" min="0" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                @error('prix_litre')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-6 sm:flex-row">
            <a href="{{ route('driver.carburants.index') }}" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">Annuler</a>
            <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700">Enregistrer le plein</button>
        </div>
    </form>
</div>
@endsection
