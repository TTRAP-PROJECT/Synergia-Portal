<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property int $idservice
 * @property int $idstatut
 * @property string $libelleservice
 * 
 * @property StatutService $statut_service
 * @property Loisir $loisir
 * @property EvenementSportif $evenement_sportif
 * @property EchangeCompetence $echange_competence
 * @property Collection|Annonce[] $annonces
 * @property Covoiturage $covoiturage
 * @property Cinema $cinema
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'services';
	protected $primaryKey = 'idservice';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idservice' => 'int',
		'idstatut' => 'int'
	];

	protected $fillable = [
		'idstatut',
		'libelleservice'
	];

	public function statut_service()
	{
		return $this->belongsTo(StatutService::class, 'idstatut');
	}

	public function loisir()
	{
		return $this->hasOne(Loisir::class, 'idservice');
	}

	public function evenement_sportif()
	{
		return $this->hasOne(EvenementSportif::class, 'idservice');
	}

	public function echange_competence()
	{
		return $this->hasOne(EchangeCompetence::class, 'idservice');
	}

	public function annonces()
	{
		return $this->hasMany(Annonce::class, 'idservice');
	}

	public function covoiturage()
	{
		return $this->hasOne(Covoiturage::class, 'idservice');
	}

	public function cinema()
	{
		return $this->hasOne(Cinema::class, 'idservice');
	}
}
