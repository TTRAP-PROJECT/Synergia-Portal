<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Loisir
 * 
 * @property int $idservice
 * @property int $idloisir
 * 
 * @property Service $service
 * @property TypeLoisir $type_loisir
 *
 * @package App\Models
 */
class Loisir extends Model
{
	protected $table = 'loisir';
	protected $primaryKey = 'idservice';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idservice' => 'int',
		'idloisir' => 'int'
	];

	protected $fillable = [
		'idloisir'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'idservice');
	}

	public function type_loisir()
	{
		return $this->belongsTo(TypeLoisir::class, 'idloisir');
	}
}
