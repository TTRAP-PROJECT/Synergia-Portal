<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class COUR
 * 
 * @property int $IDMATIERE
 * @property int|null $IDSPECIALITE
 * @property string $LIBELLEMATIERE
 * 
 * @property CLASSE|null $c_l_a_s_s_e
 * @property Collection|ECHANGECOMPETENCE[] $e_c_h_a_n_g_e_c_o_m_p_e_t_e_n_c_e_s
 * @property Collection|PROFESSEUR[] $p_r_o_f_e_s_s_e_u_r_s
 *
 * @package App\Models
 */
class COUR extends Model
{
	protected $table = 'COURS';
	protected $primaryKey = 'IDMATIERE';
	public $timestamps = false;

	protected $casts = [
		'IDSPECIALITE' => 'int'
	];

	protected $fillable = [
		'IDSPECIALITE',
		'LIBELLEMATIERE'
	];

	public function c_l_a_s_s_e()
	{
		return $this->belongsTo(CLASSE::class, 'IDSPECIALITE');
	}

	public function e_c_h_a_n_g_e_c_o_m_p_e_t_e_n_c_e_s()
	{
		return $this->hasMany(ECHANGECOMPETENCE::class, 'IDMATIERE');
	}

	public function p_r_o_f_e_s_s_e_u_r_s()
	{
		return $this->hasMany(PROFESSEUR::class, 'IDMATIERE');
	}
}
