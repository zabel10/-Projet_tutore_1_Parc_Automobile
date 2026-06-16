@extends('layouts.app')

@section('title', 'Conducteurs - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Gestion des Conducteurs</h1>

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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($conducteurs as $conducteur)
                <tr>
                    <td class="px-6 py-4">{{ $conducteur->utilisateur->nom }} {{ $conducteur->utilisateur->prenom }}</td>
                    <td class="px-6 py-4">{{ $conducteur->utilisateur->email }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.conducteurs.show', $conducteur) }}" class="text-blue-600 hover:text-blue-900 mr-2">Voir</a>
                        <a href="{{ route('admin.conducteurs.edit', $conducteur) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</a>
                        <form action="{{ route('admin.conducteurs.destroy', $conducteur) }}" method="POST" class="inline">
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