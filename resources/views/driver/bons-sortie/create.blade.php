@extends('driver.layout')

@section('title', 'Nouveau bon de sortie - Gestion Parc Automobile')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <a href="{{ route('driver.bons-sortie.index') }}" class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-sm font-bold text-blue-700 transition hover:bg-blue-100">
        <span aria-hidden="true">←</span>
        Retour aux bons de sortie
    </a>

    <section class="overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-6">
            <div class="flex gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-black uppercase tracking-[0.08em] text-blue-600">Bon de sortie</p>
                    <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950">Créer un bon de sortie</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Renseignez les informations de sortie du véhicule affecté.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('driver.bons-sortie.store') }}" method="POST" class="mt-6 space-y-6">
            @csrf

            <div class="grid gap-5 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                    <label for="id_vehicule" class="text-sm font-black text-slate-700">Véhicule</label>
                    <select id="id_vehicule" name="id_vehicule" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        @foreach ($vehicules as $vehicule)
                            <option value="{{ $vehicule->id_vehicule }}">{{ $vehicule->immatriculation }} - {{ $vehicule->marque }} {{ $vehicule->modele }}</option>
                        @endforeach
                    </select>
                    @error('id_vehicule')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                    <label for="destination" class="text-sm font-black text-slate-700">Destination</label>
                    <input type="text" id="destination" name="destination" value="{{ old('destination') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    @error('destination')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                    <label for="km_depart" class="text-sm font-black text-slate-700">Kilométrage départ</label>
                    <input type="number" id="km_depart" name="km_depart" value="{{ old('km_depart') }}" min="0" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    @error('km_depart')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                    <label for="date_sortie" class="text-sm font-black text-slate-700">Date de sortie</label>
                    <input type="date" id="date_sortie" name="date_sortie" value="{{ old('date_sortie', today()->toDateString()) }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    @error('date_sortie')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                    <label for="date_retour_prevue" class="text-sm font-black text-slate-700">Date retour prévue</label>
                    <input type="date" id="date_retour_prevue" name="date_retour_prevue" value="{{ old('date_retour_prevue', today()->toDateString()) }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    @error('date_retour_prevue')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                    <label for="motif" class="text-sm font-black text-slate-700">Motif</label>
                    <textarea id="motif" name="motif" rows="4" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">{{ old('motif') }}</textarea>
                    @error('motif')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                    <label for="observations" class="text-sm font-black text-slate-700">Observations</label>
                    <textarea id="observations" name="observations" rows="3" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">{{ old('observations') }}</textarea>
                    @error('observations')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-6 sm:flex-row">
                <a href="{{ route('driver.bons-sortie.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 transition hover:-translate-y-0.5 hover:bg-slate-50 hover:shadow-sm">Annuler</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-md">Créer le bon</button>
            </div>
        </form>
    </section>
</div>
@endsection
