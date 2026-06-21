<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BonSortie;
use Illuminate\Http\Request;

class BonSortieController extends Controller
{
    public function index()
    {
        $bonsSortie = BonSortie::with(['conducteur.utilisateur', 'vehicule', 'mission'])
            ->orderByDesc('date_sortie')
            ->paginate(15);

        return view('admin.bons-sortie.index', compact('bonsSortie'));
    }

    public function show(BonSortie $bonSortie)
    {
        $bonSortie->load('conducteur.utilisateur', 'vehicule', 'mission');
        return view('admin.bons-sortie.show', compact('bonSortie'));
    }

    public function update(Request $request, BonSortie $bonSortie)
    {
        $validated = $request->validate([
            'statut' => 'required|in:valide,en_cours,cloture,annule',
            'date_retour_reelle' => 'nullable|date',
            'km_retour' => 'nullable|integer|min:0',
            'observations' => 'nullable|string|max:1000',
        ]);

        if (!empty($validated['km_retour']) && !$bonSortie->km_retour) {
            $bonSortie->update(['km_retour' => $validated['km_retour']]);
        }

        $bonSortie->update([
            'statut' => $validated['statut'],
            'date_retour_reelle' => $validated['date_retour_reelle'] ?? $bonSortie->date_retour_reelle,
            'observations' => $validated['observations'] ?? $bonSortie->observations,
        ]);

        return back()->with('success', 'Bon de sortie mis à jour avec succès.');
    }
}
