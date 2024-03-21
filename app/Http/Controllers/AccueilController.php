<?php

namespace App\Http\Controllers;

use App\Models\ANNONCE;
use App\Models\Sondage;
use Illuminate\Http\Request;

class AccueilController extends Controller
{

    public function get_donnees_accueil(Request $request)
    {
        $sondages = Sondage::all();
        $annonces = ANNONCE::all();

        return view('dashboard', compact('annonces', 'sondages'));
    }


}
