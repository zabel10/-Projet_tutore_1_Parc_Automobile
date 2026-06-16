<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Présentation - AutoPark</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600">AutoPark</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-700 hover:text-blue-600">Accueil</a>
                    <a href="/presentation" class="text-gray-700 hover:text-blue-600 font-semibold">Présentation</a>
                    <a href="/contact" class="text-gray-700 hover:text-blue-600">Contact</a>
                    <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Connexion</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">À propos d'AutoPark</h1>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <p class="text-gray-600 mb-4">
                AutoPark est une solution complète de gestion de parc automobile conçue pour les entreprises et organisations 
                souhaitant optimiser la gestion de leurs véhicules, missions et coûts associés.
            </p>

            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Nos services</h2>
            <ul class="list-disc list-inside text-gray-600 space-y-2">
                <li>Gestion du registre des véhicules (immatriculation, modèle, état)</li>
                <li>Planification et attribution des missions aux conducteurs</li>
                <li>Suivi des maintenances et contrôles techniques</li>
                <li>Gestion des assurances et alertes d'échéance</li>
                <li>Suivi détaillé de la consommation carburant</li>
                <li>Statistiques et rapports de performance</li>
            </ul>

            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Pour qui ?</h2>
            <p class="text-gray-600">
                Administrateurs, gestionnaires de flotte, et conducteurs - chacun dispose d'un espace dédié 
                pour accéder aux informations pertinentes selon son rôle.
            </p>
        </div>
    </main>

    <footer class="bg-white border-t py-6 mt-12">
        <div class="max-w-7xl mx-auto text-center text-gray-500">
            &copy; {{ date('Y') }} AutoPark - Burkina Faso
        </div>
    </footer>
</body>
</html>