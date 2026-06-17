<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $table = 'affectations';
    protected $primaryKey = 'id_affectation';

    protected $fillable = [
        'id_vehicule',
        'id_conducteur',
        'id_mission',
        'date_debut',
        'date_fin_prevue',
        'date_fin_reelle',
        'statut',
        'observations',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin_prevue' => 'date',
        'date_fin_reelle' => 'date',
    ];

    public const STATUTS = ['planifiee', 'en_cours', 'terminee', 'annulee'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class, 'id_conducteur');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'id_mission');
    }
}
