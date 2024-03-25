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
        $evenementsSportif = EVENEMENTSPORTIF::with('sport')->get();
        $evenementCinema = CINEMA::all();
        $covoiturages=Covoiturage::all();
//        $echange_compets= ECHANGECOMPETENCE::with('c_o_u_r', 'n_i_v_e_a_u')->get();

        return view('services',
            array('services' => $services,
                'evenementsSportif'=>$evenementsSportif,
                'evenementCinema'=>$evenementCinema,
                'covoiturages'=>$covoiturages,
//                'competences'=>$echange_compets
            ));
    }
}
