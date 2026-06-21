<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::with(['conducteur.utilisateur', 'vehicule'])
            ->orderByDesc('date_demande')
            ->paginate(15);

        return view('admin.demandes.index', compact('demandes'));
    }

    public function show(Demande $demande)
    {
        $demande->load('conducteur.utilisateur', 'vehicule');
        return view('admin.demandes.show', compact('demande'));
    }

    public function update(Request $request, Demande $demande)
    {
        $validated = $request->validate([
            'statut' => 'required|in:approuvee,refusee,traitee',
            'reponse' => 'nullable|string|max:1000',
        ]);

        $demande->update([
            'statut' => $validated['statut'],
            'reponse' => $validated['reponse'],
        ]);

        return back()->with('success', 'Demande mise à jour avec succès.');
    }
}
