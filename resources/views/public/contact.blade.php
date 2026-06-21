@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="py-20 bg-white" style="padding-top: 120px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-4">Contact</h1>
            <p class="text-slate-500 text-lg max-w-xl mx-auto">Contactez-nous pour obtenir plus d'informations sur notre solution de gestion de parc automobile.</p>
        </div>

        <div class="grid lg:grid-cols-5 gap-10">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Nos coordonnées</h2>
                    <div class="space-y-5">
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
            </div>

            <div class="lg:col-span-3">
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
