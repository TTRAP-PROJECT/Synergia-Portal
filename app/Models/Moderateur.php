<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Moderateur
 * 
 * @property int $idutilisateur
 * @property int $rÉputation
 * 
 * @property Utilisateur $utilisateur
 * @property Collection|Etudiant[] $etudiants
 * @property Collection|Annonce[] $annonces
 *
 * @package App\Models
 */
class Moderateur extends Model
{
	protected $table = 'moderateur';
	protected $primaryKey = 'idutilisateur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idutilisateur' => 'int',
		'rÉputation' => 'int'
	];

	protected $fillable = [
		'rÉputation'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idutilisateur');
	}

	public function etudiants()
	{
		return $this->hasMany(Etudiant::class, 'idutilisateur_1');
	}

	public function annonces()
	{
		return $this->hasMany(Annonce::class, 'idutilisateur_2');
	}
}
