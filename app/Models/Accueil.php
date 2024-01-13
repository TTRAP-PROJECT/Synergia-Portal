<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ACCUEIL
 * 
 * @property int $IDUTILISATEUR
 * 
 * @property UTILISATEUR $u_t_i_l_i_s_a_t_e_u_r
 *
 * @package App\Models
 */
class ACCUEIL extends Model
{
    public function get_api_donnees_accueil()
    {
        // Utiliser cURL pour récupérer des données depuis une adresse IP
        $adresseIP = '192.168.125.11:81';
        $url = "http://{$adresseIP}/api/annonces";

        $ch = curl_init($url);

        // Configurer les options cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Exécuter la requête cURL
        $response = curl_exec($ch);

        // Fermer la session cURL
        curl_close($ch);

        // Traiter la réponse
        if ($response) {
            $donnees = json_decode($response, true);
            // Maintenant, vous pouvez utiliser $donnees pour afficher les données dans votre écran Laravel
            // Exemple : return view('nom_vue', compact('donnees'));
        } else {
            // Gérer les erreurs si la requête échoue
            // Exemple : return view('erreur_vue');
        }

        return view('dashboard', compact('donnees'));
    }
}
