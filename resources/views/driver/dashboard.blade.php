@extends('driver.layout')

@section('title', 'Tableau de bord')

@section('content')
@php
    $currentMission ??= null;
    $vehicule = $currentMission?->vehicule ?? null;
    $stats = $stats ?? [];
    $missionsEnCours = $missionsEnCours ?? 0;
    $missionsAvenir = $missionsAvenir ?? 0;
    $bonsCount = $bonsCount ?? 0;
    $demandeCount = $demandeCount ?? 0;
    $recentBons = $recentBons ?? collect();
    $recentDemandes = $recentDemandes ?? collect();
    $notificationsList = $notificationsList ?? [];
    $unreadNotifications = $unreadNotifications ?? 0;
    $nextMaintenance = $nextMaintenance ?? null;
    $fuelPercent = $fuelPercent ?? 0;
    $fuelSubtitle = $stats['fuel_subtitle'] ?? null;
    $maintenanceDate = $stats['maintenance_date'] ?? null;
    $maintenanceLabel = $stats['maintenance_label'] ?? null;
    $nextMissionDate = $stats['next_mission_date'] ?? null;
    $nextMissionDest = $stats['next_mission_destination'] ?? null;
@endphp

{{-- En-tête --}}
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
    <div class="space-y-1">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-50 text-primary-600 ring-1 ring-primary-100">
                <i class="bi bi-speedometer2 text-xl"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tableau de bord</h1>
        </div>
        <p class="text-sm text-slate-500 ml-[52px]">Bienvenue dans votre espace conducteur</p>
    </div>
    <div class="flex items-center gap-2.5 text-sm text-slate-500 ml-[52px] sm:ml-0">
        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v12a2 2 0 002 2z" />
        </svg>
        <span class="font-semibold">{{ \Carbon\Carbon::now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</span>
    </div>
</div>

{{-- Cartes statistiques --}}
<div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <a href="{{ route('driver.missions.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:border-blue-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Missions en cours</p>
                <p class="mt-2 text-4xl font-extrabold text-slate-900">{{ $missionsEnCours }}</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 ring-1 ring-blue-100 transition-colors group-hover:bg-blue-100">
                <i class="bi bi-lightning text-lg text-blue-600"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1 text-xs font-bold text-primary-600">
            Voir toutes
            <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <a href="{{ route('driver.missions.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:border-amber-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Missions à venir</p>
                <p class="mt-2 text-4xl font-extrabold text-slate-900">{{ $missionsAvenir }}</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 ring-1 ring-amber-100 transition-colors group-hover:bg-amber-100">
                <i class="bi bi-clock text-lg text-amber-600"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1 text-xs font-bold text-primary-600">
            Voir toutes
            <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <a href="{{ route('driver.bons-sortie.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:border-emerald-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Bons de sortie</p>
                <p class="mt-2 text-4xl font-extrabold text-slate-900">{{ $bonsCount }}</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 ring-1 ring-emerald-100 transition-colors group-hover:bg-emerald-100">
                <i class="bi bi-file-earmark-text text-lg text-emerald-600"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1 text-xs font-bold text-primary-600">
            Voir tous
            <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <a href="{{ route('driver.demandes.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:border-violet-200 hover:shadow-md hover:-translate-y-0.5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Demandes en attente</p>
                <p class="mt-2 text-4xl font-extrabold text-slate-900">{{ $demandeCount }}</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 ring-1 ring-violet-100 transition-colors group-hover:bg-violet-100">
                <i class="bi bi-inbox text-lg text-violet-600"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1 text-xs font-bold text-primary-600">
            Voir toutes
            <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    {{-- Colonne principale --}}
    <div class="lg:col-span-2 space-y-6">
        @if ($currentMission)
            <div class="overflow-hidden rounded-2xl border border-primary-200 bg-gradient-to-br from-primary-600 via-primary-500 to-blue-600 shadow-lg transition-all duration-300 hover:shadow-xl">
                <div class="p-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex-1">
                            <div class="mb-3 flex flex-wrap items-center gap-2">
                                <span class="inline-flex items-center gap-2 rounded-full bg-white/20 px-3 py-1.5 text-xs font-bold text-white ring-1 ring-white/30">
                                    <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-white"></span>
                                    Mission en cours
                                </span>
                                @php
                                    $statusClasses = [
                                        'planifiee' => 'bg-blue-100 text-blue-700 ring-1 ring-blue-200',
                                        'en_cours'  => 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-200',
                                        'terminee'  => 'bg-slate-100 text-slate-600 ring-1 ring-slate-200',
                                        'annulee'   => 'bg-red-100 text-red-700 ring-1 ring-red-200',
                                    ];
                                    $statusClass = $statusClasses[$currentMission->statut] ?? 'bg-white/20 text-white ring-white/30';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-bold ring-1 {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $currentMission->statut)) }}
                                </span>
                            </div>
                            <h2 class="text-xl font-extrabold text-white">{{ $currentMission->destination }}</h2>
                            <p class="mt-1 text-sm text-white/80">
                                Départ : {{ \Carbon\Carbon::parse($currentMission->date_depart)->locale('fr')->isoFormat('D MMM YYYY à HH:mm') }}
                            </p>

                            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-3">
                                <div class="flex items-center gap-2.5 rounded-xl bg-white/10 p-2.5 text-sm text-white ring-1 ring-white/20">
                                    <i class="bi bi-calendar3 text-white/80"></i>
                                    <span class="font-semibold">{{ \Carbon\Carbon::parse($currentMission->date_depart)->locale('fr')->isoFormat('D MMM YYYY') }}</span>
                                </div>
                                @if ($vehicule)
                                    <div class="flex items-center gap-2.5 rounded-xl bg-white/10 p-2.5 text-sm text-white ring-1 ring-white/20">
                                        <i class="bi bi-car-front text-white/80"></i>
                                        <span class="font-semibold">{{ $vehicule->immatriculation }}</span>
                                    </div>
                                @endif
                                <div class="flex items-center gap-2.5 rounded-xl bg-white/10 p-2.5 text-sm text-white ring-1 ring-white/20">
                                    <i class="bi bi-geo-alt text-white/80"></i>
                                    <span class="font-semibold">{{ $currentMission->distance_km ?? '—' }} km</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2.5 sm:flex-row lg:flex-col xl:flex-row">
                            <a href="{{ route('driver.missions.show', $currentMission->id_mission ?? $currentMission->id) }}"
                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-primary-700 shadow-sm transition hover:bg-primary-50">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Voir détails
                            </a>
                            <a href="{{ route('driver.missions.index') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-white/10 px-5 py-2.5 text-sm font-bold text-white ring-1 ring-white/30 transition hover:bg-white/20">
                                Toutes les missions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Dernières activités --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-100 p-5">
                <h2 class="text-base font-extrabold text-slate-900">Dernières activités</h2>
                <a href="{{ route('driver.missions.index') }}" class="text-xs font-bold text-primary-600 transition hover:underline">Voir tout</a>
            </div>
            <div class="p-5">
                <div class="space-y-3">
                    @if ($recentBons->count() > 0)
                        @foreach ($recentBons as $bon)
                            <div class="flex items-center justify-between rounded-xl border border-slate-100 p-4 transition hover:border-primary-200 hover:bg-primary-50/30">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-blue-50">
                                        <i class="bi bi-car-front text-blue-600 text-base"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ $bon->vehicule->immatriculation ?? 'Véhicule' }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5">{{ \Carbon\Carbon::parse($bon->date_sortie)->locale('fr')->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @php
                                    $badge = match($bon->statut) {
                                        'valide'   => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
                                        'en_cours' => 'bg-blue-100 text-blue-700 ring-blue-200',
                                        default    => 'bg-slate-100 text-slate-600 ring-slate-200',
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $badge }}">
                                    <span class="h-1.5 w-1.5 rounded-full bg-current opacity-60"></span>
                                    {{ ucfirst($bon->statut ?? '—') }}
                                </span>
                            </div>
                        @endforeach
                    @else
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 mb-3">
                                <i class="bi bi-journal-text text-xl"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900">Aucune activité récente</h3>
                            <p class="text-xs text-slate-500 mt-1.5 max-w-[260px]">Vos activités apparaîtront ici.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Mon véhicule --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-100 p-5">
                <h2 class="text-base font-extrabold text-slate-900">Mon véhicule</h2>
                @if ($vehicule)
                    <a href="{{ route('driver.vehicule') }}" class="text-xs font-bold text-primary-600 transition hover:underline">Voir détails</a>
                @endif
            </div>
            <div class="p-5">
                @if ($vehicule)
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-primary-50 ring-1 ring-primary-100">
                            <i class="bi bi-car-front-fill text-primary-600 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-lg font-extrabold text-slate-900">{{ $vehicule->immatriculation ?? '—' }}</p>
                            <p class="text-sm text-slate-500 mt-0.5">{{ $vehicule->marque ?? '' }} {{ $vehicule->modele ?? '' }}</p>
                            @if (!empty($stats['vehicule_details']))
                                <p class="text-xs text-slate-400 mt-1">{{ $stats['vehicule_details'] }}</p>
                            @endif
                        </div>
                        <span class="self-start inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                            {{ $vehicule->statut ?? 'Actif' }}
                        </span>
                    </div>
                    @php
                        $km = $vehicule->kilometrage ?? 0;
                        $prochMaintenance = $nextMaintenance ? \Carbon\Carbon::parse($nextMaintenance->prochaine_echeance) : null;
                        $joursRestants = $prochMaintenance ? now()->diffInDays($prochMaintenance, false) : null;
                        $urgence = $joursRestants !== null && $joursRestants < 7;
                    @endphp
                    <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Kilométrage actuel</p>
                            <p class="text-sm font-extrabold text-slate-900 mt-1">{{ number_format($km) }} km</p>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Prochaine maintenance</p>
                            <p class="text-sm font-extrabold text-slate-900 mt-1">
                                {{ $maintenanceDate ? \Carbon\Carbon::parse($maintenanceDate)->locale('fr')->isoFormat('D MMM YYYY') : 'Non planifiée' }}
                            </p>
                            @if ($urgence)
                                <p class="text-[10px] font-bold text-red-600 mt-1">Urgent — dans {{ max(0, $joursRestants) }} jours</p>
                            @elseif ($joursRestants !== null)
                                <p class="text-[10px] font-bold text-amber-600 mt-1">Dans {{ $joursRestants }} jours</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-10 text-center">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 mb-3">
                            <i class="bi bi-car-front text-xl"></i>
                        </div>
                        <p class="text-sm font-semibold text-slate-500">Aucun véhicule actuellement affecté</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Colonne latérale --}}
    <div class="space-y-6">
        {{-- Info carburant --}}
        @if ($vehicule && $fuelPercent > 0)
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-extrabold text-slate-900">Niveau carburant</h3>
                    <span class="text-xs font-bold text-slate-500">{{ $fuelSubtitle ?? '' }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-3 rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500 {{ $fuelPercent < 20 ? 'bg-red-500' : ($fuelPercent < 50 ? 'bg-amber-500' : 'bg-emerald-500') }}"
                             style="width: {{ $fuelPercent }}%"></div>
                    </div>
                    <span class="text-xs font-extrabold text-slate-700 w-10 text-right">{{ $fuelPercent }}%</span>
                </div>
            </div>
        @endif

        {{-- Actions rapides --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 p-5">
                <h2 class="text-base font-extrabold text-slate-900">Actions rapides</h2>
            </div>
            <div class="p-2 space-y-0.5">
                <a href="{{ route('driver.missions.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 group">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="bi bi-list-task text-sm"></i>
                    </span>
                    <span class="flex-1">Mes missions</span>
                    <svg class="h-4 w-4 text-slate-400 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="{{ route('driver.demandes.create') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 group">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <i class="bi bi-plus-circle text-sm"></i>
                    </span>
                    <span class="flex-1">Nouvelle demande</span>
                    <svg class="h-4 w-4 text-slate-400 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="{{ route('driver.panne') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 group">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                        <i class="bi bi-wrench text-sm"></i>
                    </span>
                    <span class="flex-1">Signaler panne</span>
                    <svg class="h-4 w-4 text-slate-400 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="{{ route('driver.historique') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 group">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-violet-50 text-violet-600">
                        <i class="bi bi-journal-text text-sm"></i>
                    </span>
                    <span class="flex-1">Historique</span>
                    <svg class="h-4 w-4 text-slate-400 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Notifications --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-100 p-5">
                <h2 class="text-base font-extrabold text-slate-900">Notifications</h2>
                @if ($unreadNotifications > 0)
                    <span class="inline-flex h-5 min-w-[20px] items-center justify-center rounded-full bg-red-500 px-1.5 text-[11px] font-extrabold text-white">{{ $unreadNotifications }}</span>
                @endif
            </div>
            <div class="p-5">
                <div class="space-y-3.5">
                    @if (count($notificationsList) > 0)
                        @foreach (array_slice($notificationsList, 0, 4) as $notification)
                            @php
                                $icon = $notification['icon'] ?? '';
                                $tone = $notification['tone'] ?? 'bg-slate-100 text-slate-600';
                                $title = $notification['title'] ?? 'Notification';
                                $date = $notification['date'] ?? '—';
                            @endphp
                            <div class="flex items-start gap-3">
                                @if ($icon)
                                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full {{ $tone }}">
                                        {!! $icon !!}
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ $title }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $date }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex flex-col items-center justify-center py-8 text-center">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 mb-2">
                                <i class="bi bi-bell-slash text-lg"></i>
                            </div>
                            <p class="text-xs font-semibold text-slate-500">Aucune notification</p>
                        </div>
                    @endif
                </div>
                @if (count($notificationsList) > 0)
                    <a href="{{ route('driver.notifications.index') }}" class="mt-4 block text-center text-xs font-bold text-primary-600 transition hover:underline">
                        Voir toutes les notifications
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
