<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assurance extends Model
{
    use HasFactory;

    protected $table = 'assurances';
    protected $primaryKey = 'id_assurance';

    protected $fillable = [
        'id_vehicule',
        'compagnie',
        'numero_contrat',
        'date_debut',
        'date_fin',
        'cout',
        'type_assurance',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'cout' => 'float',
    ];

    const TYPES = ['tous_risques', 'tiers', 'tiers_plus'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }
}