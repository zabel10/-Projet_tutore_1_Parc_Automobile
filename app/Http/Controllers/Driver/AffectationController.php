<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Affectation;

class AffectationController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $affectations = Affectation::with(['vehicule', 'conducteur.utilisateur', 'mission'])
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_debut')
            ->paginate(10);

        return view('driver.affectations.index', compact('affectations'));
    }

    public function show(Affectation $affectation)
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');
        abort_unless($affectation->id_conducteur === $conducteur->id_conducteur, 403);

        $affectation->load(['vehicule', 'mission']);

        return view('driver.affectations.show', compact('affectation'));
    }
}
