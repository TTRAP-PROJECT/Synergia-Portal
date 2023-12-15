<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Badge
 * 
 * @property int $idbadge
 * @property string $titrebadge
 * @property string|null $photobadge
 * 
 * @property Collection|PossÉderbadge[] $posséderbadges
 *
 * @package App\Models
 */
class Badge extends Model
{
	protected $table = 'badge';
	protected $primaryKey = 'idbadge';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idbadge' => 'int'
	];

	protected $fillable = [
		'titrebadge',
		'photobadge'
	];

	public function posséderbadges()
	{
		return $this->hasMany(PossÉderbadge::class, 'idbadge');
	}
}
