@extends('layouts.app')

@section('title', 'Dashboard - Gestionnaire')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Dashboard Gestionnaire</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">Total Véhicules</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_vehicules'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">Véhicules Disponibles</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['vehicules_disponibles'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">Missions en Cours</h3>
            <p class="text-3xl font-bold text-orange-600">{{ $stats['missions_en_cours'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">Alertes Actives</h3>
            <p class="text-3xl font-bold text-red-600">{{ $stats['alertes_actives'] }}</p>
        </div>
    </div>
</div>
@endsection