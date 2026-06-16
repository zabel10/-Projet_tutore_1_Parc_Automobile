@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<section class="section-padding" style="padding-top: 140px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h1 class="display-4 fw-bold text-blue-dark mb-3">À propos d'AutoPark</h1>
                    <p class="text-muted fs-5">
                        AutoPark est une solution complète de gestion de parc automobile conçue pour les entreprises et organisations souhaitant optimiser la gestion de leurs véhicules, missions et coûts associés.
                    </p>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-custom p-4 h-100">
                            <div class="info-icon">
                                <i class="bi bi-car-front-fill"></i>
                            </div>
                            <h3 class="h5 text-blue-dark mb-3">Gestion du registre des véhicules</h3>
                            <p class="text-muted mb-0">Immatriculation, modèle, état, historique et suivi complet de chaque véhicule.</p>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-custom p-4 h-100">
                            <div class="info-icon">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                            <h3 class="h5 text-blue-dark mb-3">Planification et attribution des missions</h3>
                            <p class="text-muted mb-0">Gestion des demandes, validation des affectations et suivi des missions en cours.</p>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-custom p-4 h-100">
                            <div class="info-icon">
                                <i class="bi bi-wrench-adjustable-circle-fill"></i>
                            </div>
                            <h3 class="h5 text-blue-dark mb-3">Suivi des maintenances</h3>
                            <p class="text-muted mb-0">Contrôles techniques, entretiens préventifs, réparations et alertes d'échéance.</p>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-custom p-4 h-100">
                            <div class="info-icon">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <h3 class="h5 text-blue-dark mb-3">Statistiques et rapports</h3>
                            <p class="text-muted mb-0">Analyses détaillées des performances, consommations carburant et coûts associés.</p>
                        </div>
                    </div>
                </div>

                <div class="card-custom p-5" data-aos="fade-up">
                    <h2 class="h4 text-blue-dark mb-4">Pour qui ?</h2>
                    <p class="text-muted fs-5">
                        Administrateurs, gestionnaires de flotte, et conducteurs - chacun dispose d'un espace dédié pour accéder aux informations pertinentes selon son rôle.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection