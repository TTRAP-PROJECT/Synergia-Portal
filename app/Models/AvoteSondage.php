<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvoteSondage extends Model
{
    protected $table = 'A_VOTE_SONDAGE';
    protected $primaryKey = 'NUMEROVOTE';
    public $timestamps = false; // Comme il n'y a pas de colonnes created_at et updated_at dans votre table

    protected $fillable = [
        'IDSONDAGE', 'IDUTILISATEUR', 'AVIS'
    ];

    // Définir la relation avec le modèle Sondage
    public function sondage()
    {
        return $this->belongsTo(Sondage::class, 'IDSONDAGE', 'IDSONDAGE');
    }

    // Définir la relation avec le modèle UTILISATEUR
    public function utilisateur()
    {
        return $this->belongsTo(UTILISATEUR::class, 'IDUTILISATEUR', 'IDUTILISATEUR');
    }
}
