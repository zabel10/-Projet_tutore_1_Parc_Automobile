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
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $carburants = Carburant::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_plein')
            ->paginate(10);

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
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'date_plein' => 'required|date',
            'quantite_litres' => 'required|numeric|min:0',
            'prix_litre' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',
        ]);

        Carburant::create([
            'id_vehicule' => $validated['id_vehicule'],
            'id_conducteur' => $conducteur->id_conducteur,
            'date_plein' => $validated['date_plein'],
            'quantite_litres' => $validated['quantite_litres'],
            'prix_litre' => $validated['prix_litre'],
            'kilometrage' => $validated['kilometrage'],
            'cout_total' => $validated['quantite_litres'] * $validated['prix_litre'],
        ]);

        return redirect()->route('driver.carburants.index')->with('success', 'Ravitaillement enregistré avec succès.');
    }
}
