<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MODERATEUR
 * 
 * @property int $IDUTILISATEUR
 * @property int $RÉPUTATION
 * 
 * @property UTILISATEUR $u_t_i_l_i_s_a_t_e_u_r
 * @property Collection|ANNONCE[] $a_n_n_o_n_c_e_s
 * @property Collection|ETUDIANT[] $e_t_u_d_i_a_n_t_s
 *
 * @package App\Models
 */
class MODERATEUR extends Model
{
	protected $table = 'MODERATEUR';
	protected $primaryKey = 'IDUTILISATEUR';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDUTILISATEUR' => 'int',
		'RÉPUTATION' => 'int'
	];

	protected $fillable = [
		'RÉPUTATION'
	];

	public function u_t_i_l_i_s_a_t_e_u_r()
	{
		return $this->belongsTo(UTILISATEUR::class, 'IDUTILISATEUR');
	}

	public function a_n_n_o_n_c_e_s()
	{
		return $this->hasMany(ANNONCE::class, 'IDUTILISATEUR_2');
	}

	public function e_t_u_d_i_a_n_t_s()
	{
		return $this->hasMany(ETUDIANT::class, 'IDUTILISATEUR_1');
	}
}
