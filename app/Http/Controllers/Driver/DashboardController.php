<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\Carburant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        
        $stats = [
            'missions_en_cours' => Mission::where('id_conducteur', $conducteur->id_conducteur)->where('statut', 'en_cours')->count(),
            'missions_terminees' => Mission::where('id_conducteur', $conducteur->id_conducteur)->where('statut', 'terminee')->count(),
            'pleins_effectues' => Carburant::where('id_conducteur', $conducteur->id_conducteur)->count(),
        ];

        $missions = Mission::with('vehicule')->where('id_conducteur', $conducteur->id_conducteur)->get();

        return view('driver.dashboard', compact('stats', 'missions'));
    }
}