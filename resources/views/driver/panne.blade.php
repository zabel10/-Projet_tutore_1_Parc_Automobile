@extends('driver.layout')

@section('title', 'Signaler une panne')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-50 text-red-600">
                    <i class="bi bi-wrench text-lg"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900">Signaler une panne</h1>
            </div>
            <p class="mt-1 text-sm text-slate-500">Décrivez le problème et téléchargez une photo si nécessaire</p>
        </div>
    </div>

    <form action="{{ route('driver.panne.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-5">
                <div>
                    <label for="type_panne" class="text-sm font-semibold text-slate-700">Type de panne</label>
                    <select id="type_panne" name="type_panne" required
                            class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white">
                        <option value="">Sélectionnez le type de panne</option>
                        <option value="moteur">Moteur</option>
                        <option value="frein">Système de freinage</option>
                        <option value="electricite">Électricité</option>
                        <option value="pneu">Pneu / Roulement</option>
                        <option value="transmission">Transmission</option>
                        <option value="autre">Autre problème</option>
                    </select>
                    @error('type_panne')
                        <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="text-sm font-semibold text-slate-700">Description détaillée</label>
                    <textarea id="description" name="description" rows="4" required placeholder="Décrivez la panne rencontrée..."
                              class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="photo" class="text-sm font-semibold text-slate-700">Photo de la panne <span class="text-slate-400 font-normal">(optionnel)</span></label>
                    <input type="file" id="photo" name="photo" accept="image/*"
                           class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white file:mr-3 file:rounded-lg file:border-0 file:bg-primary-50 file:px-4 file:py-2 file:text-sm file:font-bold file:text-primary-700 hover:file:bg-primary-100">
                    @error('photo')
                        <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="gravite" class="text-sm font-semibold text-slate-700">Gravité</label>
                    <select id="gravite" name="gravite" required
                            class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold outline-none transition focus:border-primary-500 focus:ring-4 focus:ring-primary-100 bg-white">
                        <option value="faible">Faible — Peut continuer la route</option>
                        <option value="moyenne">Moyenne — Risque de sécurité</option>
                        <option value="critique">Critique — Arrêt immédiat nécessaire</option>
                    </select>
                    @error('gravite')
                        <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('driver.dashboard') }}"
               class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:-translate-y-0.5">
                Annuler
            </a>
            <button type="submit"
                    class="rounded-xl bg-red-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-red-700 hover:-translate-y-0.5">
                <i class="bi bi-exclamation-triangle-fill mr-1.5"></i>Signaler la panne
            </button>
        </div>
    </form>
</div>
@endsection
