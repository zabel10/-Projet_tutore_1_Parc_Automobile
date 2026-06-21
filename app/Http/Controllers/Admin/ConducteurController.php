<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conducteur;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConducteurController extends Controller
{
    public function index()
    {
        $conducteurs = Conducteur::with('utilisateur')->get();
        return view('admin.conducteurs.index', compact('conducteurs'));
    }

    public function create()
    {
        return view('admin.conducteurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:utilisateurs',
            'mot_de_passe' => 'required|string|min:8',
            'telephone' => 'nullable|string|max:255',
            'num_permis' => 'required|string|max:255',
            'date_expiration_permis' => 'required|date|after:today',
            'categorie_permis' => 'required|string|max:255',
            'date_naissance' => 'required|date|before:today',
            'photo' => 'nullable|image|max:4096',
        ]);

        $utilisateur = Utilisateur::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'mot_de_passe' => bcrypt($validated['mot_de_passe']),
            'role' => 'conducteur',
            'telephone' => $validated['telephone'],
        ]);

        $data = [
            'num_permis' => $validated['num_permis'],
            'date_expiration_permis' => $validated['date_expiration_permis'],
            'categorie_permis' => $validated['categorie_permis'],
            'date_naissance' => $validated['date_naissance'],
        ];

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('photos/conducteurs', 'public');
        }

        $utilisateur->conducteur()->create($data);

        return redirect()->route('admin.conducteurs.index')->with('success', 'Conducteur créé avec succès.');
    }

    public function show(Conducteur $conducteur)
    {
        return view('admin.conducteurs.show', compact('conducteur'));
    }

    public function edit(Conducteur $conducteur)
    {
        return view('admin.conducteurs.edit', compact('conducteur'));
    }

    public function update(Request $request, Conducteur $conducteur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:utilisateurs,email,' . $conducteur->utilisateur->id_utilisateur . ',id_utilisateur',
            'mot_de_passe' => 'nullable|string|min:8',
            'telephone' => 'nullable|string|max:255',
            'num_permis' => 'required|string|max:255',
            'date_expiration_permis' => 'required|date',
            'categorie_permis' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'photo' => 'nullable|image|max:4096',
        ]);

        $conducteur->utilisateur->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
        ]);

        if (!empty($validated['mot_de_passe'])) {
            $conducteur->utilisateur->update(['mot_de_passe' => bcrypt($validated['mot_de_passe'])]);
        }

        $data = [
            'num_permis' => $validated['num_permis'],
            'date_expiration_permis' => $validated['date_expiration_permis'],
            'categorie_permis' => $validated['categorie_permis'],
            'date_naissance' => $validated['date_naissance'],
        ];

        if ($request->hasFile('photo')) {
            if ($conducteur->photo_path) {
                Storage::disk('public')->delete($conducteur->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('photos/conducteurs', 'public');
        }

        $conducteur->update($data);

        return redirect()->route('admin.conducteurs.index')->with('success', 'Conducteur modifié avec succès.');
    }

    public function destroy(Conducteur $conducteur)
    {
        if ($conducteur->photo_path) {
            Storage::disk('public')->delete($conducteur->photo_path);
        }
        $conducteur->utilisateur->delete();
        return redirect()->route('admin.conducteurs.index')->with('success', 'Conducteur supprimé avec succès.');
    }
}
