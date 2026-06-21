<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use App\Models\Mission;
use App\Models\Alerte;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vehicules' => Vehicule::count(),
            'vehicules_disponibles' => Vehicule::where('statut', 'disponible')->count(),
            'vehicules_en_maintenance' => Vehicule::where('statut', 'en_maintenance')->count(),
            'missions_en_cours' => Mission::where('statut', 'en_cours')->count(),
            'conducteurs_actifs' => \App\Models\Conducteur::count(),
            'reservations_aujourdhui' => 0,
        ];

        $activites = \App\Models\Utilisateur::orderByDesc('created_at')->limit(10)->get()->map(function ($u) {
            return [
                'utilisateur' => $u->prenom . ' ' . $u->nom,
                'action' => 'Connexion',
                'date' => $u->created_at->format('d/m/Y H:i'),
                'statut' => 'success',
            ];
        })->toArray();

        return view('admin.dashboard', compact('stats', 'activites'));
    }
}
