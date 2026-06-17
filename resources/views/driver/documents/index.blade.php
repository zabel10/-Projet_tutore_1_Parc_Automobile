@extends('driver.layout')

@section('title', 'Mes documents - Gestion Parc Automobile')

@section('content')
<div class="space-y-6">
    <section class="rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-200/60 sm:p-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.08em] text-violet-600">Espace conducteur</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Mes documents</h1>
                <p class="mt-2 text-sm leading-6 text-slate-500">Gérez les documents liés à votre profil et aux véhicules affectés.</p>
            </div>
            <a href="{{ route('driver.documents.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-violet-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-violet-600/20 transition hover:-translate-y-0.5 hover:bg-violet-700 hover:shadow-md">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Déposer un document
            </a>
        </div>
    </section>

    <section class="driver-table-card overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-200/60">
        <div class="overflow-x-auto">
            <table class="driver-table min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-gradient-to-r from-slate-50 to-violet-50/60 text-left text-xs font-black uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3.5">Type</th>
                        <th class="px-4 py-3.5">Numéro</th>
                        <th class="px-4 py-3.5">Véhicule</th>
                        <th class="px-4 py-3.5">Expiration</th>
                        <th class="px-4 py-3.5">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($documents as $document)
                        <tr class="transition hover:bg-violet-50/35">
                            <td class="px-4 py-3.5 font-black text-slate-950">{{ ucfirst(str_replace('_', ' ', $document->type_document)) }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ $document->numero_document ?? '-' }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ $document->vehicule?->immatriculation ?? 'Non affecté' }}</td>
                            <td class="px-4 py-3.5 text-slate-600">{{ optional($document->date_expiration)->locale('fr')->isoFormat('D MMM YYYY') ?? 'Non définie' }}</td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-black text-amber-700 ring-1 ring-amber-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                    En attente
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V9.75c0-.621.504-1.125-1.125-1.125H13.5a2.25 2.25 0 00-2.25 2.25v3.375" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">Aucun document déposé.</p>
                                <p class="mt-1 text-xs text-slate-500">Déposez un document pour commencer l'historique.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @if ($documents->hasPages())
        <div class="flex justify-center">
            {{ $documents->links() }}
        </div>
    @endif
</div>
@endsection
