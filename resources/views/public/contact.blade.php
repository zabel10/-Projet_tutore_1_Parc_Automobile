@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="section-padding" style="padding-top: 140px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h1 class="display-4 fw-bold text-blue-dark mb-3">Contact</h1>
                    <p class="text-muted fs-5">
                        Contactez-nous pour obtenir plus d'informations sur notre solution de gestion de parc automobile.
                    </p>
                </div>

                <div class="row g-5">
                    <div class="col-lg-5" data-aos="fade-right">
                        <div class="card-custom p-4 h-100">
                            <h2 class="h4 text-blue-dark mb-4">Nos coordonnées</h2>
                            <div class="d-flex align-items-center mb-4">
                                <i class="bi bi-geo-alt-fill text-blue-primary fs-4 me-3"></i>
                                <div>
                                    <h3 class="h6 text-blue-dark mb-0">Adresse</h3>
                                    <p class="text-muted mb-0">Ouagadougou, Burkina Faso</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <i class="bi bi-telephone-fill text-blue-primary fs-4 me-3"></i>
                                <div>
                                    <h3 class="h6 text-blue-dark mb-0">Téléphone</h3>
                                    <p class="text-muted mb-0">+226 70 00 00 00</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope-fill text-blue-primary fs-4 me-3"></i>
                                <div>
                                    <h3 class="h6 text-blue-dark mb-0">Email</h3>
                                    <p class="text-muted mb-0">contact@autopark.bf</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-left">
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
        </div>
    </div>
</section>
@endsection