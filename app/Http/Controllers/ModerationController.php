<?php

namespace App\Http\Controllers;

use App\Models\LogsPayement;
use App\Models\Reservation;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ModerationController extends Controller
{

    public function index(Request $request)
    {
        $maintenant = Carbon::now();

        if (!auth()->user()->hasPermission(1)) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'avez pas la permission d\'accéder à cette page.');
        }

        // Pour les statistiques
        $nbStatut4 = Service::where('IDSTATUT', 4)->count();
        $nbStatut3 = Service::where('IDSTATUT', 3)->count();
        $nbStatutReste = Service::whereNotIn('IDSTATUT', [3, 4])->count();

        $allServices = Service::all();


        $nbReserv2 = Reservation::where('DATETRANSACTION', '>=', $maintenant->subDays(2))->count();
        $nbReserv7 = Reservation::where('DATETRANSACTION', '>=', $maintenant->subDays(7))->count();
        $nbReserv30 = Reservation::where('DATETRANSACTION', '>=', $maintenant->subMonth())->count();

        $services = Service::orderBy('DATEPUBLICATION', 'desc')->paginate(10);
        $logs = LogsPayement::orderBy('DATEPAYEMENT', 'desc')->paginate(20);

        return view('moderation.moderationPage',
            compact('services', 'allServices', 'logs',
                'nbStatut4', 'nbStatut3', 'nbStatutReste',
                'nbReserv2', 'nbReserv7', 'nbReserv30'));
    }



    public function changerStatutService(Request $request)
    {
        if (!auth()->user()->hasPermission(1)) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'avez pas la permission d\'accéder à cette page.');
        }

        // Récupérer l'ID du service et le nouveau statut depuis la requête
        $idService = $request->input('idService');
        $nouveauStatut = $request->input('nouveauStatut');

        // Rechercher le service correspondant dans la base de données
        $service = Service::find($idService);

        // Vérifier si le service existe
        if (empty($service)) {
            // Rediriger avec un message d'erreur si le service n'existe pas
            return redirect()->route('moderation')->with("error", "Le service spécifié n'existe pas");
        } else {
            // Mettre à jour le statut du service
            $service->IDSTATUT = $nouveauStatut;
            $service->save();

            // Déterminer le message en fonction du nouveau statut
            switch ($nouveauStatut) {
                case 1:
                    $message = "Le service a été activé";
                    break;
                case 3:
                    $message = "Le service a été mis en attente";
                    break;
                case 4:
                    $message = "Le service a été désactivé";
                    break;
                default:
                    $message = "Statut invalide";
            }

            // Rediriger avec un message de succès
            return redirect()->route('moderation')->with("success", $message);
        }
    }

    public function searchServices(Request $request)
    {
        $keyword = $request->input('keyword');

        // Effectuez votre recherche de services basée sur le mot-clé

        $services = Service::where('LIBELLESERVICE', 'like', '%' . $keyword . '%')
            ->orderBy('DATEPUBLICATION', 'desc')
            ->paginate(10);

        // Retournez les résultats de la recherche sous forme de vue partielle ou de JSON
        return view('moderation.services_partial', compact('services'));
    }



}
