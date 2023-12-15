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
 * Class Utilisateur
 * 
 * @property int $idutilisateur
 * @property string $nomutilisateur
 * @property string $prenomutilisateur
 * @property string $motdepasse
 * @property int|null $solde
 * @property string $emailutilisateur
 * 
 * @property Collection|Professeur[] $professeurs
 * @property Etudiant $etudiant
 * @property Administration $administration
 * @property Moderateur $moderateur
 * @property Collection|Autoriser[] $autorisers
 *
 * @package App\Models
 */
class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;
	protected $table = 'utilisateur';
	protected $primaryKey = 'idutilisateur';
	public $timestamps = false;

	protected $casts = [
		'solde' => 'int'
	];

	protected $fillable = [
		'nomutilisateur',
		'prenomutilisateur',
		'motdepasse',
		'solde',
		'emailutilisateur'
	];

	public function professeurs()
	{
		return $this->hasMany(Professeur::class, 'idutilisateur');
	}

	public function etudiant()
	{
		return $this->hasOne(Etudiant::class, 'idutilisateur');
	}

	public function administration()
	{
		return $this->hasOne(Administration::class, 'idutilisateur');
	}

	public function moderateur()
	{
		return $this->hasOne(Moderateur::class, 'idutilisateur');
	}

	public function autorisers()
	{
		return $this->hasMany(Autoriser::class, 'idutilisateur');
	}

	    /**
     * Retourne le mot de passe de l'utilisateur
     */
    public function getAuthPassword()
    {
        return $this->motdepasse;
    }

    /**
     * Retourne l'identifiant de l'utilisateur
     */
    public function getAuthIdentifier()
    {
        return $this->emailutilisateur;
    }

    /**
     * Retourne le nom de l'identifiant de l'utilisateur
     */
    public function getAuthIdentifierName()
    {
        return 'emailutilisateur';
    }
}
