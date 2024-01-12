<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CLASSE
 * 
 * @property int $IDSPECIALITE
 * @property string $LIBELLESPECIALITE
 * 
 * @property Collection|COUR[] $c_o_u_r_s
 * @property Collection|REL2[] $r_e_l2_s
 *
 * @package App\Models
 */
class CLASSE extends Model
{
	protected $table = 'CLASSE';
	protected $primaryKey = 'IDSPECIALITE';
	public $timestamps = false;

	protected $fillable = [
		'LIBELLESPECIALITE'
	];

	public function c_o_u_r_s()
	{
		return $this->hasMany(COUR::class, 'IDSPECIALITE');
	}

	public function r_e_l2_s()
	{
		return $this->hasMany(REL2::class, 'IDSPECIALITE');
	}
}
