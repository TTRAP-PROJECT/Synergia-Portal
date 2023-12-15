<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * 
 * @property int $idpermission
 * @property string $libellepermission
 * @property int $niveaupermission
 * 
 * @property Collection|Autoriser[] $autorisers
 *
 * @package App\Models
 */
class Permission extends Model
{
	protected $table = 'permissions';
	protected $primaryKey = 'idpermission';
	public $timestamps = false;

	protected $casts = [
		'niveaupermission' => 'int'
	];

	protected $fillable = [
		'libellepermission',
		'niveaupermission'
	];

	public function autorisers()
	{
		return $this->hasMany(Autoriser::class, 'idpermission');
	}
}
