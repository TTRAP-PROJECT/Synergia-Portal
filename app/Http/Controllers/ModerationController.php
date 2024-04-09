<?php

namespace App\Http\Controllers;

use App\Models\LogsPayement;
use App\Models\Reservation;
use App\Models\SERVICE;
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
        $nbStatut4 = SERVICE::where('IDSTATUT', 4)->count();
        $nbStatut3 = SERVICE::where('IDSTATUT', 3)->count();
        $nbStatutReste = SERVICE::whereNotIn('IDSTATUT', [3, 4])->count();

        $allServices = SERVICE::all();


        $nbReserv2 = Reservation::where('DATETRANSACTION', '>=', $maintenant->subDays(2))->count();
        $nbReserv7 = Reservation::where('DATETRANSACTION', '>=', $maintenant->subDays(7))->count();
        $nbReserv30 = Reservation::where('DATETRANSACTION', '>=', $maintenant->subMonth())->count();

        $services = SERVICE::orderBy('DATEPUBLICATION', 'desc')->paginate(10);
        $logs = LogsPayement::orderBy('DATEPAYEMENT', 'desc')->get();

        return view('moderation.moderationPage',
            compact('services', 'allServices', 'logs',
                'nbStatut4', 'nbStatut3', 'nbStatutReste',
                'nbReserv2', 'nbReserv7', 'nbReserv30'));
    }



    public function desactiverService(Request $request)
    {
        $service=SERVICE::find($request->input('idService'));
        if (empty($service))
        {
            return redirect()->route('moderation')->with("error', 'Le service spécifié n'existe pas");
        }
        else
        {
            $service->IDSTATUT=4;
            $service->save();
            return redirect()->route('moderation')->with("sucess', 'Le service a été désactiver");
        }
    }
}
