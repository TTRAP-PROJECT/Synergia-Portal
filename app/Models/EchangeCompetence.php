<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ECHANGECOMPETENCE
 *
 * @property int $IDSERVICE
 * @property string $MATIERE
 * @property int $IDNIVEAU
 *
 * @property COUR $c_o_u_r
 * @property NIVEAU $n_i_v_e_a_u
 * @property SERVICE $s_e_r_v_i_c_e
 *
 * @package App\Models
 */
class ECHANGECOMPETENCE extends Model
{
	protected $table = 'ECHANGE_COMPETENCE';
	protected $primaryKey = 'IDSERVICE';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDSERVICE' => 'int',
		'MATIERE' => 'string',
		'IDNIVEAU' => 'int'
	];

	protected $fillable = [
		'MATIERE',
		'IDNIVEAU'
	];

	public function c_o_u_r()
	{
		return $this->belongsTo(Cour::class, 'MATIERE');
	}

	public function n_i_v_e_a_u()
	{
		return $this->belongsTo(Niveau::class, 'IDNIVEAU');
	}

	public function s_e_r_v_i_c_e()
	{
		return $this->belongsTo(Service::class, 'IDSERVICE');
	}

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'IDSERVICE');
    }

    public function getNumberOfReservationsAttribute()
    {
        return $this->reservations()->count();
    }
    public function hasReservations($userID)
    {
        return $this->reservations()->where('IDACHETEUR', $userID)->exists();
    }

}
