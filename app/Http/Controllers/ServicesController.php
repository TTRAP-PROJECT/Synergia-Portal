<?php

namespace App\Http\Controllers;

use App\Models\CINEMA;
use App\Models\COVOITURAGE;
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
        return view('services',
            array('services' => $services,
                'evenementsSportif'=>$evenementsSportif,
                'evenementCinema'=>$evenementCinema,
                'covoiturages'=>$covoiturages));
    }
}
