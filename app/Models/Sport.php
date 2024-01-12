<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SPORT
 * 
 * @property int $IDSPORT
 * @property string $LIBELLESPORT
 * 
 * @property Collection|EVENEMENTSPORTIF[] $e_v_e_n_e_m_e_n_t_s_p_o_r_t_i_f_s
 *
 * @package App\Models
 */
class SPORT extends Model
{
	protected $table = 'SPORT';
	protected $primaryKey = 'IDSPORT';
	public $timestamps = false;

	protected $fillable = [
		'LIBELLESPORT'
	];

	public function e_v_e_n_e_m_e_n_t_s_p_o_r_t_i_f_s()
	{
		return $this->hasMany(EVENEMENTSPORTIF::class, 'IDSPORT');
	}
}
