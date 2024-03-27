<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ECHANGECOMPETENCE
 *
 * @property int $IDSERVICE
 * @property int $IDMATIERE
 * @property int $IDNIVEAU
 *
 * @property COUR $c_o_u_r
 * @property NIVEAU $n_i_v_e_a_u
 * @property SERVICE $s_e_r_v_i_c_e
 *
 * @package App\Models
 */
class ECHANGECOMPETENCE extends Model
{
	protected $table = 'ECHANGE_COMPETENCE';
	protected $primaryKey = 'IDSERVICE';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDSERVICE' => 'int',
		'IDMATIERE' => 'int',
		'IDNIVEAU' => 'int'
	];

	protected $fillable = [
		'IDMATIERE',
		'IDNIVEAU'
	];

	public function c_o_u_r()
	{
		return $this->belongsTo(Cour::class, 'IDMATIERE');
	}

	public function n_i_v_e_a_u()
	{
		return $this->belongsTo(Niveau::class, 'IDNIVEAU');
	}

	public function s_e_r_v_i_c_e()
	{
		return $this->belongsTo(Service::class, 'IDSERVICE');
	}
//    public function matiere()
//    {
//        return $this->belongsTo(COUR::class, 'IDMATIERE');
//    }
//
//    public function niveau()
//    {
//        return $this->belongsTo(Niveau::class, 'IDNIVEAU');
//    }

}
