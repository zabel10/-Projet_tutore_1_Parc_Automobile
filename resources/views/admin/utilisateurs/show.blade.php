@extends('admin.layout')

@section('content')
<div class="mb-6"><h1 class="text-2xl font-black text-slate-900">Détail utilisateur</h1><p class="text-slate-500 text-sm mt-1">{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</p></div>

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="bg-slate-50 border-b border-slate-200 px-6 py-5 flex items-center gap-4">
        <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-primary-500 to-primary-700 text-xl font-black text-white uppercase shadow-sm">
            {{ substr((string)($utilisateur->prenom ?? 'U'), 0, 1) }}
        </div>
        <div>
            <h2 class="text-lg font-bold text-slate-900">{{ $utilisateur->prenom }} {{ $utilisateur->nom ?? '' }}</h2>
            <p class="text-sm text-slate-500">{{ $utilisateur->email }}</p>
            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold bg-primary-100 text-primary-700 mt-1">{{ $utilisateur->role }}</span>
        </div>
    </div>
    <div class="p-6">
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div><dt class="text-xs font-bold text-slate-500 uppercase">Nom</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $utilisateur->nom }}</dd></div>
            <div><dt class="text-xs font-bold text-slate-500 uppercase">Prénom</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $utilisateur->prenom }}</dd></div>
            <div><dt class="text-xs font-bold text-slate-500 uppercase">Email</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $utilisateur->email }}</dd></div>
            <div><dt class="text-xs font-bold text-slate-500 uppercase">Téléphone</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $utilisateur->telephone ?? '—' }}</dd></div>
            <div><dt class="text-xs font-bold text-slate-500 uppercase">Rôle</dt><dd class="mt-1 text-sm font-semibold text-slate-900 capitalize">{{ $utilisateur->role }}</dd></div>
            <div><dt class="text-xs font-bold text-slate-500 uppercase">Inscription</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $utilisateur->created_at->format('d/m/Y H:i') }}</dd></div>
        </dl>
        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
            <a href="{{ route('admin.utilisateurs.edit', $utilisateur) }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-4 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
                <i class="bi bi-pencil-square"></i> Modifier
            </a>
            <a href="{{ route('admin.utilisateurs.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2 text-xs font-bold text-slate-700 transition hover:bg-slate-50">
                Retour
            </a>
        </div>
    </div>
</div>
@endsection
