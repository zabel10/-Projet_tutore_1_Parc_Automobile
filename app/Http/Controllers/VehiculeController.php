<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::all();
        return view('vehicules.index', compact('vehicules'));
    }

    public function create()
    {
        return view('vehicules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'immatriculation' => 'required|string|max:255|unique:vehicules',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'statut' => 'required|in:' . implode(',', Vehicule::STATUTS),
            'kilometrage' => 'required|integer|min:0',
            'carburant' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
            'date_acquisition' => 'required|date',
        ]);

        Vehicule::create($validated);
        return redirect()->route('vehicules.index')->with('success', 'Véhicule créé avec succès.');
    }

    public function show(Vehicule $vehicule)
    {
        return view('vehicules.show', compact('vehicule'));
    }

    public function edit(Vehicule $vehicule)
    {
        return view('vehicules.edit', compact('vehicule'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $validated = $request->validate([
            'immatriculation' => 'required|string|max:255|unique:vehicules,immatriculation,' . $vehicule->id_vehicule . ',id_vehicule',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'statut' => 'required|in:' . implode(',', Vehicule::STATUTS),
            'kilometrage' => 'required|integer|min:0',
            'carburant' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
            'date_acquisition' => 'required|date',
        ]);

        $vehicule->update($validated);
        return redirect()->route('vehicules.index')->with('success', 'Véhicule modifié avec succès.');
    }

    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé avec succès.');
    }
}