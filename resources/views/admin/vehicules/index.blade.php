@extends('admin.layout')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Véhicules</h1>
        <p class="text-slate-500 text-sm mt-1">{{ $vehicules->count() }} véhicule(s) dans le parc</p>
    </div>
    <a href="{{ route('admin.vehicules.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 active:bg-primary-800">
        <i class="bi bi-plus-lg"></i> Nouveau véhicule
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    @forelse($vehicules as $v)
    <div class="group rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden transition hover:shadow-md hover:border-primary-200">
        {{-- Photo --}}
        <div class="relative h-44 bg-slate-100 overflow-hidden">
            @if($v->photo_path)
                <img src="{{ asset('storage/' . $v->photo_path) }}" alt="{{ $v->marque }} {{ $v->modele }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
            @else
                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white shadow-sm">
                        <i class="bi bi-car-front text-3xl text-slate-400"></i>
                    </div>
                </div>
            @endif
            {{-- Status badge --}}
            <span class="absolute top-3 right-3 inline-flex items-center rounded-lg border border-white/20 bg-white/90 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide backdrop-blur-sm
                {{ $v->statut === 'disponible' ? 'text-emerald-700' : '' }}
                {{ $v->statut === 'en_mission' ? 'text-blue-700' : '' }}
                {{ $v->statut === 'en_maintenance' ? 'text-amber-700' : '' }}
                {{ $v->statut === 'hors_service' ? 'text-red-700' : '' }}">
                {{ str_replace('_', ' ', $v->statut) }}
            </span>
        </div>

        {{-- Body --}}
        <div class="p-4">
            <h3 class="text-sm font-bold text-slate-900 truncate">{{ $v->marque }} {{ $v->modele }}</h3>
            <p class="text-xs text-slate-500 mt-0.5 font-mono">{{ $v->immatriculation }}</p>

            <div class="mt-3 flex items-center gap-3 text-[11px] text-slate-500">
                <span class="inline-flex items-center gap-1">
                    <i class="bi bi-calendar3"></i> {{ $v->annee }}
                </span>
                <span class="inline-flex items-center gap-1">
                    <i class="bi bi-fuel-pump"></i> {{ ucfirst($v->carburant) }}
                </span>
            </div>
            <div class="mt-1 flex items-center gap-3 text-[11px] text-slate-500">
                <span class="inline-flex items-center gap-1">
                    <i class="bi bi-speedometer2"></i> {{ number_format($v->kilometrage, 0, ',', ' ') }} km
                </span>
                <span class="inline-flex items-center gap-1">
                    <i class="bi bi-palette2"></i> {{ $v->couleur ?? '—' }}
                </span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="border-t border-slate-100 bg-slate-50/50 px-4 py-3 flex items-center justify-between">
            <a href="{{ route('admin.vehicules.show', $v) }}" class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-[11px] font-bold text-slate-600 hover:bg-white hover:shadow-sm transition">
                <i class="bi bi-eye"></i> Détail
            </a>
            <div class="flex items-center gap-1">
                <a href="{{ route('admin.vehicules.edit', $v) }}" class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-[11px] font-bold text-primary-700 hover:bg-primary-50 transition">
                    <i class="bi bi-pencil-square"></i> Modifier
                </a>
                <form method="POST" action="{{ route('admin.vehicules.destroy', $v) }}" class="inline" onsubmit="return confirm('Supprimer ce véhicule ?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-[11px] font-bold text-red-600 hover:bg-red-50 transition">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-12 text-center">
            <i class="bi bi-car-front text-slate-300 text-5xl mb-4 block"></i>
            <p class="text-slate-500 text-sm font-medium">Aucun véhicule enregistré dans le parc.</p>
            <a href="{{ route('admin.vehicules.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-700 mt-4">
                <i class="bi bi-plus-lg"></i> Ajouter un véhicule
            </a>
        </div>
    </div>
    @endforelse
</div>
@endsection
