@extends('admin.layout')

@section('title', 'Mon profil')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Mon profil</h1>
    <p class="text-slate-500 text-sm mt-1.5">Gérez vos informations personnelles et vos préférences</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{ editMode: false }">
    {{-- LEFT COLUMN — Identity Card --}}
    <div class="lg:col-span-1 space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="relative h-24 bg-gradient-to-br from-primary-500 to-primary-700">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.08%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
            </div>
            <div class="px-6 pb-6">
                <div class="relative -mt-10 mb-4">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 text-3xl font-black text-white uppercase shadow-lg ring-4 ring-white">
                        {{ substr((string)($utilisateur->prenom ?? 'U'), 0, 1) }}
                    </div>
                </div>
                <h2 class="text-xl font-bold text-slate-900">{{ $utilisateur->prenom }} {{ $utilisateur->nom ?? '' }}</h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ $utilisateur->email }}</p>
                <div class="mt-3 flex items-center gap-2">
                    <span class="inline-flex items-center rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-bold text-slate-600 uppercase tracking-wide">
                        {{ $utilisateur->role }}
                    </span>
                    <span class="inline-flex items-center rounded-lg border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                        <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Actif
                    </span>
                </div>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5">
            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Informations</h3>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-primary-50 text-primary-600">
                        <i class="bi bi-telephone text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] text-slate-400 uppercase font-semibold">Téléphone</p>
                        <p class="text-sm font-bold text-slate-900 truncate">{{ $utilisateur->telephone ?? 'Non renseigné' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <i class="bi bi-shield-check text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] text-slate-400 uppercase font-semibold">Rôle</p>
                        <p class="text-sm font-bold text-slate-900 capitalize">{{ $utilisateur->role }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i class="bi bi-calendar3 text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] text-slate-400 uppercase font-semibold">Inscription</p>
                        <p class="text-sm font-bold text-slate-900">{{ $utilisateur->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT COLUMN — Form --}}
    <div class="lg:col-span-2">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-4 flex items-center justify-between bg-slate-50/50">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Informations personnelles</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Modifiez vos coordonnées et votre mot de passe</p>
                </div>
                <button @click="editMode = !editMode" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 shadow-sm transition hover:bg-slate-50 active:bg-slate-100">
                    <i class="bi" :class="editMode ? 'bi-x-circle' : 'bi-pencil-square'"></i>
                    <span x-text="editMode ? 'Annuler' : 'Modifier'"></span>
                </button>
            </div>

            {{-- Read-only view --}}
            <div x-show="!editMode" x-transition class="p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4">
                        <dt class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Nom</dt>
                        <dd class="mt-1.5 text-sm font-bold text-slate-900">{{ $utilisateur->nom }}</dd>
                    </div>
                    <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4">
                        <dt class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Prénom</dt>
                        <dd class="mt-1.5 text-sm font-bold text-slate-900">{{ $utilisateur->prenom }}</dd>
                    </div>
                    <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4">
                        <dt class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Email</dt>
                        <dd class="mt-1.5 text-sm font-bold text-slate-900 break-all">{{ $utilisateur->email }}</dd>
                    </div>
                    <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4">
                        <dt class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Téléphone</dt>
                        <dd class="mt-1.5 text-sm font-bold text-slate-900">{{ $utilisateur->telephone ?? '—' }}</dd>
                    </div>
                </dl>
                <div class="mt-6 flex items-center gap-3">
                    <button @click="editMode = true" class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
                        <i class="bi bi-pencil-square"></i> Modifier mes informations
                    </button>
                </div>
            </div>

            {{-- Edit form --}}
            <div x-show="editMode" x-cloak x-transition class="p-6">
                <form method="POST" action="{{ route('admin.profil.update') }}" class="space-y-5">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nom</label>
                            <input type="text" name="nom" value="{{ old('nom', $utilisateur->nom) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                            @error('nom')<p class="text-red-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $utilisateur->prenom) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                            @error('prenom')<p class="text-red-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Email</label>
                            <input type="email" name="email" value="{{ old('email', $utilisateur->email) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" required>
                            @error('email')<p class="text-red-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Téléphone</label>
                            <input type="text" name="telephone" value="{{ old('telephone', $utilisateur->telephone) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition">
                            @error('telephone')<p class="text-red-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2 h-px bg-slate-100 my-2"></div>
                        <div class="sm:col-span-2">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Sécurité</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nouveau mot de passe</label>
                            <input type="password" name="mot_de_passe" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" minlength="8" placeholder="Laisser vide pour ne pas changer">
                            @error('mot_de_passe')<p class="text-red-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Confirmer mot de passe</label>
                            <input type="password" name="mot_de_passe_confirmation" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" minlength="8">
                        </div>
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
                            <i class="bi bi-check-lg"></i> Enregistrer
                        </button>
                        <button type="button" @click="editMode = false" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-xs font-bold text-slate-700 transition hover:bg-slate-50">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
