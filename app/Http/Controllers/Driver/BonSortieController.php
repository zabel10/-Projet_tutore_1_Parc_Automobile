<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\BonSortie;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class BonSortieController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $bonsSortie = BonSortie::with(['vehicule', 'mission'])
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_sortie')
            ->paginate(10);

        return view('driver.bons-sortie.index', compact('bonsSortie'));
    }

    public function create()
    {
        $vehicules = Vehicule::all();

        return view('driver.bons-sortie.create', compact('vehicules'));
    }

    public function store(Request $request)
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $validated = $request->validate([
            'id_vehicule' => 'required|exists:vehicules,id_vehicule',
            'destination' => 'required|string|max:100',
            'date_sortie' => 'required|date',
            'date_retour_prevue' => 'required|date|after_or_equal:date_sortie',
            'km_depart' => 'required|integer|min:0',
            'motif' => 'required|string|max:255',
            'observations' => 'nullable|string|max:1000',
        ]);

        BonSortie::create([
            'id_vehicule' => $validated['id_vehicule'],
            'id_conducteur' => $conducteur->id_conducteur,
            'id_utilisateur' => auth()->id(),
            'numero' => 'BS-' . now()->format('Ymd-His'),
            'destination' => $validated['destination'],
            'date_sortie' => $validated['date_sortie'] . ' 08:00:00',
            'date_retour_prevue' => $validated['date_retour_prevue'] . ' 17:00:00',
            'km_depart' => $validated['km_depart'],
            'motif' => $validated['motif'],
            'statut' => 'brouillon',
            'observations' => $validated['observations'] ?? null,
        ]);

        return redirect()->route('driver.bons-sortie.index')->with('success', 'Bon de sortie créé avec succès.');
    }
}
