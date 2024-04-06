<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SERVICE
 *
 * @property int $IDSERVICE
 * @property int $IDSTATUT
 * @property string $LIBELLESERVICE
 * @property int $typeService
 * @property int $prix
 * @property string $description
 *
 * @property STATUTSERVICE $s_t_a_t_u_t_s_e_r_v_i_c_e
 * @property Collection|ANNONCE[] $a_n_n_o_n_c_e_s
 * @property CINEMA $c_i_n_e_m_a
 * @property COVOITURAGE $c_o_v_o_i_t_u_r_a_g_e
 * @property ECHANGECOMPETENCE $e_c_h_a_n_g_e_c_o_m_p_e_t_e_n_c_e
 * @property EVENEMENTSPORTIF $e_v_e_n_e_m_e_n_t_s_p_o_r_t_i_f
 * @property LOISIR $l_o_i_s_i_r
 *
 * @package App\Models
 */
class SERVICE extends Model
{
	protected $table = 'SERVICES';
	protected $primaryKey = 'IDSERVICE';
	public $timestamps = false;

    // cast : Type
	protected $casts = [
		'IDSTATUT' => 'int',
        'typeService' => 'int',
        'prix' => 'int',
        'description' => 'string'
	];

    // fillable : remplissable
	protected $fillable = [
		'IDSTATUT',
		'LIBELLESERVICE',
        'typeService',
        'prix',
        'description'
	];

	public function s_t_a_t_u_t_s_e_r_v_i_c_e()
	{
		return $this->belongsTo(STATUTSERVICE::class, 'IDSTATUT');
	}

	public function a_n_n_o_n_c_e_s()
	{
		return $this->hasMany(ANNONCE::class, 'IDSERVICE');
	}

	public function c_i_n_e_m_a()
	{
		return $this->hasOne(CINEMA::class, 'IDSERVICE');
	}

	public function c_o_v_o_i_t_u_r_a_g_e()
	{
		return $this->hasOne(COVOITURAGE::class, 'IDSERVICE');
	}

	public function e_c_h_a_n_g_e_c_o_m_p_e_t_e_n_c_e()
	{
		return $this->hasOne(ECHANGECOMPETENCE::class, 'IDSERVICE');
	}

	public function e_v_e_n_e_m_e_n_t_s_p_o_r_t_i_f()
	{
		return $this->hasOne(EVENEMENTSPORTIF::class, 'IDSERVICE');
	}

	public function l_o_i_s_i_r()
	{
		return $this->hasOne(LOISIR::class, 'IDSERVICE');
	}

    public function vendeur()
    {
        return $this->belongsTo(Utilisateur::class, 'IDVENDEUR');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'IDSERVICE');
    }

    public function getNumberOfReservationsAttribute()
    {
        return $this->reservations()->count();
    }



}
