<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EVENEMENTSPORTIF
 *
 * @property int $IDSERVICE
 * @property string $LIBELLESPORT
 * @property Carbon $DATEEVENT
 *
 * @property SERVICE $s_e_r_v_i_c_e
 * @property SPORT $s_p_o_r_t
 *
 * @package App\Models
 */
class EVENEMENTSPORTIF extends Model
{
	protected $table = 'EVENEMENT_SPORTIF';
	protected $primaryKey = 'IDSERVICE';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDSERVICE' => 'int',
		'SPORT' => 'string',
		'DATEEVENT' => 'datetime'
	];

	protected $fillable = [
		'LIBELLESPORT',
		'DATEEVENT'
	];

	public function s_e_r_v_i_c_e()
	{
		return $this->belongsTo(SERVICE::class, 'IDSERVICE');
	}

	public function s_p_o_r_t()
	{
		return $this->belongsTo(SPORT::class, 'LIBELLESPORT');
	}

    public function sport()
    {
        return $this->belongsTo(SPORT::class, 'LIBELLESPORT', 'LIBELLESPORT');
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
