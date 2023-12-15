<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StatutService
 * 
 * @property int $idstatut
 * @property string $libellestatut
 * 
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class StatutService extends Model
{
	protected $table = 'statut_service';
	protected $primaryKey = 'idstatut';
	public $timestamps = false;

	protected $fillable = [
		'libellestatut'
	];

	public function services()
	{
		return $this->hasMany(Service::class, 'idstatut');
	}
}
