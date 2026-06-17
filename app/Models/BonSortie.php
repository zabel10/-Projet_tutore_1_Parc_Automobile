<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonSortie extends Model
{
    use HasFactory;

    protected $table = 'bons_sortie';
    protected $primaryKey = 'id_bon_sortie';

    protected $fillable = [
        'id_mission',
        'id_vehicule',
        'id_conducteur',
        'id_utilisateur',
        'numero',
        'destination',
        'date_sortie',
        'date_retour_prevue',
        'date_retour_reelle',
        'km_depart',
        'km_retour',
        'motif',
        'statut',
        'observations',
    ];

    protected $casts = [
        'date_sortie' => 'datetime',
        'date_retour_prevue' => 'datetime',
        'date_retour_reelle' => 'datetime',
        'km_depart' => 'integer',
        'km_retour' => 'integer',
    ];

    public const STATUTS = ['brouillon', 'valide', 'en_cours', 'cloture', 'annule'];

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'id_mission');
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class, 'id_conducteur');
    }

    public function createur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }
}
