@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center overflow-hidden" id="hero">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900"></div>
    <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                    Gérez efficacement votre parc automobile depuis une plateforme unique.
                </h1>
                <p class="text-lg md:text-xl text-slate-300 mb-8 max-w-xl">
                    Suivez vos véhicules, chauffeurs, entretiens et consommations en temps réel pour optimiser vos coûts et améliorer votre productivité.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('login') }}" class="bg-primary-600 text-white rounded-xl px-6 py-3 text-sm font-bold hover:bg-primary-700 shadow-lg shadow-primary-600/30 transition inline-flex items-center gap-2">
                        Voir une démonstration <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#modules" class="border border-white/30 text-white rounded-xl px-6 py-3 text-sm font-bold hover:bg-white/10 transition inline-flex items-center gap-2">
                        Commencer maintenant <i class="bi bi-chevron-down"></i>
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl border border-white/20 p-4 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Flotte de véhicules" class="w-full rounded-2xl shadow-lg object-cover" style="max-height: 420px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-20 bg-white" id="features">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Pourquoi choisir notre solution ?</h2>
            <p class="text-slate-500 text-lg">Une plateforme complète pour simplifier la gestion de votre flotte</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-600 to-primary-700 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-primary-600/20">
                    <i class="bi bi-grid-1x2-fill text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Gestion centralisée</h3>
                <p class="text-slate-500 text-sm">Suivez tous vos véhicules au même endroit.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-emerald-600/20">
                    <i class="bi bi-piggy-bank-fill text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Réduction des coûts</h3>
                <p class="text-slate-500 text-sm">Contrôlez les dépenses liées au carburant et à la maintenance.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-amber-500/20">
                    <i class="bi bi-wrench-adjustable-circle-fill text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Suivi des entretiens</h3>
                <p class="text-slate-500 text-sm">Recevez des alertes avant les échéances.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-sky-500 to-sky-600 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-sky-500/20">
                    <i class="bi bi-bar-chart-fill text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Rapports détaillés</h3>
                <p class="text-slate-500 text-sm">Analysez les performances de votre flotte.</p>
            </div>
        </div>
    </div>
</section>

<!-- Solutions -->
<section class="py-20 bg-slate-50" id="modules">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Nos solutions phares</h2>
            <p class="text-slate-500 text-lg">Les piliers de la gestion moderne de votre parc automobile</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
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

<!-- Advantages -->
<section class="py-20 bg-white" id="advantages">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Avantages</h2>
            <p class="text-slate-500 text-lg">Les bénéfices concrets pour votre organisation</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 text-center">
                <div class="w-14 h-14 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 mx-auto mb-4">
                    <i class="bi bi-clock-fill text-2xl"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Gain de temps</h3>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 text-center">
                <div class="w-14 h-14 bg-primary-50 rounded-xl flex items-center justify-center text-primary-600 mx-auto mb-4">
                    <i class="bi bi-shield-check-fill text-2xl"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Réduction des erreurs administratives</h3>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 text-center">
                <div class="w-14 h-14 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 mx-auto mb-4">
                    <i class="bi bi-geo-alt-fill text-2xl"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Meilleure traçabilité</h3>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 text-center">
                <div class="w-14 h-14 bg-primary-50 rounded-xl flex items-center justify-center text-primary-600 mx-auto mb-4">
                    <i class="bi bi-graph-up-arrow text-2xl"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Décisions basées sur des données fiables</h3>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 text-center">
                <div class="w-14 h-14 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 mx-auto mb-4">
                    <i class="bi bi-shield-lock-fill text-2xl"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Sécurité renforcée</h3>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-20 bg-slate-50" id="testimonials">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Témoignages</h2>
            <p class="text-slate-500 text-lg">Ce que nos clients disent de nous</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <p class="text-slate-600 italic mb-6">« Grâce à cette solution, nous avons réduit les coûts de gestion de notre flotte de 20 %. »</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center text-white mr-4">
                        <i class="bi bi-person-fill text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">Directeur de flotte</h4>
                        <p class="text-slate-500 text-xs">Entreprise de transport</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <p class="text-slate-600 italic mb-6">« La gestion des entretiens est devenue beaucoup plus simple avec les alertes automatiques. »</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white mr-4">
                        <i class="bi bi-person-fill text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">Responsable maintenance</h4>
                        <p class="text-slate-500 text-xs">Organisation publique</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <p class="text-slate-600 italic mb-6">« Nous avons gagné un temps précieux dans la gestion des demandes d'emprunt. »</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center text-white mr-4">
                        <i class="bi bi-person-fill text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">Gestionnaire de parc</h4>
                        <p class="text-slate-500 text-xs">Société privée</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-gradient-to-br from-slate-900 via-primary-900 to-slate-900 text-white text-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-6">Simplifiez dès aujourd'hui la gestion de votre parc automobile.</h2>
        <p class="text-slate-300 text-lg mb-8">Découvrez comment AutoPark peut transformer la gestion de votre flotte.</p>
        <a href="{{ route('contact.index') }}" class="bg-amber-500 text-white rounded-xl px-8 py-3.5 text-sm font-bold hover:bg-amber-600 shadow-lg shadow-amber-500/30 transition inline-flex items-center gap-2">
            Demander une démonstration <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>

<!-- Contact -->
<section class="py-20 bg-white" id="contact">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Contactez-nous</h2>
                <p class="text-slate-500 text-lg mb-8">Remplissez le formulaire ci-dessous pour obtenir plus d'informations sur notre solution.</p>

                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600 shrink-0">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Adresse</h4>
                            <p class="text-slate-500 text-sm">Ouagadougou, Burkina Faso</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600 shrink-0">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Téléphone</h4>
                            <p class="text-slate-500 text-sm">+226 70 00 00 00</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600 shrink-0">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Email</h4>
                            <p class="text-slate-500 text-sm">contact@autopark.bf</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="nom" class="block text-sm font-semibold text-slate-700 mb-1.5">Nom</label>
                                <input type="text" class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm" id="nom" name="nom" placeholder="Votre nom" required>
                            </div>
                            <div>
                                <label for="organisation" class="block text-sm font-semibold text-slate-700 mb-1.5">Organisation</label>
                                <input type="text" class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm" id="organisation" name="organisation" placeholder="Votre organisation" required>
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                                <input type="email" class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm" id="email" name="email" placeholder="votre@email.com" required>
                            </div>
                            <div>
                                <label for="telephone" class="block text-sm font-semibold text-slate-700 mb-1.5">Téléphone</label>
                                <input type="tel" class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm" id="telephone" name="telephone" placeholder="+226 70 00 00 00" required>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="message" class="block text-sm font-semibold text-slate-700 mb-1.5">Message</label>
                            <textarea class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm" id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary-600 text-white rounded-xl px-6 py-3.5 text-sm font-bold hover:bg-primary-700 shadow-lg shadow-primary-600/20 transition">
                            Envoyer le message <i class="bi bi-send-fill ml-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
