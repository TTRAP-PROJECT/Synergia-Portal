<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PERMISSION
 * 
 * @property int $IDPERMISSION
 * @property string $LIBELLEPERMISSION
 * @property int $NIVEAUPERMISSION
 * 
 * @property Collection|AUTORISER[] $a_u_t_o_r_i_s_e_r_s
 *
 * @package App\Models
 */
class PERMISSION extends Model
{
	protected $table = 'PERMISSIONS';
	protected $primaryKey = 'IDPERMISSION';
	public $timestamps = false;

	protected $casts = [
		'NIVEAUPERMISSION' => 'int'
	];

	protected $fillable = [
		'LIBELLEPERMISSION',
		'NIVEAUPERMISSION'
	];

	public function a_u_t_o_r_i_s_e_r_s()
	{
		return $this->hasMany(AUTORISER::class, 'IDPERMISSION');
	}
}
