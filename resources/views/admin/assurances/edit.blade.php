@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Modifier assurance</h1><p class="text-slate-500 text-sm mt-1">{{ $assurance->compagnie }} — {{ $assurance->numero_contrat }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <form method="POST" action="{{ route('admin.assurances.update', $assurance) }}" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Véhicule</label>
                <select name="id_vehicule" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach($vehicules as $v)
                        <option value="{{ $v->id_vehicule }}" @selected(old('id_vehicule', $assurance->id_vehicule) == $v->id_vehicule)>{{ $v->immatriculation }} — {{ $v->marque }} {{ $v->modele }}</option>
                    @endforeach
                </select>
                @error('id_vehicule')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Compagnie</label>
                <input type="text" name="compagnie" value="{{ old('compagnie', $assurance->compagnie) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('compagnie')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">N° contrat</label>
                <input type="text" name="numero_contrat" value="{{ old('numero_contrat', $assurance->numero_contrat) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('numero_contrat')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Coût (FCFA)</label>
                <input type="number" name="cout" value="{{ old('cout', $assurance->cout) }}" step="0.01" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required min="0">
                @error('cout')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date début</label>
                <input type="date" name="date_debut" value="{{ old('date_debut', $assurance->date_debut) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_debut')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date fin</label>
                <input type="date" name="date_fin" value="{{ old('date_fin', $assurance->date_fin) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_fin')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Type assurance</label>
                <select name="type_assurance" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach(\App\Models\Assurance::TYPES as $t)
                        <option value="{{ $t }}" @selected(old('type_assurance', $assurance->type_assurance) == $t)>{{ str_replace('_', ' ', $t) }}</option>
                    @endforeach
                </select>
                @error('type_assurance')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800"><i class="bi bi-check-lg"></i> Mettre à jour</button>
            <a href="{{ route('admin.assurances.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">Annuler</a>
        </div>
    </form>
</div>
@endsection
