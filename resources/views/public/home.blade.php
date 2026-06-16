@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="hero-background" style="background-image: url('https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');"></div>
    <div class="hero-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="text-white" data-aos="fade-up">
                    <h1 class="hero-title display-3 fw-bold mb-4">
                        Gérez efficacement votre parc automobile depuis une plateforme unique.
                    </h1>
                    <p class="hero-subtitle fs-4 mb-5" style="max-width: 700px;">
                        Suivez vos véhicules, chauffeurs, entretiens et consommations en temps réel pour optimiser vos coûts et améliorer votre productivité.
                    </p>
                    <div class="d-flex gap-3 justify-content-lg-start justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">
                            Voir une démonstration
                        </a>
                        <a href="#modules" class="btn btn-outline-custom">
                            Commencer maintenant
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5" data-aos="fade-left">
                <div class="card-custom p-4">
                    <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Flotte de véhicules" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pourquoi choisir notre solution ? -->
<section class="section-padding bg-white" id="features">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-blue-dark mb-3">Pourquoi choisir notre solution ?</h2>
            <p class="text-muted fs-5">Une plateforme complète pour simplifier la gestion de votre flotte</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card-custom p-4 h-100">
                    <div class="info-icon">
                        <i class="bi bi-grid-1x2-fill"></i>
                    </div>
                    <h3 class="h5 text-blue-dark mb-3">Gestion centralisée</h3>
                    <p class="text-muted mb-0">Suivez tous vos véhicules au même endroit.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card-custom p-4 h-100">
                    <div class="info-icon">
                        <i class="bi bi-piggy-bank-fill"></i>
                    </div>
                    <h3 class="h5 text-blue-dark mb-3">Réduction des coûts</h3>
                    <p class="text-muted mb-0">Contrôlez les dépenses liées au carburant et à la maintenance.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card-custom p-4 h-100">
                    <div class="info-icon">
                        <i class="bi bi-wrench-adjustable-circle-fill"></i>
                    </div>
                    <h3 class="h5 text-blue-dark mb-3">Suivi des entretiens</h3>
                    <p class="text-muted mb-0">Recevez des alertes avant les échéances.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card-custom p-4 h-100">
                    <div class="info-icon">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <h3 class="h5 text-blue-dark mb-3">Rapports détaillés</h3>
                    <p class="text-muted mb-0">Analysez les performances de votre flotte.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modules de la plateforme -->
<section class="section-padding" id="modules">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-blue-dark mb-3">Modules de la plateforme</h2>
            <p class="text-muted fs-5">Tous les outils nécessaires pour gérer votre parc automobile</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="info-icon me-3 mb-0">
                            <i class="bi bi-car-front-fill"></i>
                        </div>
                        <h3 class="h5 text-blue-dark mb-0">Gestion des véhicules</h3>
                    </div>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Immatriculation</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>État des véhicules</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Historique</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="info-icon me-3 mb-0">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <h3 class="h5 text-blue-dark mb-0">Gestion des chauffeurs</h3>
                    </div>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Affectations</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Permis</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Disponibilités</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="info-icon me-3 mb-0">
                            <i class="bi bi-map-fill"></i>
                        </div>
                        <h3 class="h5 text-blue-dark mb-0">Affectations</h3>
                    </div>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Attribution véhicule–chauffeur</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Suivi des missions</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="info-icon me-3 mb-0">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                        <h3 class="h5 text-blue-dark mb-0">Maintenance</h3>
                    </div>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Entretiens préventifs</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Réparations</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Alertes</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="700">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="info-icon me-3 mb-0">
                            <i class="bi bi-fuel-pump-fill"></i>
                        </div>
                        <h3 class="h5 text-blue-dark mb-0">Carburant</h3>
                    </div>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Suivi des consommations</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Coûts</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="800">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="info-icon me-3 mb-0">
                            <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        </div>
                        <h3 class="h5 text-blue-dark mb-0">Rapports</h3>
                    </div>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Statistiques</li>
                        <li><i class="bi bi-check-circle-fill text-blue-primary me-2"></i>Export PDF/Excel</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Avantages -->
<section class="section-padding bg-white" id="advantages">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-blue-dark mb-3">Avantages</h2>
            <p class="text-muted fs-5">Les bénéfices concrets pour votre organisation</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-custom p-4 text-center">
                    <i class="bi bi-clock-fill text-orange fs-1 mb-3"></i>
                    <h3 class="h5 text-blue-dark">Gain de temps</h3>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-custom p-4 text-center">
                    <i class="bi bi-shield-check-fill text-blue-primary fs-1 mb-3"></i>
                    <h3 class="h5 text-blue-dark">Réduction des erreurs administratives</h3>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-custom p-4 text-center">
                    <i class="bi bi-geo-alt-fill text-orange fs-1 mb-3"></i>
                    <h3 class="h5 text-blue-dark">Meilleure traçabilité</h3>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card-custom p-4 text-center">
                    <i class="bi bi-graph-up-arrow text-blue-primary fs-1 mb-3"></i>
                    <h3 class="h5 text-blue-dark">Décisions basées sur des données fiables</h3>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="card-custom p-4 text-center">
                    <i class="bi bi-shield-lock-fill text-orange fs-1 mb-3"></i>
                    <h3 class="h5 text-blue-dark">Sécurité renforcée</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages -->
<section class="section-padding" id="testimonials">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-blue-dark mb-3">Témoignages</h2>
            <p class="text-muted fs-5">Ce que nos clients disent de nous</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-custom p-4 h-100">
                    <p class="text-muted fst-italic">« Grâce à cette solution, nous avons réduit les coûts de gestion de notre flotte de 20 %. »</p>
                    <div class="d-flex align-items-center mt-4">
                        <div class="rounded-circle bg-blue-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <h4 class="h6 text-blue-dark mb-0">Directeur de flotte</h4>
                            <small class="text-muted">Entreprise de transport</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-custom p-4 h-100">
                    <p class="text-muted fst-italic">« La gestion des entretiens est devenue beaucoup plus simple avec les alertes automatiques. »</p>
                    <div class="d-flex align-items-center mt-4">
                        <div class="rounded-circle bg-orange text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <h4 class="h6 text-blue-dark mb-0">Responsable maintenance</h4>
                            <small class="text-muted">Organisation publique</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-custom p-4 h-100">
                    <p class="text-muted fst-italic">« Nous avons gagné un temps précieux dans la gestion des demandes d'emprunt. »</p>
                    <div class="d-flex align-items-center mt-4">
                        <div class="rounded-circle bg-blue-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <h4 class="h6 text-blue-dark mb-0">Gestionnaire de parc</h4>
                            <small class="text-muted">Société privée</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Appel à l'action -->
<section class="section-padding bg-blue-primary text-white text-center" style="background: linear-gradient(135deg, #0F172A 0%, #2563EB 100%);">
    <div class="container" data-aos="fade-up">
        <h2 class="display-5 fw-bold mb-4">Simplifiez dès aujourd'hui la gestion de votre parc automobile.</h2>
        <p class="fs-5 mb-4" style="max-width: 700px; margin: 0 auto 2rem;">
            Découvrez comment AutoPark peut transformer la gestion de votre flotte.
        </p>
        <a href="{{ route('contact.index') }}" class="btn btn-orange-custom btn-lg">
            Demander une démonstration
        </a>
    </div>
</section>

<!-- Contact -->
<section class="section-padding bg-white" id="contact">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="display-5 fw-bold text-blue-dark mb-4">Contactez-nous</h2>
                <p class="text-muted fs-5 mb-4">
                    Remplissez le formulaire ci-dessous pour obtenir plus d'informations sur notre solution.
                </p>
                
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-geo-alt-fill text-blue-primary fs-4 me-3"></i>
                    <div>
                        <h4 class="h6 text-blue-dark mb-0">Adresse</h4>
                        <p class="text-muted mb-0">Ouagadougou, Burkina Faso</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-telephone-fill text-blue-primary fs-4 me-3"></i>
                    <div>
                        <h4 class="h6 text-blue-dark mb-0">Téléphone</h4>
                        <p class="text-muted mb-0">+226 70 00 00 00</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center">
                    <i class="bi bi-envelope-fill text-blue-primary fs-4 me-3"></i>
                    <div>
                        <h4 class="h6 text-blue-dark mb-0">Email</h4>
                        <p class="text-muted mb-0">contact@autopark.bf</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="contact-form">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label text-blue-dark">Nom</label>
                                <input type="text" class="form-input-custom" id="nom" name="nom" placeholder="Votre nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="organisation" class="form-label text-blue-dark">Organisation</label>
                                <input type="text" class="form-input-custom" id="organisation" name="organisation" placeholder="Votre organisation" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label text-blue-dark">Email</label>
                                <input type="email" class="form-input-custom" id="email" name="email" placeholder="votre@email.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telephone" class="form-label text-blue-dark">Téléphone</label>
                                <input type="tel" class="form-input-custom" id="telephone" name="telephone" placeholder="+226 70 00 00 00" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label text-blue-dark">Message</label>
                                <textarea class="form-input-custom" id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom w-100">
                                    Envoyer le message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection