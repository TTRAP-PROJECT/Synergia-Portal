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
        $url2="http://{$adresseIP}/api/sondages";


        $ch = curl_init($url);
        $ch2=curl_init($url2);

        // Configurer les options cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

        // Exécuter la requête cURL
        $response = curl_exec($ch);
        $response2 = curl_exec($ch2);

        // Fermer la session cURL
        curl_close($ch);
        curl_close($ch2);

        // Traiter la réponse
        if ($response) {
            $sondages = json_decode($response2, true);
            $donnees = json_decode($response, true);


            // Maintenant, vous pouvez utiliser $donnees pour afficher les données dans votre écran Laravel
            // Exemple : return view('nom_vue', compact('donnees'));
        } else {
            // Gérer les erreurs si la requête échoue
            // Exemple : return view('erreur_vue');
        }

        return view('dashboard', compact('donnees','sondages'));
    }
}
