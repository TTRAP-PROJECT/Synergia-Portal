<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etudiant
 * 
 * @property int $idutilisateur
 * @property int $idniveau
 * @property int|null $idutilisateur_1
 * @property Carbon|null $datevalidation
 * @property string $motdepasse
 * 
 * @property Utilisateur $utilisateur
 * @property Niveau $niveau
 * @property Moderateur|null $moderateur
 * @property Collection|Annonce[] $annonces
 * @property Collection|Rel2[] $rel2s
 * @property Collection|PossÉderbadge[] $posséderbadges
 *
 * @package App\Models
 */
class Etudiant extends Model
{
	protected $table = 'etudiant';
	protected $primaryKey = 'idutilisateur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idutilisateur' => 'int',
		'idniveau' => 'int',
		'idutilisateur_1' => 'int',
		'datevalidation' => 'datetime'
	];

	protected $fillable = [
		'idniveau',
		'idutilisateur_1',
		'datevalidation',
		'motdepasse'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idutilisateur');
	}

	public function niveau()
	{
		return $this->belongsTo(Niveau::class, 'idniveau');
	}

	public function moderateur()
	{
		return $this->belongsTo(Moderateur::class, 'idutilisateur_1');
	}

	public function annonces()
	{
		return $this->hasMany(Annonce::class, 'idutilisateur_1');
	}

	public function rel2s()
	{
		return $this->hasMany(Rel2::class, 'idutilisateur');
	}

	public function posséderbadges()
	{
		return $this->hasMany(PossÉderbadge::class, 'idutilisateur');
	}
}
