<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Sondage extends Model
{
    use HasFactory;

    protected $table = 'SONDAGE';
    protected $primaryKey = 'IDSONDAGE';
    public $timestamps = false;

    protected $fillable = [
        'IDUTILISATEUR',
        'NOMSONDAGE',
        'DATEDEBUT',
        'DATEFIN'
    ];
    // Supprimer les propriétés $fillable et $dates liées aux colonnes "POUR" et "CONTRE"

    // Définir la relation avec le modèle AvoteSondage
    public function votes()
    {
        return $this->hasMany(AvoteSondage::class, 'IDSONDAGE', 'IDSONDAGE');
    }

    // Scope pour récupérer uniquement les sondages actifs
    public function scopeActif($query)
    {
        // Date actuelle
        $now = Carbon::now()->toDateString();

        return $query->where('DATEDEBUT', '<=', $now)
            ->where('DATEFIN', '>=', $now);
    }
}
