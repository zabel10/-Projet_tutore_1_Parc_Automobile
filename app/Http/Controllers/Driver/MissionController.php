<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $missions = Mission::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_depart')
            ->paginate(10);

        $today = now()->startOfDay();
        foreach ($missions as $mission) {
            if ($mission->statut === 'annulee') {
                continue;
            }

            $depart = \Carbon\Carbon::parse($mission->date_depart)->startOfDay();
            $retour = \Carbon\Carbon::parse($mission->date_retour)->startOfDay();

            $newStatut = match (true) {
                $today->lt($depart) => 'planifiee',
                $today->between($depart, $retour) => 'en_cours',
                $today->gt($retour) => 'terminee',
                default => $mission->statut,
            };

            if ($newStatut !== $mission->statut) {
                $mission->update(['statut' => $newStatut]);
                $mission->statut = $newStatut;
            }
        }

        return view('driver.missions.index', compact('missions'));
    }

    public function show(Mission $mission)
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');
        abort_unless($mission->id_conducteur === $conducteur->id_conducteur, 403);

        $mission->load('vehicule', 'bonSortie');

        return view('driver.missions.show', compact('mission'));
    }
}
