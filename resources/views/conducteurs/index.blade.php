@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Gestion des Conducteurs</h1>
        <a href="{{ route('conducteurs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Nouveau Conducteur</a>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prénom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Permis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expiration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($conducteurs as $conducteur)
                <tr>
                    <td class="px-6 py-4">{{ $conducteur->utilisateur->nom }}</td>
                    <td class="px-6 py-4">{{ $conducteur->utilisateur->prenom }}</td>
                    <td class="px-6 py-4">{{ $conducteur->utilisateur->email }}</td>
                    <td class="px-6 py-4">{{ $conducteur->num_permis }}</td>
                    <td class="px-6 py-4">{{ $conducteur->date_expiration_permis->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('conducteurs.show', $conducteur) }}" class="text-blue-600 hover:text-blue-900 mr-2">Voir</a>
                        <a href="{{ route('conducteurs.edit', $conducteur) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</a>
                        <form action="{{ route('conducteurs.destroy', $conducteur) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer ce conducteur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection