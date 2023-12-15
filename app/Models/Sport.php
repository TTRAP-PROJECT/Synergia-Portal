<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sport
 * 
 * @property int $idsport
 * @property string $libellesport
 * 
 * @property Collection|EvenementSportif[] $evenement_sportifs
 *
 * @package App\Models
 */
class Sport extends Model
{
	protected $table = 'sport';
	protected $primaryKey = 'idsport';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idsport' => 'int'
	];

	protected $fillable = [
		'libellesport'
	];

	public function evenement_sportifs()
	{
		return $this->hasMany(EvenementSportif::class, 'idsport');
	}
}
