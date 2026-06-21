<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AutoPark - Connexion</title>
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
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xl">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl flex items-center justify-center text-white mx-auto mb-5 shadow-lg shadow-primary-600/30">
                    <i class="bi bi-car-front-fill text-3xl"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 mb-1">Connexion</h1>
                <p class="text-slate-500 text-sm">Accédez à votre espace AutoPark</p>
            </div>

            @if($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 mb-5 flex items-start gap-2">
                    <i class="bi bi-exclamation-triangle-fill mt-0.5 shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 mb-5 flex items-start gap-2">
                    <i class="bi bi-exclamation-triangle-fill mt-0.5 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf

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
                        autofocus
                        autocomplete="email"
                        maxlength="100"
                    >
                    @error('email')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="mot_de_passe" class="block text-sm font-semibold text-slate-700 mb-1.5">Mot de passe</label>
                    <input
                        type="password"
                        class="rounded-xl border-2 border-slate-200 px-4 py-3 w-full focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition text-sm @error('mot_de_passe') border-red-300 focus:border-red-500 focus:ring-red-100 @enderror"
                        id="mot_de_passe"
                        name="mot_de_passe"
                        placeholder="Votre mot de passe"
                        required
                        autocomplete="current-password"
                        minlength="4"
                    >
                    @error('mot_de_passe')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-primary-600 text-white rounded-xl px-6 py-3.5 text-sm font-bold hover:bg-primary-700 shadow-lg shadow-primary-600/20 transition mb-4 flex items-center justify-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> Se connecter
                </button>
            </form>

            <div class="text-center">
                <p class="text-slate-500 text-sm mb-0">
                    Pas encore inscrit ?
                    <a href="{{ route('register') }}" class="text-primary-600 font-bold hover:text-primary-700 transition">Créer un compte</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
