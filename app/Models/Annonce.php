<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ANNONCE
 * 
 * @property int $IDANNONCE
 * @property int $IDSERVICE
 * @property int $IDUTILISATEUR
 * @property int $IDUTILISATEUR_1
 * @property int $IDUTILISATEUR_2
 * @property string $TITREANNONCE
 * @property string|null $DESCRIPTIONANNONCE
 * @property string $COUTANNONCE
 * @property Carbon $DATEPUBLICATIONANNONCE
 * @property Carbon $DATETRANSACTION
 * @property Carbon $DATEPREVUE
 * 
 * @property ETUDIANT $e_t_u_d_i_a_n_t
 * @property MODERATEUR $m_o_d_e_r_a_t_e_u_r
 * @property SERVICE $s_e_r_v_i_c_e
 *
 * @package App\Models
 */
class ANNONCE extends Model
{
	protected $table = 'ANNONCE';
	protected $primaryKey = 'IDANNONCE';
	public $timestamps = false;

	protected $casts = [
		'IDSERVICE' => 'int',
		'IDUTILISATEUR' => 'int',
		'IDUTILISATEUR_1' => 'int',
		'IDUTILISATEUR_2' => 'int',
		'DATEPUBLICATIONANNONCE' => 'datetime',
		'DATETRANSACTION' => 'datetime',
		'DATEPREVUE' => 'datetime'
	];

	protected $fillable = [
		'IDSERVICE',
		'IDUTILISATEUR',
		'IDUTILISATEUR_1',
		'IDUTILISATEUR_2',
		'TITREANNONCE',
		'DESCRIPTIONANNONCE',
		'COUTANNONCE',
		'DATEPUBLICATIONANNONCE',
		'DATETRANSACTION',
		'DATEPREVUE'
	];

	public function e_t_u_d_i_a_n_t()
	{
		return $this->belongsTo(ETUDIANT::class, 'IDUTILISATEUR_1');
	}

	public function m_o_d_e_r_a_t_e_u_r()
	{
		return $this->belongsTo(MODERATEUR::class, 'IDUTILISATEUR_2');
	}

	public function s_e_r_v_i_c_e()
	{
		return $this->belongsTo(SERVICE::class, 'IDSERVICE');
	}
}
