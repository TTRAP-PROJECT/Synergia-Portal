<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    use HasFactory;

    protected $table = 'SONDAGE';
    protected $primaryKey = 'IDSONDAGE';
    public $timestamps = false;

    // Supprimer les propriétés $fillable et $dates liées aux colonnes "POUR" et "CONTRE"

    // Définir la relation avec le modèle AvoteSondage
    public function votes()
    {
        return $this->hasMany(AvoteSondage::class, 'IDSONDAGE', 'IDSONDAGE');
    }
}
