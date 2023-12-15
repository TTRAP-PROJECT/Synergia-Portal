<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cour
 * 
 * @property int $idmatiere
 * @property int|null $idspecialite
 * @property string $libellematiere
 * 
 * @property Classe|null $classe
 * @property Collection|Professeur[] $professeurs
 * @property Collection|EchangeCompetence[] $echange_competences
 *
 * @package App\Models
 */
class Cour extends Model
{
	protected $table = 'cours';
	protected $primaryKey = 'idmatiere';
	public $timestamps = false;

	protected $casts = [
		'idspecialite' => 'int'
	];

	protected $fillable = [
		'idspecialite',
		'libellematiere'
	];

	public function classe()
	{
		return $this->belongsTo(Classe::class, 'idspecialite');
	}

	public function professeurs()
	{
		return $this->hasMany(Professeur::class, 'idmatiere');
	}

	public function echange_competences()
	{
		return $this->hasMany(EchangeCompetence::class, 'idmatiere');
	}
}
