@extends('admin.layout')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Utilisateurs</h1>
        <p class="text-slate-500 text-sm mt-1">Gestion des comptes et accès</p>
    </div>
    <a href="{{ route('admin.utilisateurs.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
        <i class="bi bi-plus-lg"></i> Nouvel utilisateur
    </a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Utilisateur</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Rôle</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Téléphone</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Inscription</th>
                    <th class="px-5 py-3.5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($utilisateurs as $u)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-primary-500 to-primary-700 text-xs font-black text-white uppercase shadow-sm">
                                {{ substr((string)($u->prenom ?? 'U'), 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">{{ $u->prenom }} {{ $u->nom ?? '' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $u->email }}</td>
                    <td class="px-5 py-3.5">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold
                            {{ $u->role === 'admin' ? 'bg-primary-100 text-primary-700' : '' }}
                            {{ $u->role === 'gestionnaire' ? 'bg-emerald-100 text-emerald-700' : '' }}
                            {{ $u->role === 'conducteur' ? 'bg-amber-100 text-amber-700' : '' }}">
                            {{ $u->role }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $u->telephone ?? '—' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $u->created_at->format('d/m/Y') }}</td>
                    <td class="px-5 py-3.5 text-right whitespace-nowrap">
                        <a href="{{ route('admin.utilisateurs.show', $u) }}" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                            <i class="bi bi-eye"></i> Voir
                        </a>
                        <a href="{{ route('admin.utilisateurs.edit', $u) }}" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-primary-700 hover:bg-primary-50 transition">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <form method="POST" action="{{ route('admin.utilisateurs.destroy', $u) }}" class="inline" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50 transition">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-5 py-8 text-center text-slate-400">Aucun utilisateur enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
