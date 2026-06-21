<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AutoPark - Inscription</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            600: '#2563EB',
                            700: '#1D4ED8',
                            900: '#0F172A',
                        }
                    },
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .password-strength-bar { transition: width 0.3s ease, background-color 0.3s ease; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full mx-4">
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xl">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl flex items-center justify-center text-white mx-auto mb-5 shadow-lg shadow-primary-600/30">
                    <i class="bi bi-person-plus-fill text-3xl"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 mb-1">Inscription</h1>
                <p class="text-slate-500 text-sm">Créez votre compte AutoPark</p>
            </div>

            @if(session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 mb-5 flex items-start gap-2">
                    <i class="bi bi-check-circle-fill mt-0.5 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 mb-5">
                    <div class="flex items-start gap-2">
                        <i class="bi bi-exclamation-triangle-fill mt-0.5 shrink-0"></i>
                        <ul class="space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" autocomplete="off" id="registerForm">
                @csrf

                <div class="grid sm:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label for="nom" class="block text-sm font-semibold text-slate-700 mb-1.5">Nom</label>
                        <input
                            type="text"
                            class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm @error('nom') border-red-300 focus:border-red-500 focus:ring-red-100 @enderror"
                            id="nom"
                            name="nom"
                            placeholder="Votre nom"
                            value="{{ old('nom') }}"
                            required
                            maxlength="50"
                            pattern="[a-zA-ZÀ-ÖØ-öø-ÿ\s\-\']+"
                            autocomplete="family-name"
                        >
                        @error('nom')
                            <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="prenom" class="block text-sm font-semibold text-slate-700 mb-1.5">Prénom</label>
                        <input
                            type="text"
                            class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm @error('prenom') border-red-300 focus:border-red-500 focus:ring-red-100 @enderror"
                            id="prenom"
                            name="prenom"
                            placeholder="Votre prénom"
                            value="{{ old('prenom') }}"
                            required
                            maxlength="50"
                            pattern="[a-zA-ZÀ-ÖØ-öø-ÿ\s\-\']+"
                            autocomplete="given-name"
                        >
                        @error('prenom')
                            <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Adresse email</label>
                    <input
                        type="email"
                        class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm @error('email') border-red-300 focus:border-red-500 focus:ring-red-100 @enderror"
                        id="email"
                        name="email"
                        placeholder="votre@email.com"
                        value="{{ old('email') }}"
                        required
                        maxlength="100"
                        autocomplete="email"
                    >
                    @error('email')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="telephone" class="block text-sm font-semibold text-slate-700 mb-1.5">Téléphone</label>
                    <input
                        type="tel"
                        class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm @error('telephone') border-red-300 focus:border-red-500 focus:ring-red-100 @enderror"
                        id="telephone"
                        name="telephone"
                        placeholder="+226 70 00 00 00"
                        value="{{ old('telephone') }}"
                        maxlength="20"
                        autocomplete="tel"
                    >
                    @error('telephone')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="mot_de_passe" class="block text-sm font-semibold text-slate-700 mb-1.5">Mot de passe</label>
                    <input
                        type="password"
                        class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm @error('mot_de_passe') border-red-300 focus:border-red-500 focus:ring-red-100 @enderror"
                        id="mot_de_passe"
                        name="mot_de_passe"
                        placeholder="Minimum 4 caractères"
                        required
                        minlength="4"
                        autocomplete="new-password"
                    >
                    <div class="mt-2 h-1 bg-slate-100 rounded-full overflow-hidden">
                        <div id="passwordStrengthBar" class="password-strength-bar h-full w-0 bg-slate-300 rounded-full"></div>
                    </div>
                    <p id="passwordStrengthText" class="text-xs text-slate-400 mt-1"></p>
                    @error('mot_de_passe')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="mot_de_passe_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Confirmer le mot de passe</label>
                    <input
                        type="password"
                        class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm"
                        id="mot_de_passe_confirmation"
                        name="mot_de_passe_confirmation"
                        placeholder="Confirmez votre mot de passe"
                        required
                        minlength="4"
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="w-full bg-primary-600 text-white rounded-xl px-6 py-3.5 text-sm font-bold hover:bg-primary-700 shadow-lg shadow-primary-600/20 transition mb-4 flex items-center justify-center gap-2">
                    <i class="bi bi-person-check"></i> S'inscrire
                </button>
            </form>

            <div class="text-center">
                <p class="text-slate-500 text-sm">
                    Déjà inscrit ?
                    <a href="{{ route('login') }}" class="text-primary-600 font-bold hover:text-primary-700 transition">Se connecter</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('mot_de_passe');
            const confirmInput = document.getElementById('mot_de_passe_confirmation');
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');

            if (confirmInput && passwordInput) {
                confirmInput.addEventListener('input', function() {
                    if (this.value !== passwordInput.value && this.value.length > 0) {
                        this.setCustomValidity('Les mots de passe ne correspondent pas.');
                        this.classList.add('border-red-300');
                    } else {
                        this.setCustomValidity('');
                        this.classList.remove('border-red-300');
                    }
                });
            }

            if (passwordInput && strengthBar && strengthText) {
                passwordInput.addEventListener('input', function() {
                    const val = this.value;
                    let score = 0;
                    if (val.length >= 4) score++;
                    if (val.length >= 8) score++;
                    if (/[A-Z]/.test(val)) score++;
                    if (/[0-9]/.test(val)) score++;
                    if (/[^a-zA-Z0-9]/.test(val)) score++;

                    const widths = ['0%', '20%', '40%', '60%', '80%', '100%'];
                    const colors = ['bg-slate-300', 'bg-red-400', 'bg-orange-400', 'bg-amber-400', 'bg-emerald-400', 'bg-emerald-500'];
                    const labels = ['', 'Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'];
                    const labelColors = ['text-slate-400', 'text-red-500', 'text-orange-500', 'text-amber-500', 'text-emerald-500', 'text-emerald-600'];

                    const idx = Math.min(score, 5);
                    strengthBar.style.width = widths[idx];
                    strengthBar.className = 'password-strength-bar h-full rounded-full ' + colors[idx];
                    strengthText.textContent = labels[idx];
                    strengthText.className = 'text-xs mt-1 ' + labelColors[idx];
                });
            }
        });
    </script>
</body>
</html>
