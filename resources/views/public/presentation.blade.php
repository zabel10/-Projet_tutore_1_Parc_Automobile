@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<section class="py-20 bg-white" style="padding-top: 120px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-5">À propos d'AutoPark</h1>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto">
                AutoPark est une solution complète de gestion de parc automobile conçue pour les entreprises et organisations souhaitant optimiser la gestion de leurs véhicules, missions et coûts associés.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-14">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-600 to-primary-700 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-primary-600/20">
                    <i class="bi bi-car-front-fill text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Gestion du registre des véhicules</h3>
                <p class="text-slate-500 text-sm">Immatriculation, modèle, état, historique et suivi complet de chaque véhicule.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-600 to-primary-700 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-primary-600/20">
                    <i class="bi bi-person-badge-fill text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Planification et attribution des missions</h3>
                <p class="text-slate-500 text-sm">Gestion des demandes, validation des affectations et suivi des missions en cours.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-amber-500/20">
                    <i class="bi bi-wrench-adjustable-circle-fill text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Suivi des maintenances</h3>
                <p class="text-slate-500 text-sm">Contrôles techniques, entretiens préventifs, réparations et alertes d'échéance.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-sky-500 to-sky-600 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-sky-500/20">
                    <i class="bi bi-graph-up-arrow text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Statistiques et rapports</h3>
                <p class="text-slate-500 text-sm">Analyses détaillées des performances, consommations carburant et coûts associés.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Pour qui ?</h2>
            <p class="text-slate-500 text-lg">Administrateurs, gestionnaires de flotte, et conducteurs — chacun dispose d'un espace dédié pour accéder aux informations pertinentes selon son rôle.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Maintenance" class="w-full h-52 object-cover">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600">
                            <i class="bi bi-wrench-adjustable-circle-fill text-lg"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Maintenance</h3>
                    </div>
                    <p class="text-slate-500 text-sm mb-4">Planifiez et suivez les entretiens préventifs et correctifs de votre flotte.</p>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Alertes d'échéance automatiques</li>
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Suivi des réparations et coûts</li>
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Historique complet par véhicule</li>
                    </ul>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Véhicule" class="w-full h-52 object-cover">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600">
                            <i class="bi bi-car-front-fill text-lg"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Véhicules</h3>
                    </div>
                    <p class="text-slate-500 text-sm mb-4">Gérez l'ensemble de votre parc : immatriculation, état et disponibilité.</p>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Registre complet des véhicules</li>
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Suivi du statut et de la localisation</li>
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Documents et assurances associés</li>
                    </ul>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Mission" class="w-full h-52 object-cover">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600">
                            <i class="bi bi-map-fill text-lg"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Missions</h3>
                    </div>
                    <p class="text-slate-500 text-sm mb-4">Planifiez et attribuez les missions aux chauffeurs en temps réel.</p>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Demandes et affectations</li>
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Suivi en temps réel des trajets</li>
                        <li class="flex items-start gap-2"><i class="bi bi-check-circle-fill text-primary-600 mt-0.5"></i>Bons de sortie et documents</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
