@extends('admin.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-black text-slate-900">Détail conducteur</h1>
    <p class="text-slate-500 text-sm mt-1">{{ $conducteur->utilisateur->prenom }} {{ $conducteur->utilisateur->nom }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            @if($conducteur->photo_path)
                <img src="{{ asset('storage/' . $conducteur->photo_path) }}" alt="{{ $conducteur->utilisateur->prenom }}" class="h-64 w-full object-cover">
            @else
                <div class="h-64 w-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                    <i class="bi bi-person text-slate-300 text-6xl"></i>
                </div>
            @endif
            <div class="p-4 border-t border-slate-100">
                <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-bold bg-primary-100 text-primary-700">Cat. {{ $conducteur->categorie_permis }}</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Nom</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $conducteur->utilisateur->nom }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Prénom</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $conducteur->utilisateur->prenom }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Email</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $conducteur->utilisateur->email }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Téléphone</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $conducteur->utilisateur->telephone ?? '—' }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">N° permis</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $conducteur->num_permis }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Catégorie</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ $conducteur->categorie_permis }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Date naissance</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($conducteur->date_naissance)->format('d/m/Y') }}</dd></div>
                <div><dt class="text-xs font-bold text-slate-500 uppercase">Expiration permis</dt><dd class="mt-1 text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($conducteur->date_expiration_permis)->format('d/m/Y') }}</dd></div>
            </dl>
        </div>
    </div>
</div>
@endsection
