<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Mission;
use App\Models\Alerte;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vehicules' => Vehicule::count(),
            'total_conducteurs' => \App\Models\Conducteur::count(),
            'total_missions' => Mission::count(),
            'alertes_actives' => Alerte::where('statut', 'active')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}