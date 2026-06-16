<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact - AutoPark</title>
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
                    <a href="/contact" class="text-gray-700 hover:text-blue-600 font-semibold">Contact</a>
                    <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Connexion</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Contact</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Nos coordonnées</h2>
                    <p class="text-gray-600 mb-2"><strong>Email :</strong> contact@autopark.bf</p>
                    <p class="text-gray-600 mb-2"><strong>Téléphone :</strong> +226 70 00 00 00</p>
                    <p class="text-gray-600 mb-4"><strong>Adresse :</strong> Ouagadougou, Burkina Faso</p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Support technique</h2>
                    <p class="text-gray-600 mb-2">Disponible 24h/24, 7j/7</p>
                    <p class="text-gray-600">support@autopark.bf</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t py-6 mt-12">
        <div class="max-w-7xl mx-auto text-center text-gray-500">
            &copy; {{ date('Y') }} AutoPark - Burkina Faso
        </div>
    </footer>
</body>
</html>