<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AUTORISER
 * 
 * @property int $IDPERMISSION
 * @property int $IDUTILISATEUR
 * 
 * @property PERMISSION $p_e_r_m_i_s_s_i_o_n
 * @property UTILISATEUR $u_t_i_l_i_s_a_t_e_u_r
 *
 * @package App\Models
 */
class AUTORISER extends Model
{
	protected $table = 'AUTORISER';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDPERMISSION' => 'int',
		'IDUTILISATEUR' => 'int'
	];

	public function p_e_r_m_i_s_s_i_o_n()
	{
		return $this->belongsTo(PERMISSION::class, 'IDPERMISSION');
	}

	public function u_t_i_l_i_s_a_t_e_u_r()
	{
		return $this->belongsTo(UTILISATEUR::class, 'IDUTILISATEUR');
	}
}
