<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BADGE
 * 
 * @property int $IDBADGE
 * @property string $TITREBADGE
 * @property string|null $PHOTOBADGE
 * 
 * @property Collection|POSSÉDERBADGE[] $p_o_s_sé_d_e_r_b_a_d_g_e_s
 *
 * @package App\Models
 */
class BADGE extends Model
{
	protected $table = 'BADGE';
	protected $primaryKey = 'IDBADGE';
	public $timestamps = false;

	protected $fillable = [
		'TITREBADGE',
		'PHOTOBADGE'
	];

	public function p_o_s_sé_d_e_r_b_a_d_g_e_s()
	{
		return $this->hasMany(POSSÉDERBADGE::class, 'IDBADGE');
	}
}
