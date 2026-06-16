<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conducteur extends Model
{
    use HasFactory;

    protected $table = 'conducteurs';
    protected $primaryKey = 'id_conducteur';

    protected $fillable = [
        'id_utilisateur',
        'num_permis',
        'date_expiration_permis',
        'categorie_permis',
        'date_naissance',
    ];

    protected $casts = [
        'date_expiration_permis' => 'date',
        'date_naissance'         => 'date',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }

    public function missions()
    {
        return $this->hasMany(Mission::class, 'id_conducteur');
    }

    public function carburants()
    {
        return $this->hasMany(Carburant::class, 'id_conducteur');
    }

    // Vérifie si le permis expire dans moins de X jours
    public function permisExpireBientot(int $jours = 30): bool
    {
        return $this->date_expiration_permis
            && $this->date_expiration_permis->diffInDays(now(), false) >= -$jours
            && $this->date_expiration_permis->isFuture();
    }
}
