<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cinema
 * 
 * @property int $idservice
 * @property string $lieufilm
 * @property string $nomfilm
 * @property Carbon $dateheurefilm
 * 
 * @property Service $service
 *
 * @package App\Models
 */
class Cinema extends Model
{
	protected $table = 'cinema';
	protected $primaryKey = 'idservice';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idservice' => 'int',
		'dateheurefilm' => 'datetime'
	];

	protected $fillable = [
		'lieufilm',
		'nomfilm',
		'dateheurefilm'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'idservice');
	}
}
