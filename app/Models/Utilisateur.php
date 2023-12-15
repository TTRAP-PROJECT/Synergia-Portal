<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateur
 * 
 * @property int $idutilisateur
 * @property string $nomutilisateur
 * @property string $prenomutilisateur
 * @property string $motdepasse
 * @property int|null $solde
 * 
 * @property Collection|Professeur[] $professeurs
 * @property Etudiant $etudiant
 * @property Moderateur $moderateur
 * @property Administration $administration
 * @property Collection|Autoriser[] $autorisers
 *
 * @package App\Models
 */
class Utilisateur extends Model
{
	protected $table = 'utilisateur';
	protected $primaryKey = 'idutilisateur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idutilisateur' => 'int',
		'solde' => 'int'
	];

	protected $fillable = [
		'nomutilisateur',
		'prenomutilisateur',
		'motdepasse',
		'solde'
	];

	public function professeurs()
	{
		return $this->hasMany(Professeur::class, 'idutilisateur');
	}

	public function etudiant()
	{
		return $this->hasOne(Etudiant::class, 'idutilisateur');
	}

	public function moderateur()
	{
		return $this->hasOne(Moderateur::class, 'idutilisateur');
	}

	public function administration()
	{
		return $this->hasOne(Administration::class, 'idutilisateur');
	}

	public function autorisers()
	{
		return $this->hasMany(Autoriser::class, 'idutilisateur');
	}
}
