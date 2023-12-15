<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Covoiturage
 * 
 * @property int $idservice
 * @property string $lieudepart
 * @property string $lieuarrive
 * @property Carbon $datecovoit
 * 
 * @property Service $service
 *
 * @package App\Models
 */
class Covoiturage extends Model
{
	protected $table = 'covoiturage';
	protected $primaryKey = 'idservice';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idservice' => 'int',
		'datecovoit' => 'datetime'
	];

	protected $fillable = [
		'lieudepart',
		'lieuarrive',
		'datecovoit'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'idservice');
	}
}
