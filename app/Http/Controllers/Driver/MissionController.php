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
        $missions = Mission::with('vehicule')->where('id_conducteur', $conducteur->id_conducteur)->get();
        return view('driver.missions.index', compact('missions'));
    }

    public function show(Mission $mission)
    {
        return view('driver.missions.show', compact('mission'));
    }
}