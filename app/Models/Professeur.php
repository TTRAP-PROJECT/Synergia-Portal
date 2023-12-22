<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PROFESSEUR
 * 
 * @property int $IDPROF
 * @property int $IDMATIERE
 * @property int $IDUTILISATEUR
 * @property string $NOMPROF
 * @property string $PRENOMPROF
 * 
 * @property COUR $c_o_u_r
 * @property UTILISATEUR $u_t_i_l_i_s_a_t_e_u_r
 *
 * @package App\Models
 */
class PROFESSEUR extends Model
{
	protected $table = 'PROFESSEUR';
	protected $primaryKey = 'IDPROF';
	public $timestamps = false;

	protected $casts = [
		'IDMATIERE' => 'int',
		'IDUTILISATEUR' => 'int'
	];

	protected $fillable = [
		'IDMATIERE',
		'IDUTILISATEUR',
		'NOMPROF',
		'PRENOMPROF'
	];

	public function c_o_u_r()
	{
		return $this->belongsTo(COUR::class, 'IDMATIERE');
	}

	public function u_t_i_l_i_s_a_t_e_u_r()
	{
		return $this->belongsTo(UTILISATEUR::class, 'IDUTILISATEUR');
	}
}
