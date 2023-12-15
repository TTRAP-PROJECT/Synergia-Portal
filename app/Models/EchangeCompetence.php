<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EchangeCompetence
 * 
 * @property int $idservice
 * @property int $idmatiere
 * @property int $idniveau
 * 
 * @property Service $service
 * @property Cour $cour
 * @property Niveau $niveau
 *
 * @package App\Models
 */
class EchangeCompetence extends Model
{
	protected $table = 'echange_competence';
	protected $primaryKey = 'idservice';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idservice' => 'int',
		'idmatiere' => 'int',
		'idniveau' => 'int'
	];

	protected $fillable = [
		'idmatiere',
		'idniveau'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'idservice');
	}

	public function cour()
	{
		return $this->belongsTo(Cour::class, 'idmatiere');
	}

	public function niveau()
	{
		return $this->belongsTo(Niveau::class, 'idniveau');
	}
}
