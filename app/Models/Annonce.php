<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Annonce
 * 
 * @property int $idannonce
 * @property int $idservice
 * @property int $idutilisateur
 * @property int $idutilisateur_1
 * @property int $idutilisateur_2
 * @property string $titreannonce
 * @property string|null $descriptionannonce
 * @property string $coutannonce
 * @property Carbon $datepublicationannonce
 * @property Carbon $datetransaction
 * @property Carbon $dateprevue
 * 
 * @property Service $service
 * @property Etudiant $etudiant
 * @property Moderateur $moderateur
 *
 * @package App\Models
 */
class Annonce extends Model
{
	protected $table = 'annonce';
	protected $primaryKey = 'idannonce';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idannonce' => 'int',
		'idservice' => 'int',
		'idutilisateur' => 'int',
		'idutilisateur_1' => 'int',
		'idutilisateur_2' => 'int',
		'datepublicationannonce' => 'datetime',
		'datetransaction' => 'datetime',
		'dateprevue' => 'datetime'
	];

	protected $fillable = [
		'idservice',
		'idutilisateur',
		'idutilisateur_1',
		'idutilisateur_2',
		'titreannonce',
		'descriptionannonce',
		'coutannonce',
		'datepublicationannonce',
		'datetransaction',
		'dateprevue'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'idservice');
	}

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class, 'idutilisateur_1');
	}

	public function moderateur()
	{
		return $this->belongsTo(Moderateur::class, 'idutilisateur_2');
	}
}
