<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsPayement extends Model
{
    use HasFactory;

    protected $table = 'logs_payement';
    protected $primaryKey = 'IDPAYEMENT';
    public $timestamps = false;

    protected $fillable = [
        'IDUTILISATEUR',
        'MONTANTPAYEMENT',
        'TRANSACTION',
        'DATEPAYEMENT',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'IDUTILISATEUR');
    }
}

