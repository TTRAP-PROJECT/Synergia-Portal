<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Autoriser
 * 
 * @property int $idpermission
 * @property int $idutilisateur
 * 
 * @property Permission $permission
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Autoriser extends Model
{
	protected $table = 'autoriser';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idpermission' => 'int',
		'idutilisateur' => 'int'
	];

	public function permission()
	{
		return $this->belongsTo(Permission::class, 'idpermission');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idutilisateur');
	}
}
