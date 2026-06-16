<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carburant extends Model
{
    use HasFactory;

    protected $table = 'carburants';
    protected $primaryKey = 'id_carburant';

    protected $fillable = [
        'id_vehicule',
        'id_conducteur',
        'date_plein',
        'quantite_litres',
        'cout_total',
        'kilometrage',
        'prix_litre',
    ];

    protected $casts = [
        'date_plein'      => 'date',
        'quantite_litres' => 'float',
        'cout_total'      => 'float',
        'prix_litre'      => 'float',
        'kilometrage'     => 'integer',
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class, 'id_conducteur');
    }
}
