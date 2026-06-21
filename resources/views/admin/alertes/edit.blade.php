@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Modifier alerte</h1><p class="text-slate-500 text-sm mt-1">{{ $alerte->type_alerte }}</p></div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <form method="POST" action="{{ route('admin.alertes.update', $alerte) }}" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Véhicule</label>
                <select name="id_vehicule" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach($vehicules as $v)
                        <option value="{{ $v->id_vehicule }}" @selected(old('id_vehicule', $alerte->id_vehicule) == $v->id_vehicule)>{{ $v->immatriculation }} — {{ $v->marque }} {{ $v->modele }}</option>
                    @endforeach
                </select>
                @error('id_vehicule')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Type</label>
                <select name="type_alerte" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach(\App\Models\Alerte::TYPES as $t)
                        <option value="{{ $t }}" @selected(old('type_alerte', $alerte->type_alerte) == $t)>{{ str_replace('_', ' ', $t) }}</option>
                    @endforeach
                </select>
                @error('type_alerte')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Échéance</label>
                <input type="date" name="date_echeance" value="{{ old('date_echeance', $alerte->date_echeance) }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                @error('date_echeance')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                <select name="statut" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>
                    @foreach(\App\Models\Alerte::STATUTS as $s)
                        <option value="{{ $s }}" @selected(old('statut', $alerte->statut) == $s)>{{ $s }}</option>
                    @endforeach
                </select>
                @error('statut')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Message</label>
                <textarea name="message" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500" required>{{ old('message', $alerte->message) }}</textarea>
                @error('message')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800"><i class="bi bi-check-lg"></i> Mettre à jour</button>
            <a href="{{ route('admin.alertes.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">Annuler</a>
        </div>
    </form>
</div>
@endsection
