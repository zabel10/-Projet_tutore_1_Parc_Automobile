<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alerte extends Model
{
    use HasFactory;

    protected $table = 'alertes';
    protected $primaryKey = 'id_alerte';

    protected $fillable = [
        'id_vehicule',
        'type_alerte',
        'message',
        'date_echeance',
        'statut',
    ];

    protected $casts = [
        'date_echeance' => 'date',
    ];

    const STATUTS = ['active', 'resolue', 'ignoree'];
    const TYPES   = ['revision', 'assurance', 'visite_technique', 'permis', 'autre'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }
}
