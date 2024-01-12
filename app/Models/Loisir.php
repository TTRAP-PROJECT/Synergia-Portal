<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LOISIR
 * 
 * @property int $IDSERVICE
 * @property int $IDLOISIR
 * 
 * @property SERVICE $s_e_r_v_i_c_e
 * @property TYPELOISIR $t_y_p_e_l_o_i_s_i_r
 *
 * @package App\Models
 */
class LOISIR extends Model
{
	protected $table = 'LOISIR';
	protected $primaryKey = 'IDSERVICE';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDSERVICE' => 'int',
		'IDLOISIR' => 'int'
	];

	protected $fillable = [
		'IDLOISIR'
	];

	public function s_e_r_v_i_c_e()
	{
		return $this->belongsTo(SERVICE::class, 'IDSERVICE');
	}

	public function t_y_p_e_l_o_i_s_i_r()
	{
		return $this->belongsTo(TYPELOISIR::class, 'IDLOISIR');
	}
}
