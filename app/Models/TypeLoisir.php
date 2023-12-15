<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeLoisir
 * 
 * @property int $idloisir
 * @property string $libelleloisir
 * 
 * @property Collection|Loisir[] $loisirs
 *
 * @package App\Models
 */
class TypeLoisir extends Model
{
	protected $table = 'type_loisir';
	protected $primaryKey = 'idloisir';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idloisir' => 'int'
	];

	protected $fillable = [
		'libelleloisir'
	];

	public function loisirs()
	{
		return $this->hasMany(Loisir::class, 'idloisir');
	}
}
