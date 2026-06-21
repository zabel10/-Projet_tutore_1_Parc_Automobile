@extends('driver.layout')

@section('title', 'Demande de véhicule')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <a href="{{ route('driver.demandes.index') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-200 transition mb-6">
        <i class="bi bi-arrow-left"></i> Voir mes demandes
    </a>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-6 4h6m-6 4h6M6.5 21h11A2.5 2.5 0 0020 18.5v-13A2.5 2.5 0 0017.5 3h-11A2.5 2.5 0 004 5.5v13A2.5 2.5 0 006.5 21Z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-blue-600">Demande</p>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Demande de véhicule</h1>
                <p class="text-sm text-slate-500 mt-1">Soumettez une demande pour obtenir un véhicule</p>
            </div>
        </div>
    </div>

    <form action="{{ route('driver.demandes.store') }}" method="POST" class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
        @csrf
        <div class="space-y-5">
            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="date" class="text-sm font-bold text-slate-700">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100">
                @error('date')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="destination" class="text-sm font-bold text-slate-700">Destination</label>
                <input type="text" id="destination" name="destination" value="{{ old('destination') }}" placeholder="Ex: Bobo-Dioulasso" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100">
                @error('destination')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="motif" class="text-sm font-bold text-slate-700">Motif</label>
                <textarea id="motif" name="motif" rows="5" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100" placeholder="Motif de la demande...">{{ old('motif') }}</textarea>
                @error('motif')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-6 sm:flex-row">
                <a href="{{ route('driver.demandes.index') }}" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">Annuler</a>
                <button type="submit" class="rounded-xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700">Soumettre la demande</button>
            </div>
        </div>
    </form>
</div>
@endsection
