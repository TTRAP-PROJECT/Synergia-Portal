<?php

namespace App\Http\Controllers;

use App\Models\CINEMA;
use App\Models\COVOITURAGE;
use App\Models\ECHANGECOMPETENCE;
use App\Models\EVENEMENTSPORTIF;
use App\Models\Reservation;
use App\Models\SERVICE;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function services()
    {
        $services = SERVICE::all();
        $evenementsSportif = EvenementSportif::with('sport')->get();
        $evenementCinema = CINEMA::all();
        $covoiturages=Covoiturage::all();
        $echange_compets= EchangeCompetence::with('n_i_v_e_a_u')->get();

        return view('services',
            array('services' => $services,
                'evenementsSportif'=>$evenementsSportif,
                'evenementCinema'=>$evenementCinema,
                'covoiturages'=>$covoiturages,
                'competences'=>$echange_compets
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
        $tableServices = [1 => 'Cinéma', 2 => 'Covoiturage', 3 => 'Loisir', 4 => 'Échange de compétences', 5 => 'Évènement sportif', 6 => 'Autre'];
        $libelleService = $tableServices[$request->input('services')];

        $service = new SERVICE();
        $service->IDSTATUT = 1;
        $service->LIBELLESERVICE = $libelleService;
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
                //
                break;
            case '2':
                $service->lieu_service = null;
                $covoiturage = new COVOITURAGE();
                $covoiturage->IDSERVICE = 4;
                $covoiturage->LIEUDEPART = $request->input('lieuDepart');
                $covoiturage->LIEUARRIVEE = $request->input('lieuArrivee');
                $covoiturage->DATECOVOIT = $datePrevue;
                $covoiturage->save();
                break;
            case '3':
                break;

            case '4':
                $echangecompetence = new ECHANGECOMPETENCE();
                $echangecompetence->idService = $service->IDSERVICE;
                $echangecompetence->matiere = $request->input('nom');
                $echangecompetence->idNiveau = $request->input('niveau');
                $echangecompetence->save();
                break;

            case '5':
                $evenementsportif = new EVENEMENTSPORTIF();
                $evenementsportif->idService = $service->IDSERVICE;
                $evenementsportif->libelleSport = $request->input('sport');
                $evenementsportif->dateEvent = $datePrevue;
                $evenementsportif->save();
                break;
            case '6':
                break;
            default:
                break;
        }

        // Service : IDSERVICE, IDSTATUT, LIBELLESERVICE, typeService, description, lieu_service, prix, idVendeur, idModerateur, datePublication, datePrevue, nbPersonneMax

        return redirect()->route('services');
    }

    public function registerService(Request $request)
    {
        $service = $request->input('idService');

        $nbMaxPersService = Service::find($service)->NBPERSONNESMAX;
        $nbActuelPersService = Reservation::where('IDSERVICE', $service)->count();

        $message = "";
        $success = false;

        if ($nbActuelPersService < $nbMaxPersService) {
            $idUser = Auth::user()->IDUTILISATEUR;

            $reserver = new Reservation;
            $reserver->IDACHETEUR = $idUser;
            $reserver->IDSERVICE = $service;
            $reserver->save();
            $success = true;
            $message = "Vous avez réservé " . Service::find($service)->LIBELLESERVICE;
        } else {
            $message = "Ce service a déjà atteint le nombre maximum de participants";
        }

        return redirect()->route('services')->with(compact('success', 'message'));
    }


}
