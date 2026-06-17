<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'id_notification';

    protected $fillable = [
        'id_utilisateur',
        'id_conducteur',
        'id_vehicule',
        'type_notification',
        'titre',
        'message',
        'lu',
        'date_notification',
        'lien_url',
    ];

    protected $casts = [
        'date_notification' => 'datetime',
        'lu' => 'boolean',
    ];

    public const TYPES = ['info', 'alerte', 'maintenance', 'ravitaillement', 'bon_sortie', 'demande'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class, 'id_conducteur');
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }
}
