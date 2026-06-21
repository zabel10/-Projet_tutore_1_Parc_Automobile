@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Modifier utilisateur</h1><p class="text-slate-500 text-sm mt-1">{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</p></div>

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
    <form method="POST" action="{{ route('admin.utilisateurs.update', $utilisateur) }}" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nom</label>
                <input type="text" name="nom" value="{{ old('nom', $utilisateur->nom) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                @error('nom')<p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom', $utilisateur->prenom) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                @error('prenom')<p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Email</label>
                <input type="email" name="email" value="{{ old('email', $utilisateur->email) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                @error('email')<p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $utilisateur->telephone) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition">
                @error('telephone')<p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nouveau mot de passe</label>
                <input type="password" name="mot_de_passe" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" minlength="8" placeholder="Laisser vide pour ne pas changer">
                @error('mot_de_passe')<p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Confirmer mot de passe</label>
                <input type="password" name="mot_de_passe_confirmation" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" minlength="8">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Rôle</label>
                <select name="role" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                    <option value="admin" @selected(old('role', $utilisateur->role) === 'admin')>Admin</option>
                    <option value="gestionnaire" @selected(old('role', $utilisateur->role) === 'gestionnaire')>Gestionnaire</option>
                    <option value="conducteur" @selected(old('role', $utilisateur->role) === 'conducteur')>Conducteur</option>
                </select>
                @error('role')<p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
                <i class="bi bi-check-lg"></i> Mettre à jour
            </button>
            <a href="{{ route('admin.utilisateurs.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-xs font-bold text-slate-700 transition hover:bg-slate-50">Annuler</a>
        </div>
    </form>
</div>
@endsection
