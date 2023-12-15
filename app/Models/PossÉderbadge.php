<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PossÉderbadge
 * 
 * @property int $idbadge
 * @property int $idutilisateur
 * 
 * @property Badge $badge
 * @property Etudiant $etudiant
 *
 * @package App\Models
 */
class PossÉderbadge extends Model
{
	protected $table = 'possÉderbadge';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idbadge' => 'int',
		'idutilisateur' => 'int'
	];

	public function badge()
	{
		return $this->belongsTo(Badge::class, 'idbadge');
	}

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class, 'idutilisateur');
	}
}
