<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $table = 'demandes';
    protected $primaryKey = 'id_demande';

    protected $fillable = [
        'id_conducteur',
        'id_vehicule',
        'id_utilisateur',
        'numero',
        'type_demande',
        'sujet',
        'motif',
        'priorite',
        'date_demande',
        'statut',
        'reponse',
    ];

    protected $casts = [
        'date_demande' => 'date',
    ];

    public const STATUTS = ['en_attente', 'approuvee', 'refusee', 'traitee'];
    public const TYPES = ['vehicule', 'ravitaillement', 'maintenance', 'document', 'probleme', 'autre'];

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
