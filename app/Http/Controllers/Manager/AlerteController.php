<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Alerte;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class AlerteController extends Controller
{
    public function index()
    {
        $alertes = Alerte::with('vehicule')->get();
        return view('manager.alertes.index', compact('alertes'));
    }

    public function create()
    {
        $vehicules = Vehicule::all();
        return view('manager.alertes.create', compact('vehicules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'type_alerte' => 'required|in:' . implode(',', Alerte::TYPES),
            'message' => 'required|string|max:255',
            'date_echeance' => 'required|date',
            'statut' => 'required|in:' . implode(',', Alerte::STATUTS),
        ]);

        Alerte::create($validated);
        return redirect()->route('manager.alertes.index')->with('success', 'Alerte créée avec succès.');
    }

    public function show(Alerte $alerte)
    {
        return view('manager.alertes.show', compact('alerte'));
    }

    public function edit(Alerte $alerte)
    {
        $vehicules = Vehicule::all();
        return view('manager.alertes.edit', compact('alerte', 'vehicules'));
    }

    public function update(Request $request, Alerte $alerte)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'type_alerte' => 'required|in:' . implode(',', Alerte::TYPES),
            'message' => 'required|string|max:255',
            'date_echeance' => 'required|date',
            'statut' => 'required|in:' . implode(',', Alerte::STATUTS),
        ]);

        $alerte->update($validated);
        return redirect()->route('manager.alertes.index')->with('success', 'Alerte modifiée avec succès.');
    }

    public function destroy(Alerte $alerte)
    {
        $alerte->delete();
        return redirect()->route('manager.alertes.index')->with('success', 'Alerte supprimée avec succès.');
    }
}