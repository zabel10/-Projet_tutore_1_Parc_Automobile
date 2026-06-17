<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;

class MaintenanceController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $maintenances = Maintenance::with('vehicule')
            ->whereRelation('vehicule.missions', 'id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_maintenance')
            ->paginate(10);

        return view('driver.maintenances.index', compact('maintenances'));
    }
}
