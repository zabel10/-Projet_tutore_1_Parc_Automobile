@extends('driver.layout')

@section('title', 'Mes documents - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-violet-600">Espace conducteur</p>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-2">Mes documents</h1>
                <p class="text-sm text-slate-500 mt-1">Gérez les documents liés à votre profil et aux véhicules affectés.</p>
            </div>
            <a href="{{ route('driver.documents.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-violet-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-violet-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Déposer un document
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Numéro</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Véhicule</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Expiration</th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($documents as $document)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-sm font-bold text-slate-900">{{ ucfirst(str_replace('_', ' ', $document->type_document)) }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $document->numero_document ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $document->vehicule?->immatriculation ?? 'Non affecté' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ optional($document->date_expiration)->locale('fr')->isoFormat('D MMM YYYY') ?? 'Non définie' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 ring-1 ring-amber-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                    En attente
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V9.75c0-.621.504-1.125-1.125-1.125H13.5a2.25 2.25 0 00-2.25 2.25v3.375" />
                                    </svg>
                                </div>
                                <h2 class="text-sm font-bold text-slate-700 mt-3">Aucun document déposé.</h2>
                                <p class="text-xs text-slate-500 mt-1">Déposez un document pour commencer l'historique.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($documents->hasPages())
        <div class="flex justify-center">
            {{ $documents->links() }}
        </div>
    @endif
</div>
@endsection
