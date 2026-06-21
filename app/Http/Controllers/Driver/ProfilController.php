<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit()
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        return view('driver.profil.edit', compact('conducteur'));
    }

    public function update(Request $request)
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $utilisateur = auth()->user();

        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'num_permis' => 'required|string|max:30',
            'date_expiration_permis' => 'required|date',
            'categorie_permis' => 'required|in:A,B,C,D,BE,CE',
        ]);

        $utilisateur->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'],
        ]);

        $conducteur->update([
            'num_permis' => $validated['num_permis'],
            'date_expiration_permis' => $validated['date_expiration_permis'],
            'categorie_permis' => $validated['categorie_permis'],
        ]);

        return redirect()->route('driver.dashboard')->with('success', 'Profil mis à jour avec succès.');
    }
}
