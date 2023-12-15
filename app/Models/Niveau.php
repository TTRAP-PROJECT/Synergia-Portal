<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Niveau
 * 
 * @property int $idniveau
 * @property string $libelleniveau
 * 
 * @property Collection|Etudiant[] $etudiants
 * @property Collection|EchangeCompetence[] $echange_competences
 *
 * @package App\Models
 */
class Niveau extends Model
{
	protected $table = 'niveau';
	protected $primaryKey = 'idniveau';
	public $timestamps = false;

	protected $fillable = [
		'libelleniveau'
	];

	public function etudiants()
	{
		return $this->hasMany(Etudiant::class, 'idniveau');
	}

	public function echange_competences()
	{
		return $this->hasMany(EchangeCompetence::class, 'idniveau');
	}
}
