<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ADMINISTRATION
 * 
 * @property int $IDUTILISATEUR
 * 
 * @property UTILISATEUR $u_t_i_l_i_s_a_t_e_u_r
 *
 * @package App\Models
 */
class ADMINISTRATION extends Model
{
	protected $table = 'ADMINISTRATION';
	protected $primaryKey = 'IDUTILISATEUR';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDUTILISATEUR' => 'int'
	];

	public function u_t_i_l_i_s_a_t_e_u_r()
	{
		return $this->belongsTo(UTILISATEUR::class, 'IDUTILISATEUR');
	}
}
