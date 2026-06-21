<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicule extends Model
{
    use HasFactory;

    protected $table = 'vehicules';
    protected $primaryKey = 'id_vehicule';

    protected $fillable = [
        'immatriculation',
        'marque',
        'modele',
        'annee',
        'statut',
        'kilometrage',
        'carburant',
        'couleur',
        'date_acquisition',
        'photo_path',
    ];

    protected $casts = [
        'date_acquisition' => 'date',
        'annee'            => 'integer',
        'kilometrage'      => 'integer',
    ];

    // Valeurs possibles du statut
    const STATUTS = ['disponible', 'en_mission', 'en_maintenance', 'hors_service'];

    public function missions()
    {
        return $this->hasMany(Mission::class, 'id_vehicule');
    }

    public function affectations()
    {
        return $this->hasMany(Affectation::class, 'id_vehicule');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'id_vehicule');
    }

    public function carburants()
    {
        return $this->hasMany(Carburant::class, 'id_vehicule');
    }

    public function alertes()
    {
        return $this->hasMany(Alerte::class, 'id_vehicule');
    }

    public function assurances()
    {
        return $this->hasMany(Assurance::class, 'id_vehicule');
    }

    public function bonsSortie()
    {
        return $this->hasMany(BonSortie::class, 'id_vehicule');
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'id_vehicule');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'id_vehicule');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id_vehicule');
    }
}
