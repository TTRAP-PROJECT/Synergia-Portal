<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class STATUTSERVICE
 *
 * @property int $IDSTATUT
 * @property string $LIBELLESTATUT
 *
 * @property Collection|SERVICE[] $s_e_r_v_i_c_e_s
 *
 * @package App\Models
 */
class STATUTSERVICE extends Model
{
	protected $table = 'STATUT_SERVICE';
	protected $primaryKey = 'IDSTATUT';
	public $timestamps = false;

	protected $fillable = [
		'LIBELLESTATUT'
	];

	public function s_e_r_v_i_c_e_s()
	{
		return $this->hasMany(Service::class, 'IDSTATUT');
	}
}
