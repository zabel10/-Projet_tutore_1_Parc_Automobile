@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<section class="section-padding" style="padding-top: 120px; min-height: calc(100vh - 80px); display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card-custom p-5" data-aos="fade-up">
                    <div class="text-center mb-5">
                        <i class="bi bi-car-front-fill text-blue-primary fs-1 mb-3"></i>
                        <h1 class="display-6 fw-bold text-blue-dark mb-2">Connexion</h1>
                        <p class="text-muted">Accédez à votre espace AutoPark</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label text-blue-dark">Email</label>
                            <input type="email" class="form-input-custom" id="email" name="email" placeholder="votre@email.com" required>
                        </div>

                        <div class="mb-4">
                            <label for="mot_de_passe" class="form-label text-blue-dark">Mot de passe</label>
                            <input type="password" class="form-input-custom" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required>
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 mb-4">
                            Se connecter
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted mb-0">
                            Pas encore inscrit ?
                            <a href="{{ route('register') }}" class="text-blue-primary text-decoration-none fw-semibold">Créer un compte</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection