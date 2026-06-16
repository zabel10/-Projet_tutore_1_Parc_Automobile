@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Gestion des Véhicules</h1>
        <a href="{{ route('vehicules.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Nouveau Véhicule</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Immatriculation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marque</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Modèle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Année</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kilométrage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($vehicules as $vehicule)
                <tr>
                    <td class="px-6 py-4">{{ $vehicule->immatriculation }}</td>
                    <td class="px-6 py-4">{{ $vehicule->marque }}</td>
                    <td class="px-6 py-4">{{ $vehicule->modele }}</td>
                    <td class="px-6 py-4">{{ $vehicule->annee }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($vehicule->statut == 'disponible') bg-green-100 text-green-800
                            @elseif($vehicule->statut == 'en_mission') bg-blue-100 text-blue-800
                            @elseif($vehicule->statut == 'en_maintenance') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $vehicule->statut)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $vehicule->kilometrage }} km</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('vehicules.show', $vehicule) }}" class="text-blue-600 hover:text-blue-900 mr-2">Voir</a>
                        <a href="{{ route('vehicules.edit', $vehicule) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</a>
                        <form action="{{ route('vehicules.destroy', $vehicule) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer ce véhicule ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection