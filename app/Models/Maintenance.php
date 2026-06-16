<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenances';
    protected $primaryKey = 'id_maintenance';

    protected $fillable = [
        'id_vehicule',
        'type_maintenance',
        'date_maintenance',
        'cout',
        'description',
        'prestataire',
        'km_au_moment',
        'prochaine_echeance',
    ];

    protected $casts = [
        'date_maintenance'   => 'date',
        'prochaine_echeance' => 'date',
        'cout'               => 'float',
        'km_au_moment'       => 'integer',
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }
}
