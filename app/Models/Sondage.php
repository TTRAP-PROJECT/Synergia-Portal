<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    use HasFactory;

    protected $table = 'SONDAGE'; // Nom de votre table dans la base de données

    protected $primaryKey = 'IDSONDAGE'; // Nom de la clé primaire

    protected $fillable = [
        'NOMSONDAGE',
        'DATEDEBUT',
        'DATEFIN',
        'POUR',
        'CONTRE'
    ];

    // Vous pouvez spécifier les champs qui sont des dates pour Laravel.
    protected $dates = ['DATEDEBUT', 'DATEFIN'];

    // Si vous n'utilisez pas les timestamps (created_at et updated_at)
    public $timestamps = false;
}
