<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $demandes = Demande::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_demande')
            ->paginate(10);

        return view('driver.demandes.index', compact('demandes'));
    }

    public function create(Request $request)
    {
        $vehicules = Vehicule::all();
        $type = in_array($request->query('type'), Demande::TYPES, true) ? $request->query('type') : 'autre';

        return view('driver.demandes.create', compact('vehicules', 'type'));
    }

    public function store(Request $request)
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $validated = $request->validate([
            'id_vehicule' => 'nullable|exists:vehicules,id_vehicule',
            'type_demande' => 'required|in:' . implode(',', Demande::TYPES),
            'sujet' => 'required|string|max:120',
            'motif' => 'required|string',
            'priorite' => 'required|in:faible,moyenne,haute,urgente',
        ]);

        Demande::create([
            'id_conducteur' => $conducteur->id_conducteur,
            'id_vehicule' => $validated['id_vehicule'],
            'id_utilisateur' => auth()->id(),
            'numero' => 'DM-' . now()->format('Ymd-His'),
            'type_demande' => $validated['type_demande'],
            'sujet' => $validated['sujet'],
            'motif' => $validated['motif'],
            'priorite' => $validated['priorite'],
            'date_demande' => now(),
            'statut' => 'en_attente',
        ]);

        return redirect()->route('driver.demandes.index')->with('success', 'Demande envoyée avec succès.');
    }
}
