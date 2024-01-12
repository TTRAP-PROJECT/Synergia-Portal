<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TYPELOISIR
 * 
 * @property int $IDLOISIR
 * @property string $LIBELLELOISIR
 * 
 * @property Collection|LOISIR[] $l_o_i_s_i_r_s
 *
 * @package App\Models
 */
class TYPELOISIR extends Model
{
	protected $table = 'TYPE_LOISIR';
	protected $primaryKey = 'IDLOISIR';
	public $timestamps = false;

	protected $fillable = [
		'LIBELLELOISIR'
	];

	public function l_o_i_s_i_r_s()
	{
		return $this->hasMany(LOISIR::class, 'IDLOISIR');
	}
}
