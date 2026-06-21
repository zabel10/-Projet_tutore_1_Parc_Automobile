<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id_reservation';

    protected $fillable = [
        'id_utilisateur',
        'id_vehicule',
        'id_conducteur',
        'date_reservation',
        'date_debut',
        'date_fin',
        'motif',
        'statut',
        'km_depart',
        'km_retour',
    ];

    protected $casts = [
        'date_reservation' => 'date',
        'date_debut'       => 'date',
        'date_fin'         => 'date',
        'km_depart'        => 'integer',
        'km_retour'        => 'integer',
    ];

    const STATUTS = ['confirmee', 'en_cours', 'terminee', 'annulee'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class, 'id_conducteur');
    }
}
