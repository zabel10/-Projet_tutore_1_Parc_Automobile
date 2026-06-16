@extends('layouts.app')

@section('title', 'Dashboard - Conducteur')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Dashboard Conducteur</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-600">Missions en cours</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['missions_en_cours'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-600">Missions terminées</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['missions_terminees'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-600">Pleins effectués</h3>
            <p class="text-3xl font-bold text-orange-600">{{ $stats['pleins_effectues'] }}</p>
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-4">Mes Missions</h2>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Véhicule</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Départ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Retour</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Destination</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($missions as $mission)
                <tr>
                    <td class="px-6 py-4">{{ $mission->vehicule->immatriculation ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $mission->date_depart ? $mission->date_depart->format('d/m/Y') : '-' }}</td>
                    <td class="px-6 py-4">{{ $mission->date_retour ? $mission->date_retour->format('d/m/Y') : '-' }}</td>
                    <td class="px-6 py-4">{{ $mission->destination }}</td>
                    <td class="px-6 py-4">{{ ucfirst(str_replace('_', ' ', $mission->statut)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection