<?php

namespace App\Http\Controllers;


use App\Models\COUR;
use Illuminate\Http\Request;

class CourController extends Controller
{

    public function get_data_cours(Request $request)
    {
        $cours=COUR::all();

        return view('cours', compact('cours'));
    }


}
