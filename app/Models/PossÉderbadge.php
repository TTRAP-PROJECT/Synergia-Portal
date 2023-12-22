<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class POSSÉDERBADGE
 * 
 * @property int $IDBADGE
 * @property int $IDUTILISATEUR
 * 
 * @property BADGE $b_a_d_g_e
 * @property ETUDIANT $e_t_u_d_i_a_n_t
 *
 * @package App\Models
 */
class POSSÉDERBADGE extends Model
{
	protected $table = 'POSSÉDERBADGE';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDBADGE' => 'int',
		'IDUTILISATEUR' => 'int'
	];

	public function b_a_d_g_e()
	{
		return $this->belongsTo(BADGE::class, 'IDBADGE');
	}

	public function e_t_u_d_i_a_n_t()
	{
		return $this->belongsTo(ETUDIANT::class, 'IDUTILISATEUR');
	}
}
