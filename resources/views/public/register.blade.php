@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<section class="section-padding" style="padding-top: 120px; min-height: calc(100vh - 80px); display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card-custom p-5" data-aos="fade-up">
                    <div class="text-center mb-5">
                        <i class="bi bi-person-plus-fill text-blue-primary fs-1 mb-3"></i>
                        <h1 class="display-6 fw-bold text-blue-dark mb-2">Inscription</h1>
                        <p class="text-muted">Créez votre compte AutoPark</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label text-blue-dark">Nom</label>
                                <input type="text" class="form-input-custom" id="nom" name="nom" placeholder="Votre nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label text-blue-dark">Prénom</label>
                                <input type="text" class="form-input-custom" id="prenom" name="prenom" placeholder="Votre prénom" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-blue-dark">Email</label>
                            <input type="email" class="form-input-custom" id="email" name="email" placeholder="votre@email.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label text-blue-dark">Téléphone</label>
                            <input type="tel" class="form-input-custom" id="telephone" name="telephone" placeholder="+226 70 00 00 00">
                        </div>

                        <div class="mb-3">
                            <label for="mot_de_passe" class="form-label text-blue-dark">Mot de passe</label>
                            <input type="password" class="form-input-custom" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required minlength="6">
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 mb-4">
                            S'inscrire
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted mb-0">
                            Déjà inscrit ?
                            <a href="{{ route('login') }}" class="text-blue-primary text-decoration-none fw-semibold">Se connecter</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection