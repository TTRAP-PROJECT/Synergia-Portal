<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class COVOITURAGE
 *
 * @property int $IDSERVICE
 * @property string $LIEUDEPART
 * @property string $LIEUARRIVE
 * @property Carbon $DATECOVOIT
 *
 * @property SERVICE $s_e_r_v_i_c_e
 *
 * @package App\Models
 */
class COVOITURAGE extends Model
{
	protected $table = 'COVOITURAGE';
	protected $primaryKey = 'IDSERVICE';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IDSERVICE' => 'int',
		'DATECOVOIT' => 'datetime'
	];

	protected $fillable = [
		'LIEUDEPART',
		'LIEUARRIVE',
		'DATECOVOIT'
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
