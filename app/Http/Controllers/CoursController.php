<?php

namespace App\Http\Controllers;


use App\Models\Cour;
use Illuminate\Http\Request;

class CoursController extends Controller
{

    public function get_data_cours(Request $request)
    {
        $cours=COUR::all();

        return view('cours', compact('cours'));
    }


}
