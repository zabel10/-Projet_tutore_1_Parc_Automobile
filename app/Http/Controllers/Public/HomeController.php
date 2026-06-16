<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use App\Models\Mission;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vehicules' => Vehicule::count(),
            'vehicules_disponibles' => Vehicule::where('statut', 'disponible')->count(),
            'vehicules_en_maintenance' => Vehicule::where('statut', 'en_maintenance')->count(),
            'missions_en_cours' => Mission::where('statut', 'en_cours')->count(),
            'demandes_en_attente' => Mission::where('statut', 'planifiee')->count(),
            'depenses_mensuelles' => 0,
        ];

        return view('public.home', compact('stats'));
    }
}