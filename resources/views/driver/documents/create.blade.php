@extends('driver.layout')

@section('title', 'Déposer un document - Gestion Parc Automobile')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <a href="{{ route('driver.documents.index') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-200 transition mb-6">
        <i class="bi bi-arrow-left"></i> Retour aux documents
    </a>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-600 text-white shadow-lg shadow-violet-600/20">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V9.75c0-.621.504-1.125-1.125-1.125H13.5a2.25 2.25 0 00-2.25 2.25v3.375" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-violet-600">Document</p>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Déposer un document</h1>
                <p class="text-sm text-slate-500 mt-1">Ajoutez un document lié à votre profil ou à un véhicule.</p>
            </div>
        </div>
    </div>

    <form action="{{ route('driver.documents.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
        @csrf
        <div class="grid gap-5 md:grid-cols-2">
            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="type_document" class="text-sm font-bold text-slate-700">Type de document</label>
                <select id="type_document" name="type_document" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100">
                    @foreach (App\Models\Document::TYPES as $type)
                        <option value="{{ $type }}" {{ old('type_document') === $type ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                    @endforeach
                </select>
                @error('type_document')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="id_vehicule" class="text-sm font-bold text-slate-700">Véhicule concerné</label>
                <select id="id_vehicule" name="id_vehicule" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100">
                    <option value="">Aucun véhicule</option>
                    @foreach ($vehicules as $vehicule)
                        <option value="{{ $vehicule->id_vehicule }}" {{ old('id_vehicule') == $vehicule->id_vehicule ? 'selected' : '' }}>{{ $vehicule->immatriculation }} - {{ $vehicule->marque }} {{ $vehicule->modele }}</option>
                    @endforeach
                </select>
                @error('id_vehicule')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="numero_document" class="text-sm font-bold text-slate-700">Numéro du document</label>
                <input type="text" id="numero_document" name="numero_document" value="{{ old('numero_document') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100">
                @error('numero_document')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                <label for="date_expiration" class="text-sm font-bold text-slate-700">Date d'expiration</label>
                <input type="date" id="date_expiration" name="date_expiration" value="{{ old('date_expiration') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100">
                @error('date_expiration')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                <label for="fichier" class="text-sm font-bold text-slate-700">Fichier</label>
                <input type="file" id="fichier" name="fichier" class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 file:mr-4 file:rounded-xl file:border-0 file:bg-violet-50 file:px-4 file:py-2.5 file:text-xs file:font-bold file:text-violet-700 hover:file:bg-violet-100 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100">
                @error('fichier')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-6 sm:flex-row">
            <a href="{{ route('driver.documents.index') }}" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">Annuler</a>
            <button type="submit" class="rounded-xl bg-violet-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-violet-700">Envoyer le document</button>
        </div>
    </form>
</div>
@endsection
