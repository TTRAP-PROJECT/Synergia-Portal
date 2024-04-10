<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Class UTILISATEUR
 *
 * @property int $IDUTILISATEUR
 * @property string $NOMUTILISATEUR
 * @property string $PRENOMUTILISATEUR
 * @property string $EMAILUTILISATEUR
 * @property string $MOTDEPASSE
 * @property int|null $SOLDE
 *
 * @property ADMINISTRATION $a_d_m_i_n_i_s_t_r_a_t_i_o_n
 * @property Collection|AUTORISER[] $a_u_t_o_r_i_s_e_r_s
 * @property ETUDIANT $e_t_u_d_i_a_n_t
 * @property MODERATEUR $m_o_d_e_r_a_t_e_u_r
 * @property Collection|PROFESSEUR[] $p_r_o_f_e_s_s_e_u_r_s
 *
 * @package App\Models
 */
class UTILISATEUR extends Authenticatable
{
	use HasFactory, Notifiable;

	protected $table = 'UTILISATEUR';
	protected $primaryKey = 'IDUTILISATEUR';
	public $timestamps = false;

	protected $casts = [
		'SOLDE' => 'int'
	];

	protected $fillable = [
		'NOMUTILISATEUR',
		'PRENOMUTILISATEUR',
		'EMAILUTILISATEUR',
		'MOTDEPASSE',
		'SOLDE',
        'NBCOOKIES'
	];

	public function a_d_m_i_n_i_s_t_r_a_t_i_o_n()
	{
		return $this->hasOne(Administration::class, 'IDUTILISATEUR');
	}

	public function a_u_t_o_r_i_s_e_r_s()
	{
		return $this->hasMany(Autoriser::class, 'IDUTILISATEUR');
	}

	public function e_t_u_d_i_a_n_t()
	{
		return $this->hasOne(Etudiant::class, 'IDUTILISATEUR');
	}

	public function m_o_d_e_r_a_t_e_u_r()
	{
		return $this->hasOne(Moderateur::class, 'IDUTILISATEUR');
	}

	public function p_r_o_f_e_s_s_e_u_r_s()
	{
		return $this->hasMany(Professeur::class, 'IDUTILISATEUR');
	}

	    /**
     * Retourne le mot de passe de l'utilisateur
     */
    public function getAuthPassword()
    {
        return $this->MOTDEPASSE;
    }

    /**
     * Retourne l'identifiant de l'utilisateur
     */
    public function getAuthIdentifier()
    {
        return $this->EMAILUTILISATEUR;
    }

    /**
     * Retourne le nom de l'identifiant de l'utilisateur
     */
    public function getAuthIdentifierName()
    {
        return 'EMAILUTILISATEUR';
    }

	public function gravatar($size = 80)
    {
        $email = $this->EMAILUTILISATEUR;
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size";

        return $url;
    }

    public function hasReservation($idService)
    {
        return $this->reservations()->where('IDACHETEUR', auth()->user()->IDUTILISATEUR)->exists();
    }

    public function hasPermission($IDPERMISSION)
    {
        return $this->a_u_t_o_r_i_s_e_r_s()->where('IDPERMISSION', $IDPERMISSION)->exists();
    }
}
