<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Classe
 * 
 * @property int $idspecialite
 * @property string $libellespecialite
 * 
 * @property Collection|Cour[] $cours
 * @property Collection|Rel2[] $rel2s
 *
 * @package App\Models
 */
class Classe extends Model
{
	protected $table = 'classe';
	protected $primaryKey = 'idspecialite';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idspecialite' => 'int'
	];

	protected $fillable = [
		'libellespecialite'
	];

	public function cours()
	{
		return $this->hasMany(Cour::class, 'idspecialite');
	}

	public function rel2s()
	{
		return $this->hasMany(Rel2::class, 'idspecialite');
	}
}
