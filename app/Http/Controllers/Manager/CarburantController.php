<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Carburant;
use App\Models\Vehicule;
use App\Models\Conducteur;
use Illuminate\Http\Request;

class CarburantController extends Controller
{
    public function index()
    {
        $carburants = Carburant::with(['vehicule', 'conducteur'])->get();
        return view('manager.carburants.index', compact('carburants'));
    }

    public function create()
    {
        $vehicules = Vehicule::all();
        $conducteurs = Conducteur::all();
        return view('manager.carburants.create', compact('vehicules', 'conducteurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'id_conducteur' => 'required|exists:conducteurs,id_conducteur',
            'date_plein' => 'required|date',
            'quantite_litres' => 'required|numeric|min:0',
            'prix_litre' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',
        ]);

        $validated['cout_total'] = $validated['quantite_litres'] * $validated['prix_litre'];

        Carburant::create($validated);
        return redirect()->route('manager.carburants.index')->with('success', 'Plein enregistré avec succès.');
    }

    public function show(Carburant $carburant)
    {
        return view('manager.carburants.show', compact('carburant'));
    }

    public function edit(Carburant $carburant)
    {
        $vehicules = Vehicule::all();
        $conducteurs = Conducteur::all();
        return view('manager.carburants.edit', compact('carburant', 'vehicules', 'conducteurs'));
    }

    public function update(Request $request, Carburant $carburant)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'id_conducteur' => 'required|exists:conducteurs,id_conducteur',
            'date_plein' => 'required|date',
            'quantite_litres' => 'required|numeric|min:0',
            'prix_litre' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',
        ]);

        $validated['cout_total'] = $validated['quantite_litres'] * $validated['prix_litre'];

        $carburant->update($validated);
        return redirect()->route('manager.carburants.index')->with('success', 'Plein modifié avec succès.');
    }

    public function destroy(Carburant $carburant)
    {
        $carburant->delete();
        return redirect()->route('manager.carburants.index')->with('success', 'Plein supprimé avec succès.');
    }
}