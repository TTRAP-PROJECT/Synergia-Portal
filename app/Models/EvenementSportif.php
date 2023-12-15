<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EvenementSportif
 * 
 * @property int $idservice
 * @property int $idsport
 * @property Carbon $dateevent
 * 
 * @property Service $service
 * @property Sport $sport
 *
 * @package App\Models
 */
class EvenementSportif extends Model
{
	protected $table = 'evenement_sportif';
	protected $primaryKey = 'idservice';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idservice' => 'int',
		'idsport' => 'int',
		'dateevent' => 'datetime'
	];

	protected $fillable = [
		'idsport',
		'dateevent'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'idservice');
	}

	public function sport()
	{
		return $this->belongsTo(Sport::class, 'idsport');
	}
}
