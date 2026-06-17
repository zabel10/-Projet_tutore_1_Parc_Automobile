<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mission extends Model
{
    use HasFactory;

    protected $table = 'missions';
    protected $primaryKey = 'id_mission';

    protected $fillable = [
        'id_vehicule',
        'id_conducteur',
        'id_utilisateur',
        'date_depart',
        'date_retour',
        'destination',
        'motif',
        'statut',
        'km_depart',
        'km_retour',
    ];

    protected $casts = [
        'date_depart' => 'date',
        'date_retour' => 'date',
        'km_depart'   => 'integer',
        'km_retour'   => 'integer',
    ];

    const STATUTS = ['planifiee', 'en_cours', 'terminee', 'annulee'];

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

    public function bonSortie()
    {
        return $this->hasOne(BonSortie::class, 'id_mission');
    }

    public function affectation()
    {
        return $this->hasOne(Affectation::class, 'id_mission');
    }

    // Distance parcourue
    public function getDistanceAttribute(): ?int
    {
        if ($this->km_depart && $this->km_retour) {
            return $this->km_retour - $this->km_depart;
        }
        return null;
    }
}
