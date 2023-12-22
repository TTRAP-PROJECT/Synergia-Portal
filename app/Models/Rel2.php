<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class REL2
 * 
 * @property int $IDSPECIALITE
 * @property int $IDUTILISATEUR
 * 
 * @property CLASSE $c_l_a_s_s_e
 * @property ETUDIANT $e_t_u_d_i_a_n_t
 *
 * @package App\Models
 */
class REL2 extends Model
{
	protected $table = 'REL_2';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDSPECIALITE' => 'int',
		'IDUTILISATEUR' => 'int'
	];

	public function c_l_a_s_s_e()
	{
		return $this->belongsTo(CLASSE::class, 'IDSPECIALITE');
	}

	public function e_t_u_d_i_a_n_t()
	{
		return $this->belongsTo(ETUDIANT::class, 'IDUTILISATEUR');
	}
}
