<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rel2
 * 
 * @property int $idspecialite
 * @property int $idutilisateur
 * 
 * @property Classe $classe
 * @property Etudiant $etudiant
 *
 * @package App\Models
 */
class Rel2 extends Model
{
	protected $table = 'rel_2';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idspecialite' => 'int',
		'idutilisateur' => 'int'
	];

	public function classe()
	{
		return $this->belongsTo(Classe::class, 'idspecialite');
	}

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class, 'idutilisateur');
	}
}
