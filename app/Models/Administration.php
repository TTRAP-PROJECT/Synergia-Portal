<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Administration
 * 
 * @property int $idutilisateur
 * 
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Administration extends Model
{
	protected $table = 'administration';
	protected $primaryKey = 'idutilisateur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idutilisateur' => 'int'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idutilisateur');
	}
}
