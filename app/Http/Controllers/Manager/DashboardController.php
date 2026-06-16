<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use App\Models\Conducteur;
use App\Models\Mission;
use App\Models\Alerte;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vehicules' => Vehicule::count(),
            'vehicules_disponibles' => Vehicule::where('statut', 'disponible')->count(),
            'missions_en_cours' => Mission::where('statut', 'en_cours')->count(),
            'alertes_actives' => Alerte::where('statut', 'active')->count(),
        ];

        return view('manager.dashboard', compact('stats'));
    }
}