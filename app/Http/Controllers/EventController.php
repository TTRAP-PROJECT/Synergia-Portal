<?php

namespace App\Http\Controllers;

use App\Models\CINEMA;
use App\Models\EVENEMENTSPORTIF;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function get_evenement(Request $request)
    {
        // Charger les événements avec les détails du sport associé
        $evenementsSportif = EVENEMENTSPORTIF::with('sport')->get();
        $evenementCinema = CINEMA::all();

        return view('evenement', compact('evenementsSportif', 'evenementCinema'));
    }
}
