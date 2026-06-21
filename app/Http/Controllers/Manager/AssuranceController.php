<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Assurance;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class AssuranceController extends Controller
{
    public function index()
    {
        $assurances = Assurance::with('vehicule')->get();
        return view('admin.assurances.index', compact('assurances'));
    }

    public function create()
    {
        $vehicules = Vehicule::all();
        return view('admin.assurances.create', compact('vehicules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'compagnie' => 'required|string|max:255',
            'numero_contrat' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'cout' => 'required|numeric|min:0',
            'type_assurance' => 'required|in:' . implode(',', Assurance::TYPES),
        ]);

        Assurance::create($validated);
        return redirect()->route('admin.assurances.index')->with('success', 'Assurance créée avec succès.');
    }

    public function show(Assurance $assurance)
    {
        return view('admin.assurances.show', compact('assurance'));
    }

    public function edit(Assurance $assurance)
    {
        $vehicules = Vehicule::all();
        return view('admin.assurances.edit', compact('assurance', 'vehicules'));
    }

    public function update(Request $request, Assurance $assurance)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'compagnie' => 'required|string|max:255',
            'numero_contrat' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'cout' => 'required|numeric|min:0',
            'type_assurance' => 'required|in:' . implode(',', Assurance::TYPES),
        ]);

        $assurance->update($validated);
        return redirect()->route('admin.assurances.index')->with('success', 'Assurance modifiée avec succès.');
    }

    public function destroy(Assurance $assurance)
    {
        $assurance->delete();
        return redirect()->route('admin.assurances.index')->with('success', 'Assurance supprimée avec succès.');
    }
}
