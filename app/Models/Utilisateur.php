<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role',
        'telephone',
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    protected $casts = [
        'role' => 'string',
    ];

    // Relation avec Conducteur
    public function conducteur()
    {
        return $this->hasOne(Conducteur::class, 'id_utilisateur');
    }

    // Relation avec Mission (missions créées par cet utilisateur)
    public function missions()
    {
        return $this->hasMany(Mission::class, 'id_utilisateur');
    }

    // Laravel attend 'password' pour l'auth, on redirige vers 'mot_de_passe'
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}
