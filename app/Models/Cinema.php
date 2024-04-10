<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CINEMA
 *
 * @property int $IDSERVICE
 * @property string $LIEUFILM
 * @property string $NOMFILM
 * @property Carbon $DATEHEUREFILM
 *
 * @property SERVICE $s_e_r_v_i_c_e
 *
 * @package App\Models
 */
class CINEMA extends Model
{
	protected $table = 'CINEMA';
	protected $primaryKey = 'IDSERVICE';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDSERVICE' => 'int',
		'DATEHEUREFILM' => 'datetime'
	];

	protected $fillable = [
		'LIEUFILM',
		'NOMFILM',
		'DATEHEUREFILM'
	];

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
