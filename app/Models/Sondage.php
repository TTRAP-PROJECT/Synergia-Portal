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

    protected $fillable = [
        'NOMSONDAGE',
        'DATEDEBUT',
        'DATEFIN',
        'POUR',
        'CONTRE'
    ];

    protected $dates = ['DATEDEBUT', 'DATEFIN'];

    // Définir la relation avec le modèle AvoteSondage
    public function votes()
    {
        return $this->hasMany(AvoteSondage::class, 'IDSONDAGE', 'IDSONDAGE');
    }
}
