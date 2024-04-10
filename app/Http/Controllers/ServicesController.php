<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Covoiturage;
use App\Models\EchangeCompetence;
use App\Models\EvenementSportif;
use App\Models\Loisir;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Utilisateur;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function services()
    {

        $aujourdhui = Carbon::now();
        $services = Service::all();


        $evenementsSportif = EvenementSportif::whereHas('s_e_r_v_i_c_e', function ($query) use ($aujourdhui) {
            $query->where('DATEPREVUE', '>', $aujourdhui)
                ->where('IDSTATUT', '=', 1);
        })->get();

        $evenementCinema = Cinema::where('DATEHEUREFILM', '>', $aujourdhui)
            ->whereHas('s_e_r_v_i_c_e', function ($query) {
                $query->where('IDSTATUT', '=', 1);
            })
            ->get();
        $covoiturages = Covoiturage::where('DATECOVOIT', '>', $aujourdhui)
            ->whereHas('s_e_r_v_i_c_e', function ($query) {
                $query->where('IDSTATUT', '=', 1);
            })
            ->get();
        $echange_compets = EchangeCompetence::whereHas('s_e_r_v_i_c_e', function ($query) use ($aujourdhui) {
            $query->where('DATEPREVUE', '>', $aujourdhui)
                ->where('IDSTATUT', '=', 1);
        })->get();
        $loisirs = Loisir::whereHas('s_e_r_v_i_c_e', function ($query) use ($aujourdhui) {
            $query->where('DATEPREVUE', '>', $aujourdhui)
                ->where('IDSTATUT', '=', 1);
        })->get();





        return view('services',
            array('services' => $services,
                'evenementsSportif'=>$evenementsSportif,
                'evenementCinema'=>$evenementCinema,
                'covoiturages'=>$covoiturages,
                'competences'=>$echange_compets,
                'loisirs'=>$loisirs
            ));
    }

    public function dataList()
    {
        return view('suite_formulaire_service');
    }

    public function new(Request $request)
    {
        $date = $request->input('date');
        $heure = $request->input('heure');
        // Fusionner les deux variables pour former une date complète
        $dateComplete = $date . " " . $heure;
        // Convertir la date complète en objet DateTime
        $datePrevue = new DateTime($dateComplete);
        $idVendeur = Auth::user()->IDUTILISATEUR;
        $tableServices = [1 => 'Cinéma', 2 => 'Covoiturage', 5 => 'Loisir', 3 => 'Échange de compétences', 4 => 'Évènement sportif', 6 => 'Autre'];
        $libelleService = $tableServices[$request->input('services')];

        $service = new SERVICE();
        $service->IDSTATUT = 1;
        if($request->input('services')==2){

            $depart = $request->input('lieuDepart');
            $arrivee = $request->input('lieuArrivee');
            $libelle = "Covoiturage de ".$depart." à ".$arrivee;
            $service->LIBELLESERVICE = e($libelle);
        }
        else{
            $service->LIBELLESERVICE = e($request->input('nom'));
        }
        $service->description = $request->input('description');
        $service->prix = $request->input('prix');
        $service->lieu_service = $request->input('lieu');
        $service->IDVENDEUR = $idVendeur;
        $service->IDMODERATEUR = null;
        $service->datePublication = date('Y-m-d H:i:s');
        $service->datePrevue = $datePrevue;
        $service->NBPERSONNESMAX = $request->input('nbPersonneMax');
        $service->typeService = $request->input('typeService');
        $service->save();

        switch ($request->input('services')) {
            case '1':
                $cinema = new CINEMA();
                $cinema->IDSERVICE = $service->IDSERVICE;
                $cinema->LIEUFILM = $request->input('lieu');
                $cinema->NOMFILM = e($request->input('nom'));
                $cinema->DATEHEUREFILM = $datePrevue;
                $cinema->save();
                break;
            case '2': // Covoiturage
                $service->lieu_service = null;
                $covoiturage = new COVOITURAGE();
                $covoiturage->IDSERVICE = $service->IDSERVICE;;
                $covoiturage->LIEUDEPART = $request->input('lieuDepart');
                $covoiturage->LIEUARRIVEE = $request->input('lieuArrivee');
                $covoiturage->DATECOVOIT = $datePrevue;
                $covoiturage->save();
                break;
            case '3': // échange de compétences
                $echangecompetence = new ECHANGECOMPETENCE();
                $echangecompetence->IDSERVICE = $service->IDSERVICE;;
                $echangecompetence->MATIERE = $request->input('nom');
                $echangecompetence->IDNIVEAU = $request->input('niveau');
                $echangecompetence->save();
                break;

            case '4': // évenement sportif
                $evenementsportif = new EVENEMENTSPORTIF();
                $evenementsportif->IDSERVICE = $service->IDSERVICE;;
                $evenementsportif->LIBELLESPORT = $request->input('nom');
                $evenementsportif->LIEUEVENT = $request->input('lieu');
                $evenementsportif->DATEEVENT = $datePrevue;
                $evenementsportif->save();
                break;

            case '5': // Loisir
                $loisir = new LOISIR();
                $loisir->IDSERVICE = $service->IDSERVICE;;
                $loisir->LIBELLELOISIR = $request->input('nom');
                $loisir->save();
                break;
            case '6':
                break;
            default:
                break;
        }
        $success = true;
        $message = "Votre service a bien été ajouté";
        return redirect()->route('services')->with(compact('success', 'message'));    }

    public function registerService(Request $request)
    {
        $user = new UTILISATEUR();
        $service = $request->input('idService');

        $nbMaxPersService = Service::find($service)->NBPERSONNESMAX;
        $nbActuelPersService = Reservation::where('IDSERVICE', $service)->count();

        $message = "";
        $erreur = false;
        $success = false;

        if(auth()->user()->SOLDE < Service::find($service)->prix)
        {
            $message = "Vous n'avez pas assez de solde pour réserver ce service";
            $erreur = true;
        }
        if(Service::find($service)->hasReservations(Auth::user()->IDUTILISATEUR)) {
            $message = "Vous avez déjà réservé ce service";
            $erreur = true;
        }
        if(Service::find($service)->IDVENDEUR == Auth::user()->IDUTILISATEUR) {
            $message = "Vous ne pouvez pas réserver votre propre service";
            $erreur = true;
        }
        if (!$erreur){
            if ($nbActuelPersService < $nbMaxPersService) {
                $idUser = Auth::user()->IDUTILISATEUR;

                $reserver = new Reservation;
                $reserver->IDACHETEUR = $idUser;
                $reserver->IDSERVICE = $service;
                $reserver->save();
                $success = true;
                $message = "Vous avez réservé votre place pour : " . Service::find($service)->LIBELLESERVICE;
            } else {
                $message = "Ce service a déjà atteint le nombre maximum de participants";
            }
        }
            return redirect()->route('services')->with(compact('success', 'message'));
    }


    public function getInfoPourValidation($idService)
    {
        // Récupérer les données du service
        $service = Service::find($idService);
        // Retourner la vue validationService avec les données du service
        return view('validationService', compact('service'));
    }



}
