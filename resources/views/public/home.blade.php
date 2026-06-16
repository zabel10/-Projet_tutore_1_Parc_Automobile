<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AutoPark - Gestion de Parc Automobile</title>
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
                    <a href="/presentation" class="text-gray-700 hover:text-blue-600">Présentation</a>
                    <a href="/contact" class="text-gray-700 hover:text-blue-600">Contact</a>
                    <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Connexion</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Bienvenue à AutoPark</h1>
            <p class="text-lg text-gray-600">Gestion moderne de votre parc automobile</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-3xl font-bold text-blue-600" id="total-vehicules">0</div>
                <div class="text-gray-600">Véhicules au parc</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-3xl font-bold text-green-600" id="vehicules-disponibles">0</div>
                <div class="text-gray-600">Véhicules disponibles</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-3xl font-bold text-orange-600" id="missions-realisees">0</div>
                <div class="text-gray-600">Missions réalisées</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Fonctionnalités</h2>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                <li class="flex items-center"><span class="mr-2">✓</span> Gestion des véhicules et immatriculations</li>
                <li class="flex items-center"><span class="mr-2">✓</span> Planification et suivi des missions</li>
                <li class="flex items-center"><span class="mr-2">✓</span> Maintenance et révisions</li>
                <li class="flex items-center"><span class="mr-2">✓</span> Suivi consommation carburant</li>
                <li class="flex items-center"><span class="mr-2">✓</span> Alertes automatiques</li>
                <li class="flex items-center"><span class="mr-2">✓</span> Rapports et statistiques</li>
            </ul>
        </div>
    </main>

    <footer class="bg-white border-t py-6 mt-12">
        <div class="max-w-7xl mx-auto text-center text-gray-500">
            &copy; {{ date('Y') }} AutoPark - Burkina Faso
        </div>
    </footer>

    <script>
        fetch('/api/home')
            .then(r => r.json())
            .then(data => {
                document.getElementById('total-vehicules').textContent = data.parc.total_vehicules;
                document.getElementById('vehicules-disponibles').textContent = data.parc.vehicules_disponibles;
                document.getElementById('missions-realisees').textContent = data.statistiques.missions_realisees;
            });
    </script>
</body>
</html>