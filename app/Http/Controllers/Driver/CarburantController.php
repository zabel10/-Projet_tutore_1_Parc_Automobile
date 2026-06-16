<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Carburant;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class CarburantController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        $carburants = Carburant::with('vehicule')->where('id_conducteur', $conducteur->id_conducteur)->get();
        return view('driver.carburants.index', compact('carburants'));
    }

    public function create()
    {
        $vehicules = Vehicule::all();
        return view('driver.carburants.create', compact('vehicules'));
    }

    public function store(Request $request)
    {
        $conducteur = auth()->user()->conducteur;

        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'date_plein' => 'required|date',
            'quantite_litres' => 'required|numeric|min:0',
            'prix_litre' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',
        ]);

        $validated['id_conducteur'] = $conducteur->id_conducteur;
        $validated['cout_total'] = $validated['quantite_litres'] * $validated['prix_litre'];

        Carburant::create($validated);
        return redirect()->route('driver.carburants.index')->with('success', 'Plein enregistré avec succès.');
    }
}