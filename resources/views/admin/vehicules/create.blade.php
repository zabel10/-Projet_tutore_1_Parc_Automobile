@extends('layouts.app')

@section('title', 'Nouveau Véhicule')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Nouveau Véhicule</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.vehicules.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Immatriculation *</label>
                    <input type="text" name="immatriculation" value="{{ old('immatriculation') }}" class="w-full border rounded-lg px-3 py-2" required>
                    @error('immatriculation')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Marque *</label>
                        <input type="text" name="marque" value="{{ old('marque') }}" class="w-full border rounded-lg px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Modèle *</label>
                        <input type="text" name="modele" value="{{ old('modele') }}" class="w-full border rounded-lg px-3 py-2" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Année *</label>
                        <input type="number" name="annee" value="{{ old('annee') }}" class="w-full border rounded-lg px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Couleur *</label>
                        <input type="text" name="couleur" value="{{ old('couleur') }}" class="w-full border rounded-lg px-3 py-2" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Statut *</label>
                    <select name="statut" class="w-full border rounded-lg px-3 py-2" required>
                        @foreach(['disponible', 'en_mission', 'en_maintenance', 'hors_service'] as $statut)
                        <option value="{{ $statut }}" {{ old('statut') == $statut ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $statut)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Kilométrage *</label>
                    <input type="number" name="kilometrage" value="{{ old('kilometrage') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Carburant *</label>
                    <input type="text" name="carburant" value="{{ old('carburant') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Date d'acquisition *</label>
                    <input type="date" name="date_acquisition" value="{{ old('date_acquisition') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <a href="{{ route('admin.vehicules.index') }}" class="mr-4 text-gray-600">Annuler</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection