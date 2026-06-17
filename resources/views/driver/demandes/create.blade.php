@extends('driver.layout')

@section('title', 'Nouvelle demande - Gestion Parc Automobile')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <a href="{{ route('driver.demandes.index') }}" class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-4 py-2 text-sm font-bold text-indigo-700 transition hover:bg-indigo-100">
        <span aria-hidden="true">←</span>
        Retour aux demandes
    </a>

    <section class="overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-6">
            <div class="flex gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-6 4h6m-6 4h6M6.5 21h11A2.5 2.5 0 0020 18.5v-13A2.5 2.5 0 0017.5 3h-11A2.5 2.5 0 004 5.5v13A2.5 2.5 0 006.5 21Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-black uppercase tracking-[0.08em] text-indigo-600">Demande</p>
                    <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950">Nouvelle demande</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Soumettez une demande au gestionnaire du parc automobile.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('driver.demandes.store') }}" method="POST" class="mt-6 space-y-6">
            @csrf

            <div class="grid gap-5 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                    <label for="type_demande" class="text-sm font-black text-slate-700">Type de demande</label>
                    <select id="type_demande" name="type_demande" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        @foreach (App\Models\Demande::TYPES as $type)
                            <option value="{{ $type }}" {{ old('type_demande', $type) === $type ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                        @endforeach
                    </select>
                    @error('type_demande')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                    <label for="priorite" class="text-sm font-black text-slate-700">Priorité</label>
                    <select id="priorite" name="priorite" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        @foreach (['faible', 'moyenne', 'haute', 'urgente'] as $priorite)
                            <option value="{{ $priorite }}" {{ old('priorite', $priorite) === $priorite ? 'selected' : '' }}>{{ ucfirst($priorite) }}</option>
                        @endforeach
                    </select>
                    @error('priorite')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                    <label for="id_vehicule" class="text-sm font-black text-slate-700">Véhicule concerné</label>
                    <select id="id_vehicule" name="id_vehicule" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        <option value="">Aucun véhicule</option>
                        @foreach ($vehicules as $vehicule)
                            <option value="{{ $vehicule->id_vehicule }}" {{ old('id_vehicule') == $vehicule->id_vehicule ? 'selected' : '' }}>{{ $vehicule->immatriculation }} - {{ $vehicule->marque }} {{ $vehicule->modele }}</option>
                        @endforeach
                    </select>
                    @error('id_vehicule')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                    <label for="sujet" class="text-sm font-black text-slate-700">Sujet</label>
                    <input type="text" id="sujet" name="sujet" value="{{ old('sujet') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                    @error('sujet')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                    <label for="motif" class="text-sm font-black text-slate-700">Motif</label>
                    <textarea id="motif" name="motif" rows="5" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">{{ old('motif') }}</textarea>
                    @error('motif')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-6 sm:flex-row">
                <a href="{{ route('driver.demandes.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 transition hover:-translate-y-0.5 hover:bg-slate-50 hover:shadow-sm">Annuler</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-md">Envoyer la demande</button>
            </div>
        </form>
    </section>
</div>
@endsection
