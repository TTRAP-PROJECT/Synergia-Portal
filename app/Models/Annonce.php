<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $table = 'annonces';
    protected $primaryKey = 'ID_ANNONCE';
    public $timestamps = false;

    protected $fillable = [
        'TITRE_ANNONCE',
        'DESCRIPTION_ANNONCE',
        'DATE_PUBLICATION',
        'ID_MODERATEUR'
    ];

    protected $casts = [
        'ID_ANNONCE' => 'int',
        'ID_MODERATEUR' => 'int'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'ID_MODERATEUR');
    }
}
