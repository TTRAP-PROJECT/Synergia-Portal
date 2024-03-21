<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvoteSondage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'A_VOTE_SONDAGE';
    protected $primaryKey = 'NUMEROVOTE';
    public $incrementing = true; // Vous avez spécifié que la colonne est auto-incrémentée

    protected $fillable = [
        'IDSONDAGE',
        'IDUTILISATEUR',
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
