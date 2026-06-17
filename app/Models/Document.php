<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $primaryKey = 'id_document';

    protected $fillable = [
        'id_conducteur',
        'id_vehicule',
        'id_utilisateur',
        'type_document',
        'numero_document',
        'fichier_path',
        'date_expiration',
        'statut',
    ];

    protected $casts = [
        'date_expiration' => 'date',
    ];

    public const TYPES = ['permis', 'carte_grise', 'assurance', 'visite_technique', 'autre'];
    public const STATUTS = ['actif', 'expire', 'en_attente_validation'];

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class, 'id_conducteur');
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }

    public function createur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }
}
