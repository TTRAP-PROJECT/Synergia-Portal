<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Professeur
 * 
 * @property int $idprof
 * @property int $idmatiere
 * @property int $idutilisateur
 * @property string $nomprof
 * @property string $prenomprof
 * 
 * @property Cour $cour
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Professeur extends Model
{
	protected $table = 'professeur';
	protected $primaryKey = 'idprof';
	public $timestamps = false;

	protected $casts = [
		'idmatiere' => 'int',
		'idutilisateur' => 'int'
	];

	protected $fillable = [
		'idmatiere',
		'idutilisateur',
		'nomprof',
		'prenomprof'
	];

	public function cour()
	{
		return $this->belongsTo(Cour::class, 'idmatiere');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idutilisateur');
	}
}
