<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $documents = Document::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('driver.documents.index', compact('documents'));
    }

    public function create()
    {
        $vehicules = Vehicule::all();

        return view('driver.documents.create', compact('vehicules'));
    }

    public function store(Request $request)
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $validated = $request->validate([
            'id_vehicule' => 'nullable|exists:vehicules,id_vehicule',
            'type_document' => 'required|in:' . implode(',', Document::TYPES),
            'numero_document' => 'nullable|string|max:80',
            'fichier' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'date_expiration' => 'nullable|date',
        ]);

        $path = null;
        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('documents/conducteurs', 'public');
        }

        Document::create([
            'id_conducteur' => $conducteur->id_conducteur,
            'id_vehicule' => $validated['id_vehicule'],
            'id_utilisateur' => auth()->id(),
            'type_document' => $validated['type_document'],
            'numero_document' => $validated['numero_document'],
            'fichier_path' => $path,
            'date_expiration' => $validated['date_expiration'] ?? null,
            'statut' => 'en_attente_validation',
        ]);

        return redirect()->route('driver.documents.index')->with('success', 'Document envoyé avec succès.');
    }
}
