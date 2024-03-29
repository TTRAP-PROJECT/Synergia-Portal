<?php

namespace App\Http\Controllers;

use App\Models\CINEMA;
use App\Models\COVOITURAGE;
use App\Models\ECHANGECOMPETENCE;
use App\Models\EVENEMENTSPORTIF;
use App\Models\SERVICE;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function services()
    {
        $services = SERVICE::all();
        $evenementsSportif = EvenementSportif::with('sport')->get();
        $evenementCinema = CINEMA::all();
        $covoiturages=Covoiturage::all();
        $echange_compets= EchangeCompetence::with('c_o_u_r', 'n_i_v_e_a_u')->get();

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
        switch ($request->input('services')) {
            case 'Cinéma':
                $typeService = 1;


                break;
            case 'Covoiturage':
                $typeService = 2;
                break;
            case 'Loisir':
                $typeService = 3;
                break;
            case 'Evènement sportif':
                $typeService = 4;
                break;
            case 'Autre':
                $typeService = 5;
                break;
            default:
                $typeService = 0;
                break;
        }

        $service = new SERVICE();
        $service->IDSTATUT = 1;
        $service->LIBELLESERVICE = $request->input('services');
        $service->typeService = $request->input('typeService');
        $service->prix = $request->input('prix');
        $service->description = $request->input('description');

        $service->save();



        return redirect()->route('services');
    }
}
