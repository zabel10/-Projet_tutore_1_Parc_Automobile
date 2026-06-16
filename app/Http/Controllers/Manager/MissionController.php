<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\Vehicule;
use App\Models\Conducteur;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::with(['vehicule', 'conducteur', 'createur'])->get();
        return view('manager.missions.index', compact('missions'));
    }

    public function create()
    {
        $vehicules = Vehicule::where('statut', 'disponible')->get();
        $conducteurs = Conducteur::all();
        return view('manager.missions.create', compact('vehicules', 'conducteurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'id_conducteur' => 'required|exists:conducteurs,id_conducteur',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date|after_or_equal:date_depart',
            'destination' => 'required|string|max:255',
            'motif' => 'required|string|max:255',
            'km_depart' => 'required|integer|min:0',
        ]);

        $validated['id_utilisateur'] = auth()->id();
        $validated['statut'] = 'planifiee';

        Mission::create($validated);
        return redirect()->route('manager.missions.index')->with('success', 'Mission créée avec succès.');
    }

    public function show(Mission $mission)
    {
        return view('manager.missions.show', compact('mission'));
    }

    public function edit(Mission $mission)
    {
        $vehicules = Vehicule::all();
        $conducteurs = Conducteur::all();
        return view('manager.missions.edit', compact('mission', 'vehicules', 'conducteurs'));
    }

    public function update(Request $request, Mission $mission)
    {
        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'id_conducteur' => 'required|exists:conducteurs,id_conducteur',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date|after_or_equal:date_depart',
            'destination' => 'required|string|max:255',
            'motif' => 'required|string|max:255',
            'statut' => 'required|in:' . implode(',', Mission::STATUTS),
            'km_depart' => 'required|integer|min:0',
            'km_retour' => 'nullable|integer|min:0',
        ]);

        if (isset($validated['km_retour']) && $validated['statut'] == 'terminee') {
            $validated['km_retour'] = $validated['km_retour'];
        }

        $mission->update($validated);
        return redirect()->route('manager.missions.index')->with('success', 'Mission modifiée avec succès.');
    }

    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('manager.missions.index')->with('success', 'Mission supprimée avec succès.');
    }
}