<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('vehicule')->get();
        return view('admin.maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $vehicules = Vehicule::all();
        return view('admin.maintenances.create', compact('vehicules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'type_maintenance' => 'required|string|max:255',
            'date_maintenance' => 'required|date',
            'cout' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'prestataire' => 'required|string|max:255',
            'km_au_moment' => 'required|integer|min:0',
            'prochaine_echeance' => 'nullable|date|after:today',
        ]);

        Maintenance::create($validated);
        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance enregistrée avec succès.');
    }

    public function show(Maintenance $maintenance)
    {
        return view('admin.maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        $vehicules = Vehicule::all();
        return view('admin.maintenances.edit', compact('maintenance', 'vehicules'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'type_maintenance' => 'required|string|max:255',
            'date_maintenance' => 'required|date',
            'cout' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'prestataire' => 'required|string|max:255',
            'km_au_moment' => 'required|integer|min:0',
            'prochaine_echeance' => 'nullable|date|after:today',
        ]);

        $maintenance->update($validated);
        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance modifiée avec succès.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance supprimée avec succès.');
    }
}