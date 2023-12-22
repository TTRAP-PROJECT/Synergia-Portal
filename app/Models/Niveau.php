<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NIVEAU
 * 
 * @property int $IDNIVEAU
 * @property string $LIBELLENIVEAU
 * 
 * @property Collection|ECHANGECOMPETENCE[] $e_c_h_a_n_g_e_c_o_m_p_e_t_e_n_c_e_s
 * @property Collection|ETUDIANT[] $e_t_u_d_i_a_n_t_s
 *
 * @package App\Models
 */
class NIVEAU extends Model
{
	protected $table = 'NIVEAU';
	protected $primaryKey = 'IDNIVEAU';
	public $timestamps = false;

	protected $fillable = [
		'LIBELLENIVEAU'
	];

	public function e_c_h_a_n_g_e_c_o_m_p_e_t_e_n_c_e_s()
	{
		return $this->hasMany(ECHANGECOMPETENCE::class, 'IDNIVEAU');
	}

	public function e_t_u_d_i_a_n_t_s()
	{
		return $this->hasMany(ETUDIANT::class, 'IDNIVEAU');
	}
}
