<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit()
    {
        $utilisateur = auth()->user();
        return view('admin.profil.edit', compact('utilisateur'));
    }

    public function update(Request $request)
    {
        $utilisateur = auth()->user();

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:utilisateurs,email,' . $utilisateur->id . ',id',
            'telephone' => 'nullable|string|max:255',
            'mot_de_passe' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
        ];

        if (!empty($validated['mot_de_passe'])) {
            $data['mot_de_passe'] = bcrypt($validated['mot_de_passe']);
        }

        $utilisateur->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Profil mis à jour avec succès.');
    }
}
