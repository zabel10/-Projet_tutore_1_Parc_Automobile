@extends('admin.layout')

@section('title', 'Tableau de bord')

@section('content')
{{-- Stats Cards --}}
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
    @php
        $statCards = [
            ['label' => 'Total véhicules',           'value' => $stats['total_vehicules'] ?? 0,              'icon' => 'bi-car-front',       'color' => 'from-blue-500 to-blue-600'],
            ['label' => 'Disponibles',               'value' => $stats['vehicules_disponibles'] ?? 0,        'icon' => 'bi-check-circle',    'color' => 'from-emerald-500 to-emerald-600'],
            ['label' => 'En maintenance',            'value' => $stats['vehicules_en_maintenance'] ?? 0,     'icon' => 'bi-tools',           'color' => 'from-amber-500 to-amber-600'],
            ['label' => 'Missions en cours',         'value' => $stats['missions_en_cours'] ?? 0,            'icon' => 'bi-map',             'color' => 'from-indigo-500 to-indigo-600'],
            ['label' => 'Chauffeurs actifs',         'value' => $stats['conducteurs_actifs'] ?? 0,           'icon' => 'bi-people',          'color' => 'from-cyan-500 to-cyan-600'],
            ['label' => 'Réservations du jour',      'value' => $stats['reservations_aujourdhui'] ?? 0,      'icon' => 'bi-calendar3',       'color' => 'from-rose-500 to-rose-600'],
        ];
    @endphp

    @foreach($statCards as $card)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 flex items-center gap-3">
            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br {{ $card['color'] }} text-white shadow-sm">
                <i class="bi {{ $card['icon'] }} text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide truncate">{{ $card['label'] }}</p>
                <p class="text-xl font-extrabold text-slate-900 leading-tight">{{ number_format($card['value']) }}</p>
            </div>
        </div>
    @endforeach
</div>

{{-- Charts Row --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <h3 class="text-sm font-bold text-slate-900 mb-4">Évolution des missions</h3>
        <div class="shimmer h-48 rounded-xl"></div>
        <p class="text-[10px] text-slate-400 mt-2 text-center">Chart: Line chart missions par mois</p>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <h3 class="text-sm font-bold text-slate-900 mb-4">Utilisation des véhicules</h3>
        <div class="shimmer h-48 rounded-xl"></div>
        <p class="text-[10px] text-slate-400 mt-2 text-center">Chart: Doughnut chart statuts</p>
    </div>
</div>

{{-- Recent Activities --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100">
        <h3 class="text-sm font-bold text-slate-900">Activités récentes</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-semibold">
                <tr>
                    <th class="px-5 py-3 text-left">Utilisateur</th>
                    <th class="px-5 py-3 text-left">Action</th>
                    <th class="px-5 py-3 text-left">Date</th>
                    <th class="px-5 py-3 text-left">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($activites ?? [] as $activite)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-5 py-3 font-medium text-slate-900">{{ $activite['utilisateur'] ?? '—' }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ $activite['action'] ?? '—' }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $activite['date'] ?? '—' }}</td>
                        <td class="px-5 py-3">
                            @php
                                $statut = $activite['statut'] ?? 'info';
                                $badgeColors = [
                                    'success' => 'bg-emerald-100 text-emerald-700',
                                    'warning' => 'bg-amber-100 text-amber-700',
                                    'danger'  => 'bg-red-100 text-red-700',
                                    'primary' => 'bg-primary-100 text-primary-700',
                                    'info'    => 'bg-slate-100 text-slate-700',
                                ];
                                $badgeClass = $badgeColors[$statut] ?? $badgeColors['info'];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $badgeClass }}">
                                {{ ucfirst($statut) }}
                            </span>
                        </td>
                    </tr>
                @endforeach

                @if(empty($activites))
                    <tr>
                        <td colspan="4" class="px-5 py-6 text-center text-slate-400 text-sm">Aucune activité récente</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
